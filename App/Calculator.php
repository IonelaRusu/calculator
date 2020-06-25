<?php


namespace App;


use App\Entities\NodeStack;
use App\Exceptions\ArithmeticException;
use App\Exceptions\ExitException;
use App\Exceptions\InvalidExpressionException;
use App\Exceptions\InvalidTypeException;
use App\Validators\ExpressionValidator;
use App\Validators\InputValidator;
use App\Visitor\NodeCalculationVisitor;

class Calculator
{
    public function stop()
    {
        echo "Quiting...\n";
        exit(0);
    }

    public function start($file, $mode): void
    {
        $stream = fopen($file, $mode);
        echo "\nHello, this is a command-line reverse polish notation calculator.\n";
        echo "\nIf you want to exit please press 'q'.\n";
        echo "\nIf you do not, then please enter your expression:\n";
        $operandsStack = new NodeStack();
        $validator = new InputValidator();
        $expressionValidator = new ExpressionValidator();
        $expression = new Expression($expressionValidator);

        while ($line = fgets(STDIN, 1024)) {

            $tokenArray = preg_split('/\s+/', $line, -1, PREG_SPLIT_NO_EMPTY);
            try{
                $isValidLine = $validator->validateLineInput($tokenArray);
            } catch (ExitException $e) {
                echo $e->getMessage() . "\n";
                break;
            }

            if ($isValidLine) {
                foreach ($tokenArray as $key => $token) {
                    try {
                        $type = $validator->getVerifiedInputType($token);
                        $expression->process($token, $type, $operandsStack);
                        if ($validator->validateInputFormatForCalculation($tokenArray, $type, $key)) {
                            $nodeVisitor = new NodeCalculationVisitor();
                            $expression->calculate($nodeVisitor);
                            $this->displayCalculationResult($operandsStack);
                        } else {
                            $this->displayInputOperators($tokenArray, $key, $type, $token);
                        }
                    } catch (InvalidTypeException $e) {
                        echo $e->getMessage() . "\n";
                        break 2;
                    } catch (InvalidExpressionException $e) {
                        echo $e->getMessage() . "\n";
                        break 2;
                    }  catch (ArithmeticException $e) {
                        echo $e->getMessage() . "\n";
                        break 2;
                    }
                }
            } else {
                break;
            }
        }

        fclose(STDIN);
        $this->stop();
    }

    public function displayInputOperators(array $tokenArray, int $key, string $type, string $token): void
    {
        if (count($tokenArray) == 1 && $key == 0 && $type == "operand") {
            echo $token . "\n";
        }
    }

    public function displayCalculationResult(NodeStack $operandsStack): void
    {
        $array = $operandsStack->getStack();
        $result = end($array);

        echo $result->getValue() . "\n";
    }
}