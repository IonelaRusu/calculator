<?php


namespace App\Validators;


use App\Exceptions\InvalidExpressionException;

class ExpressionValidator
{

    public function validateExpression(array $stack)
    {
        if(empty($stack)) {
            echo "You can not have an operator introduces, without any operands\n";
            throw new InvalidExpressionException();
        }

        if(count($stack) == 1) {
            echo "You can not have an operator introduces, with just one operand\n";
            throw new InvalidExpressionException();

        }
    }
}