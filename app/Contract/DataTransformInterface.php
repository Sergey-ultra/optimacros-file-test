<?php

declare(strict_types=1);

namespace App\Contract;

interface DataTransformInterface
{
    public function write(): void;
}