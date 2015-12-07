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

class Day5Test extends TestCase
{
    /**
     * @var Puzzle\Day5
     */
    protected $puzzle;

    protected function setUp()
    {
        $this->puzzle = new Puzzle\Day5();
    }

    /**
     * @dataProvider stringValidDataProvider
     */
    public function testMineValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, $this->puzzle->strings($input));
    }

    public function stringValidDataProvider()
    {
        return [
            [ 'aeiouu', 1 ],
            [ 'aaa', 1 ],
            [ 'ugknbfddgicrmopn', 1 ],
            [ 'jchzalrnumimnmhp', 0 ],
            [ 'dvszwmarrgswjxmb', 0 ],
            [ 'haegwjzuvuyypxyu', 0 ],
            [ "aeiouu\naaa\nugknbfddgicrmopn\njchzalrnumimnmhp\ndvszwmarrgswjxmb\nhaegwjzuvuyypxyu", 3 ],
            [ "iabomphsuyfptoos", 0 ],
        ];
    }
}
