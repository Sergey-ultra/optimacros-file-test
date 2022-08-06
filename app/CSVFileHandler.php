<?php
declare(strict_types=1);


namespace App;

use App\Contract\FileHandler;

class CSVFileHandler extends FileHandler
{
    public function __construct(
        protected string $path,
        protected string $delimiter
    ){}

    public function write(array $data): void
    {
        try {
            $file = fopen($this->path, 'a');
            fputcsv($file, $data);
        } finally {
            fclose($file);
        }
    }

    public function read(): ?iterable
    {
        try {
            if ($file = fopen($this->path, "r")) {
                while (($line = fgetcsv($file, 0, $this->delimiter))) {
                    yield $line;
                }
            }
        } finally {
            fclose($file);
        }
    }
}