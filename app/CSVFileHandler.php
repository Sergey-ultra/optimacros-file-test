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



    public function read(): iterable
    {
        $spl = new \SplFileObject($this->path, 'r' );

        $spl->setFlags( $spl :: READ_CSV);

        $spl->setCsvControl($this->delimiter);

        $spl->setMaxLineLen(0);

        foreach ($spl AS $array ) {
            yield $array;
        }
    }
}