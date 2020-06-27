<?php


namespace App\Tests\Visitor;


use App\Entities\OperandNode;
use App\Entities\OperatorNodeType\DivisionNode;
use App\Entities\OperatorNodeType\MinusNode;
use App\Entities\OperatorNodeType\MultiplicationNode;
use App\Entities\OperatorNodeType\PlusNode;
use App\Exceptions\ArithmeticException;
use App\Visitor\NodeCalculationVisitor;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class NodeCalculationVisitorTest extends TestCase
{
    private NodeCalculationVisitor $nodeCalculationVisitor;
    public function setUp(): void
    {
       $this->nodeCalculationVisitor = new NodeCalculationVisitor();

    }

    public function testVisitDivisionNode(): void
    {
        $nodeMock = $this->getMockBuilder(DivisionNode::class)
            ->disableOriginalConstructor()->getMock();

        $this->setNodeChildren($nodeMock, "9", "3");

        $this->assertEquals("3", $this->nodeCalculationVisitor->visitDivisionNode($nodeMock));
    }

    public function testVisitDivisionNodeWithException(): void
    {
        $this->expectException(ArithmeticException::class);

        $nodeMock = $this->getMockBuilder(DivisionNode::class)
            ->disableOriginalConstructor()->getMock();

        $this->setNodeChildren($nodeMock, "9", "0");

        $this->nodeCalculationVisitor->visitDivisionNode($nodeMock);
    }

    public function testVisitMinusNode(): void
    {
        $nodeMock = $this->getMockBuilder(MinusNode::class)
            ->disableOriginalConstructor()->getMock();

        $this->setNodeChildren($nodeMock, "9", "3");

        $this->assertEquals("6", $this->nodeCalculationVisitor->visitMinusNode($nodeMock));
    }

    public function testVisitPlusNode(): void
    {
        $nodeMock = $this->getMockBuilder(PlusNode::class)
            ->disableOriginalConstructor()->getMock();

        $this->setNodeChildren($nodeMock, "9", "3");

        $this->assertEquals("12", $this->nodeCalculationVisitor->visitPlusNode($nodeMock));
    }

    public function testMultiplicationPlusNode(): void
    {
        $nodeMock = $this->getMockBuilder(MultiplicationNode::class)
            ->disableOriginalConstructor()->getMock();

        $this->setNodeChildren($nodeMock, "9", "3");

        $this->assertEquals("27", $this->nodeCalculationVisitor->visitMultiplicationNode($nodeMock));
    }

    public function setNodeChildren(MockObject $node, string $leftValue, string $rightValue): void
    {
        $nodeLeftMock = $this->getMockBuilder(OperandNode::class)
            ->disableOriginalConstructor()->getMock();
        $nodeLeftMock->method("getValue")->willReturn($leftValue);

        $nodeRightMock = $this->getMockBuilder(OperandNode::class)
            ->disableOriginalConstructor()->getMock();
        $nodeRightMock->method("getValue")->willReturn($rightValue);

        $node->method("getLeftChild")->willReturn($nodeLeftMock);
        $node->method("getRightChild")->willReturn($nodeRightMock);
    }
}