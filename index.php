<?php

use App\CSVFileHandler;
use App\DataTransform;
use App\JSONFileHandler;

require_once __DIR__ . './bootstrap.php';

$transformer = new DataTransform(
    new  CSVFileHandler('./files/input.csv', ';'),
    new  JSONFileHandler('./files/output2.json')
);

$transformer->write();





