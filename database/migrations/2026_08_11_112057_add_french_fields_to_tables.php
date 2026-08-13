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
            $table->string('lang', 10)->default('en')->nullable()->after('status');
        });

        Schema::table('resources', function (Blueprint $table) {
            $table->string('lang', 10)->default('en')->nullable()->after('pdf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('lang');
        });

        Schema::table('resources', function (Blueprint $table) {
            $table->dropColumn('lang');
        });
    }
};
