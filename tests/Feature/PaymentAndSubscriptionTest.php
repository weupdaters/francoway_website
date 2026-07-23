<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentAndSubscriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_view_checkout_page_for_course()
    {
        $student = User::factory()->create(['role' => 'user']);
        $course = Course::create([
            'title' => 'DELF B2 Exam Preparation',
            'price' => 5000.00,
            'status' => 1,
        ]);

        $response = $this->actingAs($student)->get("/users/courses/{$course->id}/checkout");
        $response->assertStatus(200);
        $response->assertSee('DELF B2 Exam Preparation');
    }

    public function test_student_can_purchase_course_and_activate_subscription()
    {
        $student = User::factory()->create(['role' => 'user']);
        $course = Course::create([
            'title' => 'DALF C1 Masterclass',
            'price' => 7500.00,
            'status' => 1,
        ]);

        $plan = SubscriptionPlan::create([
            'course_id' => $course->id,
            'plan_name' => '1 Year Plan',
            'duration_type' => 'year',
            'duration_value' => 1,
            'price' => 7500.00,
            'status' => 1,
        ]);

        $response = $this->actingAs($student)->post("/users/courses/{$course->id}/purchase", [
            'plan_id' => $plan->id,
            'payment_method' => 'manual',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('course_user_subscriptions', [
            'user_id' => $student->id,
            'course_id' => $course->id,
            'payment_status' => 'paid',
            'subscription_status' => 'active',
        ]);
    }
}
