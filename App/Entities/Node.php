<?php


namespace App\Entities;


abstract class Node
{
    protected string $value;
    protected ?Node $leftChild;
    protected ?Node $rightChild;

    public function __construct(string $value, Node $leftChild = null, Node $rightChild = null)
    {
        $this->value =  $value;
        $this->leftChild =  $leftChild;
        $this->rightChild =  $rightChild;
    }

    abstract public function getValue(): string;

    abstract public function getRightChild(): ?Node;

    abstract public function getLeftChild(): ?Node;

}