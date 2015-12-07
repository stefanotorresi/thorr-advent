<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Test\Puzzle\Day2;

use PHPUnit_Framework_TestCase as TestCase;

use function Thorr\AdventOfCode\Puzzle\Day2\paperAmount;

class PaperAmountTest extends TestCase
{
    /**
     * @dataProvider validDataProvider
     */
    public function testValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, paperAmount($input));
    }

    public function validDataProvider()
    {
        return [
            [ "1x1x1", 7 ],
            [ "1x1x1\n1x1x1", 14 ],
            [ "1x1x10", 43 ],
            [ "2x3x4", 58 ],
            [ "2x3x4\n\n", 58 ],
        ];
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testInvalidInput(string $input)
    {
        $this->setExpectedException(\InvalidArgumentException::class, "Input must only consist of a list of three integers per line, separated by 'x'");
        paperAmount($input);
    }

    public function invalidDataProvider()
    {
        return [
            [ 'foobar' ],
            [ '10x' ],
            [ '10x10x' ],
            [ '10x10x10x10' ],
        ];
    }
}
