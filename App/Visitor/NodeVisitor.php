<?php


namespace App\Visitor;

use App\Entities\OperandNode;
use App\Entities\OperatorNodeType\DivisionNode;
use App\Entities\OperatorNodeType\MinusNode;
use App\Entities\OperatorNodeType\MultiplicationNode;
use App\Entities\OperatorNodeType\PlusNode;

interface NodeVisitor
{
    public function visitMinusNode(MinusNode $node): float;
    public function visitPlusNode(PlusNode $node): float;
    public function visitMultiplicationNode(MultiplicationNode $node): float;
    public function visitDivisionNode(DivisionNode $node): float;
    public function visitOperandNode(OperandNode $node): float;
}