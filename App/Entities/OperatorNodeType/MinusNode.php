<?php


namespace App\Entities\OperatorNodeType;


use App\Entities\Node;
use App\Entities\OperatorNode;
use App\Visitor\NodeVisitor;

class MinusNode extends OperatorNode
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

    public function setRightChild(Node $rightChild): Node
    {
        $this->rightChild = $rightChild;
        return $this;
    }

    public function setLeftChild(Node $leftChild): Node
    {
        $this->leftChild = $leftChild;
        return $this;
    }

    public function accept(NodeVisitor $nodeVisitor): void
    {
        $nodeVisitor->visitMinusNode($this);
    }
}