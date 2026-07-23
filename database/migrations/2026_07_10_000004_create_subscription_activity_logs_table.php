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
        if (!Schema::hasTable('subscription_activity_logs')) {
            Schema::create('subscription_activity_logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('subscription_id')->nullable();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->unsignedBigInteger('course_id')->nullable();
                $table->string('action');
                $table->text('message')->nullable();
                $table->json('meta')->nullable();
                $table->timestamp('logged_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_activity_logs');
    }
};
