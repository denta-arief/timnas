<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\PingHost;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('ping:host')->hourly();
        // $schedule->command('ping:host')->everyFifteenMinutes();
        $schedule->command('app:insert-timbangan')->everyFiveMinutes();
        // $schedule->command('app:send-daily-pdf')->dailyAt('17:15');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
