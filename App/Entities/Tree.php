<?php

namespace App\Entities;

use App\TraversalAlgorithm\PostOrder;
use App\Visitor\NodeVisitor;

class Tree
{
    private static ?Tree $instance = null;
    private Node $root;

    private function __construct(){}

    public static function getInstance(): Tree
    {
        if (self::$instance == null) {
            self::$instance = new Tree();
        }
        return self::$instance;
    }

    public function build(Node $node, NodeStack $nodeStack): void
    {
        $rightChild = $nodeStack->extractNodeFromStack();
        $leftChild = $nodeStack->extractNodeFromStack();
        $node->setRightChild($rightChild);
        $node->setLeftChild($leftChild);

        $this->setRoot($node);
        $nodeStack->addNodeToStack($this->root);
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

    public function traverse(Node $root, NodeVisitor $nodeVisitor): void
    {
        $algorithmTraversal = new PostOrder();
        $algorithmTraversal->postOrderTraversal($root, $nodeVisitor);
    }
}