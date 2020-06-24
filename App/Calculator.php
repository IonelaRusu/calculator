<?php


namespace App;


use App\Entities\NodeStack;

class Calculator
{
    public function receiveInput($file, $mode)
    {
        $stream = fopen($file, $mode);
        echo "\nPlease enter your expression:\n";
        $operandsStack = new NodeStack();
        $validator = new Validator();
        $evaluator = new Evaluator();

        while ($line = fgets(STDIN, 1024)) {
            echo $line;

            $tokenArray = preg_split('/\s+/', $line, -1, PREG_SPLIT_NO_EMPTY);
            print_r($tokenArray);
            $isValidLine = $validator->validateLineInput($tokenArray);

            if ($isValidLine) {
                foreach ($tokenArray as $key => $token) {
                    $type = $validator->verifyInputType($token);

                    if ($type == "invalid") {
                        echo "Operands or operators were incorrectly introduced. Invalid type.";
                        return false;
                    }

                    $evaluator->process($type, $token, $operandsStack);
                }
            } else {
                break;
            }
            fclose(STDIN);
        }
    }
}