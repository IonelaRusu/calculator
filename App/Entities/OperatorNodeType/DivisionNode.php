<?php


namespace App\Entities\OperatorNodeType;


use App\Entities\OperatorNode;
use App\Visitor\NodeVisitor;


class DivisionNode extends OperatorNode
{
    public function accept(NodeVisitor $nodeVisitor): void
    {
        $nodeVisitor->visitDivisionNode($this);
    }
}