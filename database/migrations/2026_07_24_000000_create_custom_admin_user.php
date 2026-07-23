<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Automatically create or update the requested admin user
        $user = User::firstOrNew(['email' => 'weupdates@gmail.com']);
        $user->name = 'WeUpdates Admin';
        $user->password = Hash::make('admin@123');
        $user->role = 'admin';
        $user->status = 1;
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::where('email', 'weupdates@gmail.com')->delete();
    }
};
