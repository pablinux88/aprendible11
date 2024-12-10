<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WriteToFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:write-to-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Solicitar nombre y edad al usuario
        $name = $this->ask('Please enter your name');
        $age = $this->ask('Please enter your age');

        // Validar que la edad sea numérica
        if (!is_numeric($age)) {
            $this->error('Age must be a number.');
            return Command::FAILURE;
        }

        // Crear el contenido con las posiciones específicas
        $line1 = str_pad('', 9) . $name . PHP_EOL; // Nombre en la línea 1, columna 10
        $line2 = str_pad('', 2) . $age . PHP_EOL;  // Edad en la línea 2, columna 3

        // Ruta del archivo
        $filePath = storage_path('app/output.txt');

        // Escribir al archivo
        file_put_contents($filePath, $line1 . $line2);

        $this->info("Data written successfully to {$filePath}");
        return Command::SUCCESS;
    }
}
