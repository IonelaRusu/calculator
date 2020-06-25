<?php


namespace App;


use App\Entities\NodeStack;
use App\Entities\OperandNode;
use App\Entities\OperatorNode;
use App\Entities\Tree;
use App\Factory\NodeFactory;
use App\Validators\ExpressionValidator;

class Expression
{
    public ExpressionValidator $expressionValidator;
    public function __construct(ExpressionValidator $expressionValidator)
    {
        $this->expressionValidator = $expressionValidator;
    }

    public function process(string $type, string $token, NodeStack $operandsStack): void
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
            $tree->setRoot($node);
        }
    }

    public function calculate($operandsStack, $nodeVisitor): void
    {
        $tree = Tree::getInstance();
        $node = $tree->getRoot();
            if ($node instanceof OperatorNode) {
                $tree->traverse($node, $nodeVisitor);
            }
    }
}