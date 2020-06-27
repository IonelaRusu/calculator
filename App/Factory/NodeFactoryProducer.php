<?php


namespace App\Factory;


use App\Entities\Node;
use App\Entities\OperandNode;
use App\Exceptions\UnknownNodeTypeException;

class NodeFactoryProducer
{
    /**
     * @throws UnknownNodeTypeException
     */
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
                throw new UnknownNodeTypeException("Unknown node type.");
        }

        return $node;
    }
}