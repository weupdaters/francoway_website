<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$u = User::where('email', 'admin@gmail.com')->first();
if ($u) {
    $u->password = Hash::make('password');
    $u->save();
    echo "Password changed successfully for admin@gmail.com\n";
} else {
    echo "User admin@gmail.com not found\n";
}
