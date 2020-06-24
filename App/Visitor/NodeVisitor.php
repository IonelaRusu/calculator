<?php


namespace App\Visitor;

use App\Entities\OperatorNodeType\DivisionNode;
use App\Entities\OperatorNodeType\MinusNode;
use App\Entities\OperatorNodeType\MultiplicationNode;
use App\Entities\OperatorNodeType\PlusNode;

interface NodeVisitor
{
    public function visitMinusNode(MinusNode $Node): void;
    public function visitPlusNode(PlusNode $Node): void;
    public function visitMultiplicationNode(MultiplicationNode $Node): void;
    public function visitDivisionNode(DivisionNode $Node): void;
}