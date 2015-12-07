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

class Day2Test extends TestCase
{
    /**
     * @var Puzzle\Day2
     */
    protected $puzzle;

    protected function setUp()
    {
        $this->puzzle = new Puzzle\Day2();
    }

    /**
     * @dataProvider paperValidDataProvider
     */
    public function testFloorValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, $this->puzzle->paper($input));
    }

    public function paperValidDataProvider()
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
     * @dataProvider paperInvalidDataProvider
     */
    public function testPaperInvalidInput(string $input)
    {
        $this->setExpectedException(\InvalidArgumentException::class, "Input must only consist of three integers separated by 'x', per line");
        $this->puzzle->paper($input);
    }

    public function paperInvalidDataProvider()
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
     * @dataProvider ribbonValidDataProvider
     */
    public function testRibbonValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, $this->puzzle->ribbon($input));
    }

    public function ribbonValidDataProvider()
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
     * @dataProvider ribbonInvalidDataProvider
     */
    public function testRibbonInvalidInput(string $input)
    {
        $this->setExpectedException(\InvalidArgumentException::class, "Input must only consist of three integers separated by 'x', per line");
        $this->puzzle->ribbon($input);
    }

    public function ribbonInvalidDataProvider()
    {
        return [
            [ 'foobar' ],
            [ '10x' ],
            [ '10x10x' ],
            [ '10x10x10x10' ],
        ];
    }
}
