<?php


namespace App\Entities\OperatorNodeType;


use App\Entities\OperatorNode;
use App\Visitor\NodeVisitor;

class MinusNode extends OperatorNode
{
    public function accept(NodeVisitor $nodeVisitor): void
    {
        $nodeVisitor->visitMinusNode($this);
    }
}