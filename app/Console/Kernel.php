<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos Artisan.
     */
    protected $commands = [
        Commands\BackupDatabase::class,
    ];

    /**
     * Define las tareas programadas.
     */
    protected function schedule(Schedule $schedule)
    {
        // Ejemplo de tarea programada: ejecutar backup diario
        // $schedule->command('db:backup')->daily();
    }

    /**
     * Registra eventos de inicio de comandos.
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
