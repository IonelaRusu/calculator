<?php


namespace App\Factory;


use App\Entities\Node;
use App\Entities\OperatorNodeType\DivisionNode;
use App\Entities\OperatorNodeType\MinusNode;
use App\Entities\OperatorNodeType\MultiplicationNode;
use App\Entities\OperatorNodeType\PlusNode;

class OperatorFactory extends AbstractFactory
{
    function makeNode(string $type, string $token): Node
    {
        $node = null;
        switch ($type) {
            case "-":
                $node = new MinusNode($token);
                break;
            case "+":
                $node = new PlusNode($token);
                break;
            case "*":
                $node = new DivisionNode($token);
                break;
            case "/":
                $node = new MultiplicationNode($token);
                break;
            default:
                echo "Niciun tip";
                break;
        }
        return $node;
    }
}