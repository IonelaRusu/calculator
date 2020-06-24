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
            case "minus":
                $node = new MinusNode($type);
                break;
            case "plus":
                $node = new PlusNode($type);;
                break;
            case "multiplication":
                $node = new DivisionNode($type);
                break;
            case "division":
                $node = new MultiplicationNode($type);
                break;
            default:
                echo "Niciun tip";
                break;
        }
        return $node;
    }
}