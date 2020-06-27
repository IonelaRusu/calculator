<?php


namespace App\Validators;


use App\Exceptions\InvalidExpressionException;

class ExpressionValidator
{

    public function validateExpression(array $stack): void
    {
        if (empty($stack)) {
            throw new InvalidExpressionException("You can not have operators introduced, without enough operands.");
        }

        if (count($stack) == 1) {
            throw new InvalidExpressionException("You can not have an operator introduced, with less than two operands.");

        }
    }
}