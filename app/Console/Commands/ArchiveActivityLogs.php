<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ArchiveActivityLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:archive-activity-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive old activity logs';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $logsToArchive = DB::table('activity_log')
            ->where('created_at', '<', now()->subDay())
            ->get();

        foreach ($logsToArchive as $log) {
            DB::table('activity_log_archives')->insert((array) $log);
            DB::table('activity_log')->where('id', $log->id)->delete();
        }

        $this->info('Old activity logs archived successfully.');
    }
}
