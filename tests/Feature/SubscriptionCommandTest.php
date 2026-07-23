<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SubscriptionCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_artisan_subscriptions_manage_command_marks_expired_subscriptions()
    {
        $student = User::factory()->create(['role' => 'user']);
        $course = Course::create(['title' => 'Test Course', 'price' => 1000, 'status' => 1]);

        DB::table('course_user_subscriptions')->insert([
            'user_id' => $student->id,
            'course_id' => $course->id,
            'payment_status' => 'paid',
            'subscription_status' => 'active',
            'start_date' => now()->subDays(60),
            'expiry_date' => now()->subDays(10), // Expired
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->artisan('subscriptions:manage')
            ->assertExitCode(0);

        $this->assertDatabaseHas('course_user_subscriptions', [
            'user_id' => $student->id,
            'course_id' => $course->id,
            'subscription_status' => 'expired',
        ]);
    }
}
