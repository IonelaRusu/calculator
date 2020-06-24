<?php


namespace App\Entities;


class NodeStack
{
    private array $stack;

    public function __construct()
    {
        $this->stack = [];
    }

    public function addNodeToStack(Node $node): void
    {
        array_push($this->stack, $node);
    }

    public function extractNodeFromStack(): Node
    {
        return array_pop($this->stack);
    }

    public function getStack(): array
    {
        return $this->stack;
    }
}