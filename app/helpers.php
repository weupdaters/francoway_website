<?php

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Get setting value (key / value based)
|--------------------------------------------------------------------------
*/
if (!function_exists('setting')) {
    function setting($key = null, $default = null)
    {
        // static cache (same request me baar-baar DB hit nahi hoga)
        static $settings = null;

        if ($settings === null) {
            $settings = Setting::pluck('value', 'key')->toArray();
        }

        // agar key pass ki
        if ($key) {
            return $settings[$key] ?? $default;
        }

        // agar poora array chahiye
        return $settings;
    }
}

/*
|--------------------------------------------------------------------------
| Footer pages
|--------------------------------------------------------------------------
*/
if (!function_exists('footerPages')) {
    function footerPages()
    {
        return Page::where('is_active', 1)->get();
    }
}

/*
|--------------------------------------------------------------------------
| User wallet balance
|--------------------------------------------------------------------------
*/
if (!function_exists('userBalance')) {
    function userBalance($user = null)
    {
        $user = $user ?? Auth::user();

        if (!$user || !$user->wallet) {
            return 0;
        }

        return $user->wallet->balance ?? 0;
    }
}
