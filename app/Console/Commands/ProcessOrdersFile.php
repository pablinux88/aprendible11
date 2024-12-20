<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessOrdersFile extends Command
{
    protected $signature = 'app:process-orders-file';
    protected $description = 'Reads an orders file and processes it based on conditions.';

    public function handle()
    {
        $directoryPath = storage_path('app/ordenes');
        $inputFiles = glob("{$directoryPath}/*.INF"); // Obtiene todos los archivos .INF

        if (empty($inputFiles)) {
            $this->error("No .INF files found in the directory: {$directoryPath}");
            return Command::FAILURE;
        }

        foreach ($inputFiles as $inputFilePath) {
            $this->info("Processing file: {$inputFilePath}");

            $lines = file($inputFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (!$lines || count($lines) <= 1) {
                $this->error("The file {$inputFilePath} has no data or only one line.");
                continue;
            }

            $firstLineColumns = str_getcsv($lines[0]);
            $firstColumn = $firstLineColumns[0] ?? null;

            if ($firstColumn === '007850 001') {
                $this->info("Condition 1 met: {$firstColumn} Orden de Nadro");
                $this->call('app:translate-nadro', ['filePath' => $inputFilePath]);
            } elseif ($firstColumn === '010850 001') {
                $this->info("Condition 2 met: {$firstColumn} Orden de Walmart");
                $this->call('app:translate-walmart', ['filePath' => $inputFilePath]);
            } elseif ($firstColumn === '026850 002') {
                $this->info("Condition 3 met: {$firstColumn} Orden de Chedraui");
                $this->call('app:translate-chedraui', ['filePath' => $inputFilePath]);
            } else {
                $this->warn("No conditions met for: {$firstColumn}");
            }
        }

        return Command::SUCCESS;
    }
}
