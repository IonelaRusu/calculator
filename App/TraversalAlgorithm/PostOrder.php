<?php


namespace App\TraversalAlgorithm;

//postorder: left, right, root
use App\Entities\Node;
use App\Visitor\NodeVisitor;

class PostOrder
{
    public function postOrderTraversal(?Node $node, NodeVisitor $nodeVisitor)
    {
        if ($node == null) {
            return ;
        }

        $this->postOrderTraversal($node->getLeftChild(),$nodeVisitor);
        $this->postOrderTraversal($node->getRightChild(),$nodeVisitor);
        $node->accept($nodeVisitor);
        echo $node->getValue() . "\n";
    }

}