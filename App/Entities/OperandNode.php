<?php


namespace App\Entities;


use App\Visitor\NodeVisitor;

class OperandNode extends Node
{
    public function setValue(string $value): Node
    {
        $this->value = $value;
        return $this;
    }

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
        $nodeVisitor->visitOperandNode($this);
    }
}