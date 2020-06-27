<?php


namespace App\Validators;


use App\Exceptions\ExitException;
use App\Exceptions\InvalidInputTypeException;

class InputValidator
{
    public function containsOnlyOperands(string $token): bool
    {
        return preg_match_all('/^-?(?:\d+|\d+\.\d+)$/', $token) ;
    }

    public function containsOnlyOperators(string $token): bool
    {
        return preg_match_all('/^[\-+*\/]$/', $token);
    }

    public function getVerifiedInputType(string $token): string
    {
        if ($this->containsOnlyOperands($token)){
            return "operand";
        }

        if ($this->containsOnlyOperators($token)){
            return "operator";
        }

        throw new InvalidInputTypeException("Operands or operators were incorrectly introduced. Invalid type." . "\n");
    }

    public function isValidInputFormatForCalculation(array $tokenArray, string $type, int $key): bool
    {
        $size = count($tokenArray);
        if ($type == "operator" && ($key == $size-1 || $key == 0)) {
            return true;
        }
        return false;
    }

    /**
     * @throws InvalidInputTypeException
     */
    public function isValidLineInput(array $tokenArray): bool
    {
        $size = count($tokenArray);
        if (empty($tokenArray)) {
            throw new InvalidInputTypeException("Invalid operator or operand.\n");
        }

        if (in_array( "q", $tokenArray)) {
            throw new ExitException();
        }

        if (count($tokenArray) > 1) {
            if ($this->getVerifiedInputType($tokenArray[$size-1]) == "operand") {
                throw new InvalidInputTypeException("Invalid input. An operator is missing or misplaced.\n");
            }
        }

        return true;
    }
}