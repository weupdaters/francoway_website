<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StudentAccessAndExpiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_access_free_course_lessons()
    {
        $student = User::factory()->create(['role' => 'user']);
        $freeCourse = Course::create([
            'title' => 'Free French Basics',
            'price' => 0.00,
            'status' => 1,
        ]);

        $lesson = Lesson::create([
            'course_id' => $freeCourse->id,
            'title' => 'Introduction to French Alphabet',
            'lesson_type' => 'summary',
        ]);

        $response = $this->actingAs($student)->get("/users/courses/{$freeCourse->id}/lessons");
        $response->assertStatus(200);
    }

    public function test_student_with_active_subscription_can_view_lessons()
    {
        $student = User::factory()->create(['role' => 'user']);
        $paidCourse = Course::create([
            'title' => 'Advanced Grammar',
            'price' => 1999.00,
            'status' => 1,
        ]);

        $lesson = Lesson::create([
            'course_id' => $paidCourse->id,
            'title' => 'Complex Tenses',
            'lesson_type' => 'summary',
        ]);

        DB::table('course_user_subscriptions')->insert([
            'user_id' => $student->id,
            'course_id' => $paidCourse->id,
            'payment_status' => 'paid',
            'subscription_status' => 'active',
            'start_date' => now()->subDays(5),
            'expiry_date' => now()->addDays(25),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($student)->get("/users/courses/{$paidCourse->id}/lessons/{$lesson->id}");
        $response->assertStatus(200);
    }

    public function test_student_with_expired_subscription_is_redirected_to_checkout()
    {
        $student = User::factory()->create(['role' => 'user']);
        $paidCourse = Course::create([
            'title' => 'Advanced French Vocab',
            'price' => 2499.00,
            'status' => 1,
        ]);

        DB::table('course_user_subscriptions')->insert([
            'user_id' => $student->id,
            'course_id' => $paidCourse->id,
            'payment_status' => 'paid',
            'subscription_status' => 'active',
            'start_date' => now()->subDays(40),
            'expiry_date' => now()->subDays(10), // EXPIRED
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($student)->get("/users/courses/{$paidCourse->id}/lessons");
        $response->assertRedirect(route('users.checkout', $paidCourse->id));
    }

    public function test_student_can_complete_a_lesson()
    {
        $student = User::factory()->create(['role' => 'user']);
        $course = Course::create([
            'title' => 'French Conversation 101',
            'price' => 0.00,
            'status' => 1,
        ]);

        $lesson = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Greetings in Paris',
            'lesson_type' => 'summary',
        ]);

        $response = $this->actingAs($student)
            ->postJson("/users/courses/{$course->id}/lessons/{$lesson->id}/complete");

        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('lesson_user', [
            'user_id' => $student->id,
            'lesson_id' => $lesson->id,
            'is_completed' => 1,
        ]);
    }
}
