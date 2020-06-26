<?php


namespace App\Entities\OperatorNodeType;


use App\Entities\OperatorNode;
use App\Visitor\NodeVisitor;

class PlusNode extends OperatorNode
{
    public function accept(NodeVisitor $nodeVisitor): void
    {
        $nodeVisitor->visitPlusNode($this);
    }
}