<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ManageSubscriptions extends Command
{
    protected $signature = 'subscriptions:manage';
    protected $description = 'Handle subscription expiry and reminders';

    public function handle()
    {
        $today = Carbon::today();

        /*
        |--------------------------------------------------------------------------
        | 1. Expire Subscriptions
        |--------------------------------------------------------------------------
        */

        DB::table('course_user_subscriptions')
            ->whereDate('expiry_date', '<', $today)
            ->where('subscription_status', 'active')
            ->update([
                'subscription_status' => 'expired',
                'updated_at' => now(),
            ]);

        $this->info('Expired subscriptions updated.');

        /*
        |--------------------------------------------------------------------------
        | 2. Pre Expiry Reminder (3 Days Before)
        |--------------------------------------------------------------------------
        */

        $reminderDate = Carbon::today()->addDays(3);

        $expiringSoon = DB::table('course_user_subscriptions')
            ->whereDate('expiry_date', $reminderDate)
            ->where('pre_expiry_notified', 0)
            ->get();

        foreach ($expiringSoon as $sub) {

            $user = User::find($sub->user_id);

            if ($user) {

                // ⭐ Replace with Email / WhatsApp / Notification
                \Log::info("Reminder: Subscription expiring soon for User ID: {$user->id}");

                DB::table('course_user_subscriptions')
                    ->where('id', $sub->id)
                    ->update([
                        'pre_expiry_notified' => 1,
                        'updated_at' => now(),
                    ]);
            }
        }

        $this->info('Pre expiry reminders sent.');

        /*
        |--------------------------------------------------------------------------
        | 3. Expired Notification
        |--------------------------------------------------------------------------
        */

        $expiredSubs = DB::table('course_user_subscriptions')
            ->whereDate('expiry_date', '<', $today)
            ->where('expired_notified', 0)
            ->get();

        foreach ($expiredSubs as $sub) {

            $user = User::find($sub->user_id);

            if ($user) {

                // ⭐ Replace with Email / WhatsApp / Notification
                \Log::info("Alert: Subscription expired for User ID: {$user->id}");

                DB::table('course_user_subscriptions')
                    ->where('id', $sub->id)
                    ->update([
                        'expired_notified' => 1,
                        'updated_at' => now(),
                    ]);
            }
        }

        $this->info('Expired notifications sent.');
    }
}
