<?php


namespace App\Entities;


use App\Visitor\NodeVisitor;

abstract class Node
{
    protected string $value;
    protected ?Node $leftChild;
    protected ?Node $rightChild;

    public function __construct(string $value)
    {
        $this->value =  $value;
        $this->leftChild =  null;
        $this->rightChild =  null;
    }
    abstract public function setValue(string $value): Node;

    abstract public function getValue(): string;

    abstract public function setRightChild(Node $rightChild): Node;

    abstract public function getRightChild(): ?Node;

    abstract public function setLeftChild(Node $leftChild): Node;

    abstract public function getLeftChild(): ?Node;

    abstract public function accept(NodeVisitor $nodeVisitor): void;
}