<?php


namespace App\Entities;


class OperandNode extends Node
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
}