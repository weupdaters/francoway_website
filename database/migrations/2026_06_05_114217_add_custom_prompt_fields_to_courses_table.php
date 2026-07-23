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
        Schema::table('courses', function (Blueprint $table) {
            if (!Schema::hasColumn('courses', 'has_custom_prompt')) {
                $table->boolean('has_custom_prompt')->default(false)->after('trial_video');
            }
            if (!Schema::hasColumn('courses', 'custom_prompt')) {
                $table->text('custom_prompt')->nullable()->after('has_custom_prompt');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['has_custom_prompt', 'custom_prompt']);
        });
    }
};
