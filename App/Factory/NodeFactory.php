<?php


namespace App\Factory;


use App\Entities\Node;
use App\Entities\OperandNode;

class NodeFactory extends AbstractFactory
{
    function makeNode(string $type, string $token): Node
    {
        $node = null;
        switch ($type) {
            case "operand":
                $node = new OperandNode($token);
                break;
            case "operator":
                $type = $token;
                $node = (new OperatorFactory())->makeNode($type, $token);
                break;
            default:
                echo "Niciun tip";
                break;
        }
        return $node;
    }
}