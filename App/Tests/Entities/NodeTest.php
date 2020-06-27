<?php


namespace App\Tests\Entities;

use App\Entities\Node;
use App\Entities\OperandNode;
use App\Visitor\NodeVisitor;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    protected $anonymousAbstractClass;
    protected string $value = "+";

    protected function setUp(): void
    {
        parent::setUp();
        $this->anonymousAbstractClass = new class($this->value) extends Node {

            public function accept(NodeVisitor $nodeVisitor): void{}

            public function returnThis()
            {
                return $this;
            }
        };
    }

    public function testAbstractClassInstance()
    {
        $this->assertInstanceOf(
            Node::class,
            $this->anonymousAbstractClass->returnThis()
        );
    }

    public function testAbstractClassGettersAndSettersWithOldValue(): void
    {
        $this->assertNull($this->anonymousAbstractClass->getLeftChild());
        $this->assertNull($this->anonymousAbstractClass->getRightChild());

        $this->anonymousAbstractClass
            ->setLeftChild(new OperandNode("12"))
            ->setRightChild(new OperandNode("29"));

        $this->assertEquals("+", $this->anonymousAbstractClass->getValue());
        $this->assertEquals("12", $this->anonymousAbstractClass->getLeftChild()->getValue());
        $this->assertEquals("29", $this->anonymousAbstractClass->getRightChild()->getValue());
    }

    public function testAbstractClassGettersAndSettersWithNewValue(): void
    {
        $this->assertEquals("+", $this->anonymousAbstractClass->getValue());
        $this->assertNull($this->anonymousAbstractClass->getLeftChild());
        $this->assertNull($this->anonymousAbstractClass->getRightChild());

        $this->anonymousAbstractClass
            ->setValue("-")
            ->setLeftChild(new OperandNode("12"))
            ->setRightChild(new OperandNode("29"));

        $this->assertEquals("-", $this->anonymousAbstractClass->getValue());
        $this->assertEquals("12", $this->anonymousAbstractClass->getLeftChild()->getValue());
        $this->assertEquals("29", $this->anonymousAbstractClass->getRightChild()->getValue());
    }
}