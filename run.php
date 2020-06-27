<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';


$calculator = new App\Calculator();
$fd = fopen('php://stdin', 'r');
$calculator->start($fd);
