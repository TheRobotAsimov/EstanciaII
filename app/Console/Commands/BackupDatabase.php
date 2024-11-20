<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Respalda la base de datos';

    public function handle()
    {
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $backupPath = storage_path('backups/' . date('Y-m-d_H-i-s') . '.sql');

        if (!file_exists(dirname($backupPath))) {
            mkdir(dirname($backupPath), 0755, true);
        }

        $command = "mysqldump -u root -p  -h localhost {$database} > {$backupPath}";

        $result = null;
        system($command, $result);

        if ($result === 0) {
            $this->info("Backup creado en: {$backupPath}");
        } else {
            $this->error("Error al crear el backup.");
        }
    }
}
