<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Daftar perintah Artisan yang disediakan oleh aplikasi.
     *
     * @var array
     */
    protected $commands = [
        "App\Console\Commands\DbBackup"
    ];

    /**
     * Tentukan perintah yang dijadwalkan untuk aplikasi.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('db:backup')->daily();
    }

    /**
     * Daftarkan perintah Artisan untuk aplikasi.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
