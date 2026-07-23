<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Teachers
        if (!Schema::hasTable('teachers')) {
            Schema::create('teachers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
                $table->timestamps();
            });
        }

        // 2. Courses
        if (!Schema::hasTable('courses')) {
            Schema::create('courses', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->decimal('price', 10, 2)->default(0.00);
                $table->boolean('status')->default(true);
                $table->string('thumbnail')->nullable();
                $table->string('cover_image')->nullable();
                $table->string('trial_video')->nullable();
                $table->boolean('has_custom_prompt')->default(false);
                $table->text('custom_prompt')->nullable();
                $table->foreignId('teacher_id')->nullable()->constrained('users')->onDelete('set null');
                $table->timestamps();
            });
        }

        // 3. Sections
        if (!Schema::hasTable('sections')) {
            Schema::create('sections', function (Blueprint $table) {
                $table->id();
                $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
                $table->string('title');
                $table->integer('order')->default(0);
                $table->timestamps();
            });
        }

        // 4. Lessons
        if (!Schema::hasTable('lessons')) {
            Schema::create('lessons', function (Blueprint $table) {
                $table->id();
                $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
                $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('cascade');
                $table->foreignId('teacher_id')->nullable()->constrained('users')->onDelete('set null');
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('video_url')->nullable();
                $table->string('type')->default('video'); // video, audio, text
                $table->string('duration')->nullable();
                $table->boolean('is_free')->default(false);
                $table->integer('order')->default(0);
                $table->timestamps();
            });
        }

        // 5. Subscription Plans
        if (!Schema::hasTable('subscription_plans')) {
            Schema::create('subscription_plans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
                $table->string('plan_name');
                $table->string('duration_type')->default('month');
                $table->integer('duration_value')->default(1);
                $table->decimal('price', 10, 2)->default(0.00);
                $table->boolean('status')->default(true);
                $table->timestamps();
            });
        }

        // 6. Course User Subscriptions
        if (!Schema::hasTable('course_user_subscriptions')) {
            Schema::create('course_user_subscriptions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
                $table->foreignId('plan_id')->nullable()->constrained('subscription_plans')->onDelete('set null');
                $table->integer('duration_value')->nullable();
                $table->string('duration_type')->nullable();
                $table->timestamp('start_date')->nullable();
                $table->timestamp('expiry_date')->nullable();
                $table->decimal('price', 10, 2)->default(0.00);
                $table->string('payment_status')->default('pending');
                $table->string('subscription_status')->default('active');
                $table->decimal('total_amount', 10, 2)->default(0.00);
                $table->decimal('paid_amount', 10, 2)->default(0.00);
                $table->decimal('remaining_amount', 10, 2)->default(0.00);
                $table->string('status')->nullable();
                $table->string('payment_method')->nullable();
                $table->string('paid_by')->nullable();
                $table->timestamp('paid_at')->nullable();
                $table->timestamps();
            });
        }

        // 7. Course Assignments
        if (!Schema::hasTable('course_assignments')) {
            Schema::create('course_assignments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
                $table->decimal('total_amount', 10, 2)->default(0.00);
                $table->decimal('paid_amount', 10, 2)->default(0.00);
                $table->decimal('remaining_amount', 10, 2)->default(0.00);
                $table->string('status')->default('active');
                $table->timestamp('expiry_date')->nullable();
                $table->timestamps();
            });
        }

        // 8. Course User Pivot
        if (!Schema::hasTable('course_user')) {
            Schema::create('course_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('status')->default('active');
                $table->timestamps();
            });
        }

        // 9. Teacher User Pivot
        if (!Schema::hasTable('teacher_user')) {
            Schema::create('teacher_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->timestamps();
            });
        }

        // 10. Teacher Assign User
        if (!Schema::hasTable('teacher_assign_user')) {
            Schema::create('teacher_assign_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
                $table->timestamps();
            });
        }

        // 11. Lesson User (Progress)
        if (!Schema::hasTable('lesson_user')) {
            Schema::create('lesson_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->boolean('is_completed')->default(false);
                $table->timestamp('completed_at')->nullable();
                $table->timestamps();
            });
        }

        // 12. Comments
        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
                $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
                $table->text('comment');
                $table->timestamps();
            });
        }

        // 13. Settings
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->text('value')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('lesson_user');
        Schema::dropIfExists('teacher_assign_user');
        Schema::dropIfExists('teacher_user');
        Schema::dropIfExists('course_user');
        Schema::dropIfExists('course_assignments');
        Schema::dropIfExists('course_user_subscriptions');
        Schema::dropIfExists('subscription_plans');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('settings');
    }
};
