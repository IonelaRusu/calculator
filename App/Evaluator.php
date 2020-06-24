<?php


namespace App;


use App\Entities\NodeStack;
use App\Entities\OperandNode;
use App\Entities\OperatorNode;
use App\Entities\Tree;
use App\Factory\NodeFactory;

class Evaluator
{
    public function process(string $type, string $token, NodeStack $operandsStack)
    {
        $nodeFactory = new NodeFactory();
        $node = $nodeFactory->makeNode($type, $token);
        $tree = Tree::getInstance(); //return same instance

        if ($node instanceof OperandNode) {
            $operandsStack->addNodeToStack($node);
        }

        if ($node instanceof OperatorNode) {
            if(empty($operandsStack)) {
                echo "You can not have an operator introduces, without any operands";
                return ; ///something
            }
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