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
}
