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
            if (!Schema::hasColumn('course_user_subscriptions', 'status')) {
                Schema::table('course_user_subscriptions', function (Blueprint $table) {
                    $table->string('status')->nullable()->after('remaining_amount');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('course_user_subscriptions')) {
            if (Schema::hasColumn('course_user_subscriptions', 'status')) {
                Schema::table('course_user_subscriptions', function (Blueprint $table) {
                    $table->dropColumn('status');
                });
            }
        }
    }
};
