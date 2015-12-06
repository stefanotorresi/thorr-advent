<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Test\Puzzle\Day1;

use function Thorr\AdventOfCode\Puzzle\Day1\floor;

use PHPUnit_Framework_TestCase as TestCase;


class FloorTest extends TestCase
{
    /**
     * @dataProvider validDataProvider
     */
    public function testValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, floor($input));
    }

    public function validDataProvider()
    {
        return [
            [ '(', 1 ],
            [ ')', -1 ],
            [ '()', 0 ],
            [ '(()))))', -3 ],
        ];
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testInvalidInput(string $input)
    {
        $this->setExpectedException(\InvalidArgumentException::class, "Input must only consist of '(' or ')'");
        floor($input);
    }

    public function invalidDataProvider()
    {
        return [
            [ 'foobar' ],
            [ '' ],
            [ '(z' ],
            [ 'a(' ],
            [ 'a(z' ],
        ];
    }
}
