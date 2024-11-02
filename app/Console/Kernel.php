<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Jadwal;
use App\Models\Pengambilan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        Log::info('Running scheduled task 1');
        
        $schedule->call(function () {
            Log::info('Running scheduled task'); // Log untuk memastikan task berjalan
    
            $jadwals = Jadwal::latest()->first();
    
            
                if (Carbon::now()->greaterThan($jadwals->deadline_bulan)) {
                    Log::info('Creating new jadwal for jadwal_id: ' . $jadwals->id);
    
                    $newJadwal = Jadwal::create([
                        'bulan' => Carbon::now()->format('Y-m'),
                        'deadline_bulan' => Carbon::now()->addMonths(2),
                    ]);
    
                    // Jika Anda membutuhkan tindakan tambahan, tambahkan di sini
                }
            
        })->everyMinute();
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
