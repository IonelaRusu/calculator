<?php


namespace App\Factory;

use App\Entities\Node;
use App\Entities\OperatorNodeType\DivisionNode;
use App\Entities\OperatorNodeType\MinusNode;
use App\Entities\OperatorNodeType\MultiplicationNode;
use App\Entities\OperatorNodeType\PlusNode;
use App\Exceptions\UnknownNodeTypeException;

class OperatorFactory extends AbstractFactory
{
    /**
     * @throws UnknownNodeTypeException
     */
    protected function makeNode(string $tokenType): Node
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
                throw new UnknownNodeTypeException("Unknown token type.");
        }

        return $node;
    }

    /**
     * @throws UnknownNodeTypeException
     */
    public function getNode(string $tokenType): Node
    {
        return $this->makeNode($tokenType);
    }
}