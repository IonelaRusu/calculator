<?php


namespace App\Tests\Factory;


use App\Entities\OperandNode;
use App\Entities\OperatorNodeType\DivisionNode;
use App\Entities\OperatorNodeType\MinusNode;
use App\Entities\OperatorNodeType\MultiplicationNode;
use App\Entities\OperatorNodeType\PlusNode;
use App\Factory\OperatorFactory;
use PHPUnit\Framework\TestCase;

class OperatorFactoryTest extends TestCase
{
    private OperatorFactory $operatorFactory;

    public function setUp(): void
    {
        $this->operatorFactory = new OperatorFactory();
    }

    public function testGetMinusNodeTest(): void
    {
        $expectedNode = $this->operatorFactory->getNode("-");
        $this->assertInstanceOf(MinusNode::class, $expectedNode);
    }

    public function testGePlusNodeTest(): void
    {
        $expectedNode = $this->operatorFactory->getNode("+");
        $this->assertInstanceOf(PlusNode::class, $expectedNode);
    }

    public function testGeDivisionNodeTest(): void
    {
        $expectedNode = $this->operatorFactory->getNode("/");
        $this->assertInstanceOf(DivisionNode::class, $expectedNode);
    }

    public function testGeMultiplicationNodeTest(): void
    {
        $expectedNode = $this->operatorFactory->getNode("*");
        $this->assertInstanceOf(MultiplicationNode::class, $expectedNode);
    }
}