<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\Advent\Test\Puzzle;

use PHPUnit_Framework_TestCase as TestCase;
use Thorr\Advent\Puzzle;

class Day3Test extends TestCase
{
    /**
     * @var Puzzle\Day3
     */
    protected $puzzle;

    protected function setUp()
    {
        $this->puzzle = new Puzzle\Day3();
    }

    /**
     * @dataProvider housesValidDataProvider
     */
    public function testHousesValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, $this->puzzle->houses($input));
    }

    public function housesValidDataProvider()
    {
        return [
            [ '>', 2 ],
            [ '><', 2 ],
            [ '^>v<', 4 ],
            [ '^v^v^v^v^v', 2 ],
        ];
    }

    /**
     * @dataProvider roboValidDataProvider
     */
    public function testRoboValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, $this->puzzle->robo($input));
    }

    public function roboValidDataProvider()
    {
        return [
            [ '>', 2 ],
            [ '^v', 3 ],
            [ '^>v<', 3 ],
            [ '^v^v^v^v^v', 11 ],
        ];
    }
}
