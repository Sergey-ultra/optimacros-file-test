<?php

declare(strict_types=1);

namespace App\Contract;

abstract class FileHandler
{

    public static function create(string $path): void
    {
        file_put_contents($path, '');
    }

    abstract public function write(array $data);

    abstract public function read(): ?iterable;
}
