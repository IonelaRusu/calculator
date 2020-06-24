<?php


namespace App;


use App\Entities\NodeStack;
use App\Entities\OperandNode;
use App\Entities\OperatorNode;
use App\Entities\Tree;
use App\Exceptions\InvalidExpressionException;
use App\Factory\NodeFactory;
use App\Validators\ExpressionValidator;

class Expression
{
    public ExpressionValidator $expressionValidator;
    public function __construct(ExpressionValidator $expressionValidator)
    {
        $this->expressionValidator = $expressionValidator;
    }

    public function process(string $type, string $token, NodeStack $operandsStack)
    {
        $nodeFactory = new NodeFactory();
        $node = $nodeFactory->makeNode($type, $token);
        $tree = Tree::getInstance(); //return same instance

        if ($node instanceof OperandNode) {
            $operandsStack->addNodeToStack($node);
        }

        if ($node instanceof OperatorNode) {
            $this->expressionValidator->validateExpression($operandsStack->getStack());

            $tree->build($node, $operandsStack);
        }

        if (count($operandsStack->getStack()) == 1) {
            $node = $operandsStack->extractNodeFromStack();
            if ($node instanceof OperatorNode) {
                //tree evaluation
            }
        }
    }
}