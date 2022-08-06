<style>
    span {
        display: inline-block;
    }
</style>

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


//foreach ((new  CSVFileHandler('./input.csv', ';'))->read() as $key => $line) {
//    echo "<div>
//        <span>$key</span>
//        <span style='width:400px;'>${line[0]}</span>
//        <span style='width:200px;'>${line[1]}</span>
//        <span style='width:200px;'>${line[2]}</span>
//        <span style='width:200px;'>${line[3]}</span>
//      </div>";
//}
