<?php

namespace App\Visitor;

use App\Entities\OperandNode;
use App\Entities\OperatorNodeType\DivisionNode;
use App\Entities\OperatorNodeType\MinusNode;
use App\Entities\OperatorNodeType\MultiplicationNode;
use App\Entities\OperatorNodeType\PlusNode;
use App\Exceptions\ArithmeticException;

class NodeCalculationVisitor implements NodeVisitor
{
    public function visitMinusNode(MinusNode $node): float
    {
        $result = floatval($node->getLeftChild()->getValue()) - floatval($node->getRightChild()->getValue());
        $node->setValue((string)$result);

        return $result;
    }

    public function visitPlusNode(PlusNode $node): float
    {
        $result = floatval($node->getLeftChild()->getValue()) + floatval($node->getRightChild()->getValue());
        $node->setValue((string)$result);

        return $result;
    }

    public function visitMultiplicationNode(MultiplicationNode $node): float
    {
       $result = floatval($node->getLeftChild()->getValue()) * floatval($node->getRightChild()->getValue());
       $node->setValue((string)$result);

       return $result;
    }

    /**
     * @throws ArithmeticException
     */
    public function visitDivisionNode(DivisionNode $node): float
    {
        if (floatval($node->getRightChild()->getValue()) != 0) {
            $result = floatval($node->getLeftChild()->getValue()) / floatval($node->getRightChild()->getValue());
            $node->setValue((string)$result);

            return $result;
        } else {
            throw new ArithmeticException("Divided by 0 Exception");
        }
    }

    public function visitOperandNode(OperandNode $node): float
    {
       return floatval($node->getValue());
    }
}