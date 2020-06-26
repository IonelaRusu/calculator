<?php


namespace App\Factory;

use App\Entities\Node;
use App\Entities\OperatorNodeType\DivisionNode;
use App\Entities\OperatorNodeType\MinusNode;
use App\Entities\OperatorNodeType\MultiplicationNode;
use App\Entities\OperatorNodeType\PlusNode;

class OperatorFactory extends AbstractFactory
{
    public function getNode(string $tokenType): Node
    {
        return $this->makeNode($tokenType);
    }

    function makeNode(string $tokenType): Node
    {
        $node = null;
        switch ($tokenType) {
            case "-":
                $node = new MinusNode($tokenType);
                break;
            case "+":
                $node = new PlusNode($tokenType);
                break;
            case "/":
                $node = new DivisionNode($tokenType);
                break;
            case "*":
                $node = new MultiplicationNode($tokenType);
                break;
            default:
                echo "Unknown token type";
                break;
        }
        return $node;
    }
}