<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCourseWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_course()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/courses', [
            'title' => 'French A1 Intensive',
            'description' => 'Complete beginner course for French language mastery.',
            'price' => 4999.00,
            'status' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('courses', [
            'title' => 'French A1 Intensive',
            'price' => 4999.00,
        ]);
    }

    public function test_admin_can_assign_course_to_student_with_duration()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $student = User::factory()->create(['role' => 'user']);
        $course = Course::create([
            'title' => 'French B1 Mastery',
            'price' => 2999.00,
            'status' => 1,
        ]);

        $response = $this->actingAs($admin)->post('/admin/course-assign', [
            'user_id' => $student->id,
            'course_id' => $course->id,
            'course_type' => 'paid',
            'duration_value' => 30,
            'duration_type' => 'days',
            'price' => 2999.00,
            'status' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('course_user_subscriptions', [
            'user_id' => $student->id,
            'course_id' => $course->id,
            'payment_status' => 'paid',
            'duration_value' => 30,
            'duration_type' => 'days',
        ]);
    }

    public function test_admin_can_assign_teacher_to_course()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $teacher = User::factory()->create(['role' => 'teacher']);
        $student = User::factory()->create(['role' => 'user']);
        $course = Course::create([
            'title' => 'French Spoken Practice',
            'price' => 1500.00,
            'status' => 1,
        ]);

        $response = $this->actingAs($admin)->post('/admin/teacher-assign', [
            'teacher_id' => $teacher->id,
            'user_id' => $student->id,
            'course_id' => $course->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('teacher_assign_user', [
            'teacher_id' => $teacher->id,
            'user_id' => $student->id,
            'course_id' => $course->id,
        ]);
    }
}
