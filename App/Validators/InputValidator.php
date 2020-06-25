<?php


namespace App\Validators;


use App\Exceptions\ExitException;
use App\Exceptions\InvalidTypeException;

class InputValidator
{
    public function containsOnlyOperands(string $token): int
    {
        return preg_match_all('/^-?(?:\d+|\d+\.\d+)$/', $token) ;
    }

    public function containsOnlyOperators(string $token): int
    {
        return preg_match_all('/^[\-+*\\/^]$/', $token);
    }

    public function getVerifiedInputType(string $token): string
    {
        if ($this->containsOnlyOperands($token)){
            return "operand";
        }

        if ($this->containsOnlyOperators($token)){
            return "operator";
        }

        throw new InvalidTypeException("Operands or operators were incorrectly introduced. Invalid type." . "\n");
    }

    public function validateInputFormatForCalculation(array $tokenArray, string $type, int $key): bool
    {
        $size = count($tokenArray);
        if ($type == "operator" && ($key == $size-1 || $key == 0)) {
            return true;
        }
        return false;
    }

    public function validateLineInput(array $tokenArray): bool
    {
        $size = count($tokenArray);
        if (empty($tokenArray)) {
            echo "Invalid operator or operand.\n";
        }

        if (in_array( "q", $tokenArray)) {
            throw new ExitException();
        }

        if (count($tokenArray) > 1) {
            if ($this->getVerifiedInputType($tokenArray[$size-1]) == "operand") {
                echo "Invalid expression. An operator is missing or misplaced.\n";
                return false;
            }
        }

//        if (count($tokenArray) == 2 && $this->verifyInputType($tokenArray[$size-1]) == "operator" )
//        {
//            echo "Invalid expression. You can not form an logical expression.\n";
//            return false;
//        }

        return true;
    }
}