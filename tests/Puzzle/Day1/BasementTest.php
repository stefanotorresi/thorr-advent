<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Test\Puzzle\Day1;

use PHPUnit_Framework_TestCase as TestCase;

use function Thorr\AdventOfCode\Puzzle\Day1\basement;

class BasementTest extends TestCase
{
    /**
     * @dataProvider validDataProvider
     */
    public function testValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, basement($input));
    }

    public function validDataProvider()
    {
        return [
            [ '(()))))', 5 ],
            [ '()())', 5 ],
            [ ')', 1 ],
        ];
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testInvalidInput(string $input, string $message)
    {
        $this->setExpectedException(\InvalidArgumentException::class, $message);
        basement($input);
    }

    public function invalidDataProvider()
    {
        $noBasementMsg = "Santa never went to the basement";
        $malformedInputMsg = "Input must only consist of '(' or ')'";

        return [
            [ '(', $noBasementMsg ],
            [ '(((((', $noBasementMsg ],
            [ 'foobar', $malformedInputMsg ],
        ];
    }
}
