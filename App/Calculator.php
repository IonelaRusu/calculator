<?php


namespace App;


use App\Entities\NodeStack;
use App\Exceptions\ArithmeticException;
use App\Exceptions\ExitException;
use App\Exceptions\InvalidExpressionException;
use App\Exceptions\InvalidInputTypeException;
use App\Exceptions\UnknownNodeTypeException;
use App\Validators\ExpressionValidator;
use App\Validators\InputValidator;
use App\Visitor\NodeCalculationVisitor;

class Calculator
{
    const LENGTH = 1024;

    public function stop($fd): void
    {
        echo "Quiting...\n";
        fclose($fd);
        exit(0);
    }

    public function start($fd): void
    {
        echo "\nHello, this is a command-line reverse polish notation calculator.\n";
        echo "\nIf you want to exit please press 'q'.\n";
        echo "\nIf you do not, then please enter your expression:\n";
        $nodesStack = new NodeStack();
        $validator = new InputValidator();
        $expressionValidator = new ExpressionValidator();
        $expression = new Expression($expressionValidator);

        while (($line = fgets($fd, self::LENGTH))) {
            while (strpos($line, "\n") == false && !feof($fd)) {
                $line .= fgets($fd, self::LENGTH);
            }
            $tokenArray = preg_split('/\s+/', $line, -1, PREG_SPLIT_NO_EMPTY);
            try {
                $isValidLine = $validator->isValidLineInput($tokenArray);
            } catch (ExitException $e) {
                echo $e->getMessage() . "\n";
                break;
            } catch (InvalidInputTypeException $e) {
                echo $e->getMessage() . "\n";
                break;
            }

            if ($isValidLine) {
                foreach ($tokenArray as $key => $token) {
                    try {
                        $type = $validator->getVerifiedInputType($token);
                        $expression->process($token, $type, $nodesStack);
                        if ($validator->isValidInputFormatForCalculation($tokenArray, $type, $key)) {
                            $nodeVisitor = new NodeCalculationVisitor();
                            $expression->calculate($nodeVisitor);
                            $this->displayCalculationResult($nodesStack);
                        } else {
                            $this->displayInputOperators($tokenArray, $key, $type, $token);
                        }
                    } catch (InvalidInputTypeException $e) {
                        echo $e->getMessage() . "\n";
                        break 2;
                    } catch (InvalidExpressionException $e) {
                        echo $e->getMessage() . "\n";
                        break 2;
                    }  catch (ArithmeticException $e) {
                        echo $e->getMessage() . "\n";
                        break 2;
                    } catch (UnknownNodeTypeException $e) {
                        echo $e->getMessage() . "\n";
                        break 2;
                    }
                }
            } else {
                break;
            }
        }

        $this->stop($fd);
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