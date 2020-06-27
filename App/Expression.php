<?php


namespace App;


use App\Entities\NodeStack;
use App\Entities\OperandNode;
use App\Entities\OperatorNode;
use App\Entities\Tree;
use App\Exceptions\InvalidExpressionException;
use App\Exceptions\UnknownNodeTypeException;
use App\Factory\NodeFactoryProducer;
use App\Validators\ExpressionValidator;

class Expression
{
    private ExpressionValidator $expressionValidator;

    public function __construct(ExpressionValidator $expressionValidator)
    {
        $this->expressionValidator = $expressionValidator;
    }

    /**
     * @throws UnknownNodeTypeException
     * @throws InvalidExpressionException
     */
    public function process(string $token, string $type, NodeStack $nodeStack): void
    {
        $nodeFactory = new NodeFactoryProducer();
        $node = $nodeFactory->getNode($type , $token);
        $tree = Tree::getInstance();

        if ($node instanceof OperandNode) {
             $nodeStack->addNodeToStack($node);
        }

        if ($node instanceof OperatorNode) {
            $this->expressionValidator->validateExpression($nodeStack->getStack());
            $tree->build($node, $nodeStack);
            $tree->setRoot($node);
        }
    }

    public function calculate($nodeVisitor): void
    {
        $tree = Tree::getInstance();
        $node = $tree->getRoot();
            if ($node instanceof OperatorNode) {
                $tree->traverse($node, $nodeVisitor);
            }
    }
}