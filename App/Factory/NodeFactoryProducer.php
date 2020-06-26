<?php


namespace App\Factory;


use App\Entities\Node;
use App\Entities\OperandNode;

class NodeFactoryProducer
{
    public function getNode(string $type, string $token): Node
    {
        $node = null;
        switch ($type) {
            case "operand":
                $node = new OperandNode($token);
                break;
            case "operator":
                $node = (new OperatorFactory())->getNode($token);
                break;
            default:
                echo "Unknown node type";
                break;
        }
        return $node;
    }
}