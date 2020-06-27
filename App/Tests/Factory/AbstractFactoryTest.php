<?php


namespace App\Tests\Factory;


use App\Entities\Node;
use App\Entities\OperandNode;
use App\Factory\AbstractFactory;
use PHPUnit\Framework\TestCase;

class AbstractFactoryTest extends TestCase
{
    protected $anonymousAbstractFactoryClass;

    protected function setUp(): void
    {
        parent::setUp();
        $this->anonymousAbstractFactoryClass = new class extends AbstractFactory {

            protected function makeNode(string $tokenType): Node{}

            public function returnThis()
            {
                return $this;
            }
        };
    }

    public function testAbstractFactoryClassInstance()
    {
        $this->assertInstanceOf(
            AbstractFactory::class,
            $this->anonymousAbstractFactoryClass->returnThis()
        );
    }
}