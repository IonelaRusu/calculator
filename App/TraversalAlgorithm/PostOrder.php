<?php


namespace App\TraversalAlgorithm;


use App\Entities\Node;
use App\Visitor\NodeVisitor;

class PostOrder
{
    public function postOrderTraversal(?Node $node, NodeVisitor $nodeVisitor)
    {
        if ($node == null) {
            return ;
        }

        $this->postOrderTraversal($node->getLeftChild(), $nodeVisitor);
        $this->postOrderTraversal($node->getRightChild(), $nodeVisitor);
        $node->accept($nodeVisitor);
    }
}