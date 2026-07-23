<?php

namespace App\Console\Commands;

use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class ManageSubscriptionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:manage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan and transition expired course subscriptions to expired status.';

    /**
     * Execute the console command.
     */
    public function handle(SubscriptionService $subscriptionService): int
    {
        $count = $subscriptionService->processExpiredSubscriptions();
        $this->info("Successfully updated {$count} expired subscription(s).");
        return Command::SUCCESS;
    }
}
