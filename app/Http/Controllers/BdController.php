<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class BdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Your logic here
        return view('sistema.Bd');
    }

    /**
     * Backup the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function backup()
{
    try {
        Artisan::call('backup:run', ['--only-db' => true]);
        return back()->with('message', 'Backup generado correctamente');
    } catch (\Exception $e) {
        Log::error('Error al generar el backup: ' . $e->getMessage());
        return response()->json(['error' => 'Error al generar el backup: ' . $e->getMessage()], 500);
    }
}

    /**
     * Restore the database from a backup file.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        try {
            if ($request->hasFile('backup_file')) {
                Log::info('Nombre del archivo: ' . $request->file('backup_file')->getClientOriginalName());
                Log::info('Tipo MIME: ' . $request->file('backup_file')->getMimeType());
            }
            // Validar el archivo
            $request->validate([
                'backup_file' => 'required|file',
            ]);

            if (!str_ends_with($request->file('backup_file')->getClientOriginalName(), '.sql')) {
                return back()->withErrors(['backup_file' => 'El archivo debe tener extensión .sql.']);
            }

            // Guardar temporalmente el archivo
            $backupPath = $request->file('backup_file')->storeAs(
                'temp', // Carpeta personalizada
                'restore.sql' // Nombre fijo para restaurar
            );

            // Obtener la ruta completa al archivo
            $fullBackupPath = storage_path('app/' . $backupPath);

            // Restaurar la base de datos
            $this->restoreDatabase($fullBackupPath);
            $this->restoreDatabase("");
            
            // Eliminar el archivo temporal
            //Storage::delete($backupPath);

            return back()->with('message', 'Base de datos restaurada correctamente');
        } catch (\Exception $e) {
            Log::error('Error al restaurar la base de datos: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error al restaurar la base de datos: ' . $e->getMessage()]);
        }
    }

    private function restoreDatabase($filePath)
    {
        $dbHost = env('DB_HOST');
        $dbPort = env('DB_PORT');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');

        // Construir el comando para restaurar
        $command = "mysql -uprueba -p123 -hlocalhost ziyegou < D:/laragon/www/ziyegoU/storage/app/custom-backups/temp/restore.sql";
        // Ejecutar el comando
        $output = null;
        $resultCode = null;
        exec($command . ' 2>&1', $output, $resultCode);  // Capturar la salida estándar y de error

        Log::error('Salida del comando de restauración: ' . implode("\n", $output));
        Log::error('Código de salida: ' . $resultCode);

        // Verificar si hubo un error
        if ($resultCode !== 0) {
            throw new \Exception("Error al restaurar la base de datos. Código de salida: {$resultCode}");
        }
    }
}