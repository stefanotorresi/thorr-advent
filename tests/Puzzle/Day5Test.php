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
     * @dataProvider stringsValidDataProvider
     */
    public function testStringsValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, $this->puzzle->strings($input));
    }

    public function stringsValidDataProvider()
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

    /**
     * @dataProvider moarStringsValidDataProvider
     */
    public function testMoarStringsValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, $this->puzzle->moarStrings($input));
    }

    public function moarStringsValidDataProvider()
    {
        return [
            [ 'qjhvhtzxzqqjkmpb', 1 ],
            [ 'xxyxx', 1 ],
            [ 'uurcxstgmygtbstg', 0 ],
            [ 'ieodomkazucvgmuy', 0 ],
            [ "qjhvhtzxzqqjkmpb\nxxyxx\nuurcxstgmygtbstg\nuurcxstgmygtbstg", 2 ],
        ];
    }
}
