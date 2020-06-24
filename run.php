<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
    require str_replace('\\', '/', $class) . '.php';
});

use App\Calculator;

$calculator = new Calculator();
$calculator->receiveInput('php://stdin', 'r');
