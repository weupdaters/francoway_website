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
        if (Schema::hasTable('course_user_subscriptions')) {
            Schema::table('course_user_subscriptions', function (Blueprint $table) {
                $table->index(['user_id', 'course_id', 'subscription_status'], 'cus_user_course_status_idx');
                $table->index(['expiry_date', 'subscription_status'], 'cus_expiry_status_idx');
            });
        }

        if (Schema::hasTable('teacher_assign_user')) {
            Schema::table('teacher_assign_user', function (Blueprint $table) {
                $table->index(['teacher_id', 'course_id'], 'tau_teacher_course_idx');
            });
        }

        if (Schema::hasTable('lessons')) {
            Schema::table('lessons', function (Blueprint $table) {
                $table->index(['course_id', 'section_id'], 'lessons_course_section_idx');
            });
        }

        if (Schema::hasTable('comments')) {
            Schema::table('comments', function (Blueprint $table) {
                $table->index(['lesson_id', 'parent_id'], 'comments_lesson_parent_idx');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('course_user_subscriptions')) {
            Schema::table('course_user_subscriptions', function (Blueprint $table) {
                $table->dropIndex('cus_user_course_status_idx');
                $table->dropIndex('cus_expiry_status_idx');
            });
        }

        if (Schema::hasTable('teacher_assign_user')) {
            Schema::table('teacher_assign_user', function (Blueprint $table) {
                $table->dropIndex('tau_teacher_course_idx');
            });
        }

        if (Schema::hasTable('lessons')) {
            Schema::table('lessons', function (Blueprint $table) {
                $table->dropIndex('lessons_course_section_idx');
            });
        }

        if (Schema::hasTable('comments')) {
            Schema::table('comments', function (Blueprint $table) {
                $table->dropIndex('comments_lesson_parent_idx');
            });
        }
    }
};
