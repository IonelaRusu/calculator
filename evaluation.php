<?php

use App\Entities\OperandNode;
use App\Entities\Tree;


function containsOnlyOperands(string $token): int
{
   return preg_match_all('/^-?(?:\d+|\d+\.\d+)$/', $token) ;
}

function containsOnlyOperators(string $token): int
{
    return preg_match_all('/^[\-+*\\/^]$/', $token);
}

function verifyInputType(string $token): string
{
    if (containsOnlyOperands($token)){
        return "operands";
    }
    if (containsOnlyOperators($token)){
        return "operators";
    }

    return "invalid";
}


function addOperandsToStack(array $operandsStack, string $token): array
{
    $node = new OperandNode($token);
    array_push($operandsStack, $node);
    return $operandsStack;
}


function buildTree(array $operandsStack, string $token): array
{
    array_pop($operandsStack);
    return $operandsStack;
}

// START
$stream = fopen('php://stdin', 'r');
echo "\nPlease enter your expression:\n";
$operandsStack = [];
$tree = Tree::getInstance();

while ($line = fgets(STDIN, 1024)) {
    echo $line;
    $token = strtok($line, " ");
    while ($token !== false) {
        echo "$token\n";
        switch (verifyInputType($token)) {
            case "operands":
                echo "operands";
                addOperandsToStack($operandsStack, $token);
                break;
            case "operators":
                echo "operators";
                $tree->build($operandsStack, $token);
                break;
            case "invalid":
                echo "Operands or operators were incorrectly introduced. Invalid type.";
                break;
            default:
                echo "Something go wrong!";
                break 3;
        }
        $token = strtok(" ");
    }
}

fclose( STDIN );