<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Test\Puzzle\Day2;

use PHPUnit_Framework_TestCase as TestCase;

use function Thorr\AdventOfCode\Puzzle\Day2\ribbon;

class RibbonTest extends TestCase
{
    /**
     * @dataProvider validDataProvider
     */
    public function testValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, ribbon($input));
    }

    public function validDataProvider()
    {
        return [
            [ "1x1x1", 5 ],
            [ "1x1x1\n1x1x1", 10 ],
            [ "1x1x10", 14 ],
            [ "2x3x4", 34 ],
            [ "2x3x4\n\n", 34 ],
        ];
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testInvalidInput(string $input)
    {
        $this->setExpectedException(\InvalidArgumentException::class, "Input must only consist of a list of three integers per line, separated by 'x'");
        ribbon($input);
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
