<?php


namespace App\Tests\Entities;


use App\Entities\Node;
use App\Entities\NodeStack;
use App\Entities\OperandNode;
use PHPUnit\Framework\TestCase;

class NodeStackTest extends TestCase
{
    protected NodeStack $nodeStack;

    protected function setUp(): void
    {
        parent::setUp();
        $this->nodeStack = new NodeStack();
    }

    public function testGetEmptyStack(): void
    {
        $this->assertEmpty($this->nodeStack->getStack());
    }

    public function testAddAndExtractNode(): void
    {
        $node = new OperandNode("29");
        $this->nodeStack->addNodeToStack($node);
        $extractedNode = $this->nodeStack->extractNodeFromStack();
        $this->assertInstanceOf(Node::class, $extractedNode );
        $this->assertEquals($node->getValue(), $extractedNode->getValue());
        $this->assertNull($extractedNode->getLeftChild());
        $this->assertNull($extractedNode->getRightChild());
    }
}