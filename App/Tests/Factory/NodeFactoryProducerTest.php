<?php


namespace App\Tests\Factory;


use App\Entities\OperandNode;

use App\Entities\OperatorNodeType\DivisionNode;
use App\Entities\OperatorNodeType\MinusNode;
use App\Exceptions\UnknownNodeTypeException;
use App\Factory\NodeFactoryProducer;
use App\Factory\OperatorFactory;
use PHPUnit\Framework\TestCase;

class NodeFactoryProducerTest extends TestCase
{
    private NodeFactoryProducer $nodeFactoryProducer;
    public function setUp(): void
    {
        $this->nodeFactoryProducer = new NodeFactoryProducer();
    }

    public function testGetNodeWithOperandType(): void
    {
        $expectedNode = $this->nodeFactoryProducer->getNode("operand", "2");
        $this->assertInstanceOf(OperandNode::class, $expectedNode);
    }

    public function testGetNodeWithOperatorType(): void
    {
        $operatorFactoryMock = $this->getMockBuilder(OperatorFactory::class)
            ->disableOriginalConstructor()->getMock();

        $divisionNodeMock = $this->getMockBuilder(DivisionNode::class)
            ->disableOriginalConstructor()->getMock();

        $operatorFactoryMock->method("getNode")->with(["token" => "2"])->willReturn($divisionNodeMock);
        $expectedNode = $this->nodeFactoryProducer->getNode("operator", "-");
        $this->assertInstanceOf(MinusNode::class, $expectedNode);
    }

    public function testGetNodeWithUnknownType(): void
    {
        $this->expectException(UnknownNodeTypeException::class);
        $this->nodeFactoryProducer->getNode("operator", "$@#%");
    }
}