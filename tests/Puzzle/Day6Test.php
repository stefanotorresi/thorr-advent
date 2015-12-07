<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\Advent\Test\Puzzle;

use PHPUnit_Framework_TestCase as TestCase;
use Thorr\Advent\Puzzle;

class Day6Test extends TestCase
{
    /**
     * @var Puzzle\Day6
     */
    protected $puzzle;

    protected function setUp()
    {
        $this->puzzle = new Puzzle\Day6();
    }

    /**
     * @dataProvider lightsDataProvider
     */
    public function testLights(string $input, int $expectedOutput)
    {
        $grid = $this->puzzle->createGrid(10, 10);
        $this->assertSame($expectedOutput, $this->puzzle->lights($input, $grid));
    }

    public function lightsDataProvider()
    {
        return [
            [ 'turn on 0,0 through 2,2', 9 ],
            [ 'turn on 0,0 through 9,9', 100 ],
            [ 'toggle 0,0 through 9,9', 100 ],
            [ "turn on 0,0 through 9,9\nturn off 0,0 through 9,9", 0 ],
            [ "turn on 0,0 through 9,9\ntoggle 0,0 through 9,9", 0 ],
        ];
    }

}
