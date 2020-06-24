<?php


namespace App\Factory;

use App\Entities\Node;

abstract class AbstractFactory {
    abstract function makeNode(string $type, string $token): Node;
}
