<?php

namespace App\Visitor;

use App\Entities\OperatorNodeType\DivisionNode;
use App\Entities\OperatorNodeType\MinusNode;
use App\Entities\OperatorNodeType\MultiplicationNode;
use App\Entities\OperatorNodeType\PlusNode;

class NodeCalculationVisitor implements NodeVisitor
{
    public function visitMinusNode(MinusNode $Node): void
    {

    }

    public function visitPlusNode(PlusNode $Node): void
    {
        // TODO: Implement visitPlusNode() method.
    }

    public function visitMultiplicationNode(MultiplicationNode $Node): void
    {
        // TODO: Implement visitMultiplicationNode() method.
    }

    public function visitDivisionNode(DivisionNode $Node): void
    {
        // TODO: Implement visitDivisionNode() method.
    }
}