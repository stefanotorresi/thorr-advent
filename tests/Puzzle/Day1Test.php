<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Test\Puzzle;

use PHPUnit_Framework_TestCase as TestCase;
use Thorr\AdventOfCode\Puzzle;

class Day1Test extends TestCase
{
    /**
     * @var Puzzle\Day1
     */
    protected $puzzle;

    protected function setUp()
    {
        $this->puzzle = new Puzzle\Day1();
    }

    /**
     * @dataProvider floorValidDataProvider
     */
    public function testFloorValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, $this->puzzle->floor($input));
    }

    public function floorValidDataProvider()
    {
        return [
            [ '(', 1 ],
            [ ')', -1 ],
            [ '()', 0 ],
            [ '(()))))', -3 ],
        ];
    }

    /**
     * @dataProvider floorInvalidDataProvider
     */
    public function testFloorInvalidInput(string $input)
    {
        $this->setExpectedException(\InvalidArgumentException::class, "Input must only consist of '(' or ')'");
        $this->puzzle->floor($input);
    }

    public function floorInvalidDataProvider()
    {
        return [
            [ 'foobar' ],
            [ '' ],
            [ '(z' ],
            [ 'a(' ],
            [ 'a(z' ],
        ];
    }

    /**
     * @dataProvider basementValidDataProvider
     */
    public function testBasementValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, $this->puzzle->basement($input));
    }

    public function basementValidDataProvider()
    {
        return [
            [ '(()))))', 5 ],
            [ '()())', 5 ],
            [ ')', 1 ],
        ];
    }

    /**
     * @dataProvider basementInvalidDataProvider
     */
    public function testBasementInvalidInput(string $input, string $message)
    {
        $this->setExpectedException(\InvalidArgumentException::class, $message);
        $this->puzzle->basement($input);
    }

    public function basementInvalidDataProvider()
    {
        $noBasementMsg = "Santa never went to the basement";
        $malformedInputMsg = "Input must only consist of '(' or ')'";

        return [
            [ '(', $noBasementMsg ],
            [ '(((((', $noBasementMsg ],
            [ '()', $noBasementMsg ],
            [ 'foobar', $malformedInputMsg ],
        ];
    }
}
