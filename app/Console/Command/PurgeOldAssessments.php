<?php

namespace App\Console\Commands;

use App\Models\Assessment;
use Illuminate\Console\Command;

class PurgeOldAssessments extends Command
{
    protected $signature = 'app:purge-old-assessments';
    protected $description = 'Delete assessment records older than 30 days';

    public function handle()
    {
        // Logic to delete old records
        $deleted = Assessment::where('created_at', '<', now()->subDays(30))->delete();

        $this->info("Successfully deleted {$deleted} old assessment records.");
        return Command::SUCCESS;
    }
}
