<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
require __DIR__ . '/autoload.php';


$calculator = new App\Calculator();
$calculator->start('php://stdin', 'r');
