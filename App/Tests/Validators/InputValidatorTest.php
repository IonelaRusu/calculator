<?php


namespace App\Tests\Validators;


use App\Exceptions\ExitException;
use App\Exceptions\InvalidInputTypeException;
use App\Validators\InputValidator;
use App\Visitor\NodeCalculationVisitor;
use PHPUnit\Framework\TestCase;

class InputValidatorTest extends TestCase
{
    private InputValidator $inputValidator;

    public function setUp(): void
    {
        $this->inputValidator = new InputValidator();

    }

    /**
     * @dataProvider operandsProvider
     */
    public function testContainsOnlyOperands($token, $expected): void
    {
        $result = $this->inputValidator->containsOnlyOperands($token);

        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider operatorsProvider
     */
    public function testContainsOnlyOperators($token, $expected): void
    {
        $result = $this->inputValidator->containsOnlyOperators($token);

        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider tokenTypeProvider
     */
    public function testGetVerifiedInputType($token, $expected): void
    {
        $result = $this->inputValidator->getVerifiedInputType($token);

        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider tokenWrongTypeProvider
     */
    public function testGetVerifiedInputTypeWithException($token): void
    {
        $this->expectException(InvalidInputTypeException::class);
        $this->inputValidator->getVerifiedInputType($token);
    }

    /**
     * @dataProvider inputFormatProvider
     */
    public function testIsValidInputFormatForCalculation($data, $expected): void
    {
        $result = $this->inputValidator->isValidInputFormatForCalculation($data['tokenArray'], $data['type'], $data['key']);
        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider inputLineProvider
     */
    public function testIsValidLineInput($tokenArray, $expected): void
    {
        $result = $this->inputValidator->isValidLineInput($tokenArray);
        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider inputLineProviderExitException
     */
    public function testIsValidLineInputWithExitException($tokenArray): void
    {
        $this->expectException(ExitException::class);
        $this->inputValidator->isValidLineInput($tokenArray);
    }

    /**
     * @dataProvider inputLineProviderInvalidInputTypeException
     */
    public function testIsValidLineInputWithInvalidInputException($tokenArray): void
    {
        $this->expectException(InvalidInputTypeException::class);
        $this->inputValidator->isValidLineInput($tokenArray);
    }

    public static function operatorsProvider(): array
    {
        return[
            [
                "token" => "4abc",
                "expected" => false
            ],
            [
                "token" => "+abc",
                "expected" => false
            ],
            [
                "token" => "+423",
                "expected" => false
            ],
            [
                "token" => "#$%",
                "expected" => false
            ],
            [
                "token" => "  ",
                "expected" => false
            ],
            [
                "token" => " + ",
                "expected" => false
            ],
            [
                "token" => "-42",
                "expected" => false
            ],
            [
                "token" => "5.00",
                "expected" => false
            ],
            [
                "token" => "-42345.00",
                "expected" => false
            ],
            [
                "token" => "^",
                "expected" => false
            ],
            [
                "token" => "-",
                "expected" => true
            ],
            [
                "token" => "+",
                "expected" => true
            ],
            [
                "token" => "/",
                "expected" => true
            ],
            [
                "token" => "*",
                "expected" => true
            ],
        ];
    }

    public static function operandsProvider(): array
    {
        return[
            [
                "token" => "+",
                "expected" => false
            ],
            [
                "token" => "+--/",
                "expected" => false
            ],
            [
                "token" => "a",
                "expected" => false
            ],
            [
                "token" => "abc",
                "expected" => false
            ],
            [
                "token" => "4abc",
                "expected" => false
            ],
            [
                "token" => "4#",
                "expected" => false
            ],
            [
                "token" => "#$4%",
                "expected" => false
            ],
            [
                "token" => "   ",
                "expected" => false
            ],
            [
                "token" => " 4 ",
                "expected" => false
            ],
            [
                "token" => "1",
                "expected" => true
            ],
            [
                "token" => "12",
                "expected" => true
            ],
            [
                "token" => "9999999",
                "expected" => true
            ],
            [
                "token" => "-42",
                "expected" => true
            ],
            [
                "token" => "5.00",
                "expected" => true
            ],
            [
                "token" => "-42345.00",
                "expected" => true
            ],
        ];
    }

    public static function tokenTypeProvider(): array
    {
        return[
            [
                "token" => "+",
                "expected" => "operator"
            ],
            [
                "token" => "122",
                "expected" => "operand"
            ],
        ];
    }

    public static function tokenWrongTypeProvider(): array
    {
        return[
            [
                "token" => "%@#%#@",
            ],
            [
                "token" => "      ",
            ],
        ];
    }

    public static function inputFormatProvider(): array
    {
        return[
            [
                'data' =>
                    [
                        "tokenArray" => explode(" ", "$ @ # % #"),
                        "type" => "operand",
                        "key" => 3,
                    ],
                "expected" => false
            ],
            [
                'data' =>
                    [
                        "tokenArray" => explode(" ", "+ @# %#"),
                        "type" => "operand",
                        "key" => 3,
                    ],
                "expected" => false
            ],
            [
                'data' =>
                    [
                        "tokenArray" => explode(" ", "- 4  3 4 2 - 4 4"),
                        "type" => "operand",
                        "key" => 0,
                    ],
                "expected" => false
            ],
            [
                'data' =>
                    [
                        "tokenArray" => explode(" ", "56+"),
                        "type" => "operator",
                        "key" => 2,
                    ],
                "expected" => false
            ],
            [
                'data' =>
                    [
                        "tokenArray" => explode(" ", "5 6 +"),
                        "type" => "operator",
                        "key" => 2,
                    ],
                "expected" => true
            ],
            [
                'data' =>
                    [
                        "tokenArray" => explode(" ", "/"),
                        "type" => "operator",
                        "key" => 0,
                    ],
                "expected" => true
            ],
        ];
    }

    public static function inputLineProvider(): array
    {
        return[
            [
                "tokenArray" => explode(" ", "5 6 +"),
                "expected" => true
            ],

            [
                "tokenArray" => explode(" ", "5 6 1 + *"),
                "expected" => true
            ],

            [
                "tokenArray" => explode(" ", "5 6 + 9 *"),
                "expected" => true
            ],
        ];
    }

    public static function inputLineProviderExitException(): array
    {
        return[
            [
                "tokenArray" => explode(" ", "5 6 + q"),
            ],
            [
                "tokenArray" => explode(" ", "q   "),
            ],
            [
                "tokenArray" => explode(" ", "q  5"),
            ],
            [
                "tokenArray" => explode(" ", "%^$^ q"),
            ],
        ];
    }

    public static function inputLineProviderInvalidInputTypeException(): array
    {
        return[
            [
                "tokenArray" => explode(" ",  "   "),
            ],

            [
                "tokenArray" => explode(" ", "- * / 4"),
            ],

            [
                "tokenArray" => explode(" ", "- 5"),
            ],

            [
                "tokenArray" => explode(" ", "5 6 + 5"),
            ],
        ];
    }
}