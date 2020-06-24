<?php


namespace App;


class Validator
{
    public function containsOnlyOperands(string $token): int
    {
        return preg_match_all('/^-?(?:\d+|\d+\.\d+)$/', $token) ;
    }

    public function containsOnlyOperators(string $token): int
    {
        return preg_match_all('/^[\-+*\\/^]$/', $token);
    }

    public function verifyInputType(string $token): string
    {
        if ($this->containsOnlyOperands($token)){
            return "operand";
        }
        if ($this->containsOnlyOperators($token)){
            return "operator";
        }

        return "invalid";
    }

    public function validateLineInput(array $tokenArray): bool
    {
        $size = count($tokenArray);
        if (empty($tokenArray)) {
            echo "Invalid operator or operand.";
        }
        if (count($tokenArray) > 1) {
            if ($this->verifyInputType($tokenArray[$size-1]) != "operators") {
                echo "Invalid expression. An operator is missing or missplaced";
                return false;
            }
        }

        if (count($tokenArray) == 2 && $this->verifyInputType($tokenArray[$size-1]) == "operators" )
        {
            echo "Invalid expression. You can not form an logical expression";
            return false;
        }
        return true;
    }
}