<?php


namespace App\Factory;

use App\Entities\Node;

abstract class AbstractFactory {

    abstract protected function makeNode(string $tokenType): Node;

    public function getNode(string $tokenType): Node
    {
        return $this->makeNode($tokenType);
    }
}
