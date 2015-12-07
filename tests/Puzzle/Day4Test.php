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

class Day4Test extends TestCase
{
    /**
     * @var Puzzle\Day4
     */
    protected $puzzle;

    protected function setUp()
    {
        $this->puzzle = new Puzzle\Day4();
    }

    /**
     * @dataProvider mineValidDataProvider
     */
    public function testMineValidInput(string $input, int $expectedOutput)
    {
        $this->assertSame($expectedOutput, $this->puzzle->mine($input));
    }

    public function mineValidDataProvider()
    {
        return [
            [ 'abcdef', 609043 ],
            [ 'pqrstuv', 1048970 ],
            [ "pqrstuv\n", 1048970 ],
        ];
    }
}
