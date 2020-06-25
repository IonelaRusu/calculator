<?php


namespace App;


use App\Entities\NodeStack;
use App\Exceptions\ExitException;
use App\Exceptions\InvalidExpressionException;
use App\Validators\ExpressionValidator;
use App\Validators\InputValidator;
use App\Visitor\NodeCalculationVisitor;

class Calculator
{
    public function stop()
    {
        echo "Goodbye!\n";
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
                break;
            }

            if ($isValidLine) {
                foreach ($tokenArray as $key => $token) {
                    $type = $validator->verifyInputType($token);

                    if ($type == "invalid") {
                        echo "Operands or operators were incorrectly introduced. Invalid type.\n";
                        break;
                    }
                    try {
                        $expression->process($type, $token, $operandsStack);
                        if($type == "operator" && ($key == count($tokenArray)-1 || $key == 0)){
                            $nodeVisitor = new NodeCalculationVisitor();
                            $expression->calculate($operandsStack, $nodeVisitor);
                        } else {
                            echo $token . "\n";
                        }

                    } catch (InvalidExpressionException $e) {
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
}