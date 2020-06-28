<?php


namespace App\Tests\Entities;


use App\Entities\NodeStack;
use App\Entities\OperandNode;
use App\Entities\Tree;
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    public Tree $tree;

    public function testGetInstance()
    {
        $this->assertInstanceOf(Tree::class, Tree::getInstance());
    }

    public function testGetRoot()
    {
        $tree = Tree::getInstance();
        $node = new OperandNode("-");

        $nodeLeft = new OperandNode("12");
        $nodeRight = new OperandNode("20");

        $node->setLeftChild($nodeLeft);
        $node->setRightChild($nodeRight);

        $tree->setRoot($node);
        $this->assertEquals($tree->getRoot()->getValue(), $node->getValue());
        $this->assertEquals($tree->getRoot()->getLeftChild()->getValue(), $node->getLeftChild()->getValue());
        $this->assertEquals($tree->getRoot()->getRightChild()->getValue(), $node->getRightChild()->getValue());
    }
}