<?php


namespace App\Validators;


use App\Exceptions\InvalidExpressionException;

class ExpressionValidator
{

    public function validateExpression(array $stack)
    {
        if(empty($stack)) {
            throw new InvalidExpressionException("You can not have operators introduces, without enough operands.\n");
        }

        if(count($stack) == 1) {
            throw new InvalidExpressionException("You can not have an operator introduces, with just one operand.\n");

        }
    }
}