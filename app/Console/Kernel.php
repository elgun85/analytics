<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Hər həftənin cümə günü saat 12:00-da backup yaradır
        $schedule->command('backup:run')->fridays()->at('12:00');

        // Hər ayın 1-də saat 03:00-da köhnə backup fayllarını silir
        $schedule->command('backup:clean')->monthlyOn(26, '13:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
