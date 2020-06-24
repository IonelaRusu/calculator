<?php


namespace App\Entities\OperatorNodeType;


use App\Entities\Node;
use App\Entities\OperatorNode;

class DivisionNode extends OperatorNode
{
    public function getValue(): string
    {
        return $this->value;
    }

    public function getRightChild(): ?Node
    {
        return $this->rightChild;
    }

    public function getLeftChild(): ?Node
    {
        return $this->leftChild;
    }
}