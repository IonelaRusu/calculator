<?php


namespace App\Entities;


use App\Visitor\NodeVisitor;

abstract class OperatorNode extends Node
{
    abstract public function accept(NodeVisitor $nodeVisitor): void;
}