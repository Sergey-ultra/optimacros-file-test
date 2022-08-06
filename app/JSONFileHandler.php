<?php
declare(strict_types=1);


namespace App;


use App\Contract\FileHandler;

class JSONFileHandler extends FileHandler
{
    public function __construct(protected string $path){}

    public function write(array $data): void
    {
        if ($tempArray = $this->read()) {
            $data = array_merge($tempArray, $data);
        }

        file_put_contents($this->path, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

    }

    public function read(): ?iterable
    {
        if (!is_readable($this->path)) {
           return null;
        }
        return json_decode(file_get_contents($this->path), true);
    }
}