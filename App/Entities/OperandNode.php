<?php


namespace App\Entities;


use App\Visitor\NodeVisitor;

class OperandNode extends Node
{
    public function accept(NodeVisitor $nodeVisitor): void
    {
        $nodeVisitor->visitOperandNode($this);
    }
}