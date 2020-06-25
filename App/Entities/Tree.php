<?php

namespace App\Entities;

use App\TraversalAlgorithm\PostOrder;

class Tree
{
    private static ?Tree $instance = null;
    private Node $root;

    private function __construct(){}

    //lazy instantiation version
    public static function getInstance(): Tree
    {
        if (self::$instance == null) {
            self::$instance = new Tree();
        }
        return self::$instance;
    }

    public function build(Node $node, NodeStack $operandsStack): void
    {
        $rightChild = $operandsStack->extractNodeFromStack();
        $leftChild = $operandsStack->extractNodeFromStack();
        $node->setRightChild($rightChild);
        $node->setLeftChild($leftChild);

        $this->setRoot($node);
        $operandsStack->addNodeToStack($this->root);
    }

    public function getRoot(): Node
    {
        return $this->root;
    }

    public function setRoot(Node $root): Tree
    {
        $this->root = $root;
        return $this;
    }

    public function traverse(Node $root,$nodeVisitor): void
    {
        $algorithmTraversal = new PostOrder();
        $algorithmTraversal->postOrderTraversal($root, $nodeVisitor);
    }
}