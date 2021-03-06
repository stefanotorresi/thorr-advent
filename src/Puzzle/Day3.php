<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\Advent\Puzzle;

use Assert\Assertion;

class Day3 extends Puzzle
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $name = "Perfectly Spherical Houses in a Vacuum",
        array $parts = [
            'houses' => 'Santa delivered at least one present in <info>%d</info> houses',
            'robo'   => 'Santa together with Robo-Santa delivered at least one present in <info>%d</info> houses',
        ]
    ) {
        parent::__construct($name, $parts);
    }

    /**
     * Santa is delivering presents to an infinite two-dimensional grid of houses.
     *
     * He begins by delivering a present to the house at his starting location,
     * and then an elf at the North Pole calls him via radio and tells him where to move next.
     * Moves are always exactly one house to the north (^), south (v), east (>), or west (<).
     * After each move, he delivers another present to the house at his new location.
     *
     * However, the elf back at the north pole has had a little too much eggnog,
     * and so his directions are a little off, and Santa ends up visiting some houses more than once.
     *
     * For example:
     *
     * - > delivers presents to 2 houses: one at the starting location, and one to the east.
     * - ^>v< delivers presents to 4 houses in a square, including twice to the house at his starting/ending location.
     * - ^v^v^v^v^v delivers a bunch of presents to some very lucky children at only 2 houses.
     *
     * How many houses receive at least one present?
     */
    public function houses(string $input): int
    {
        $this->validateInput($input);

        $steps  = str_split($input);
        $houses = [[1]];

        $santa = $this->callSanta();

        foreach ($steps as $step) {
            $santa->move($step);
            $santa->deliverPresent($houses);
        }

        return $this->count($houses);
    }

    /**
     * The next year, to speed up the process, Santa creates a robot version of himself, Robo-Santa,
     * to deliver presents with him.
     *
     * Santa and Robo-Santa start at the same location (delivering two presents to the same starting house),
     * then take turns moving based on instructions from the elf, who is eggnoggedly reading
     * from the same script as the previous year.
     *
     * For example:
     *
     * - ^v delivers presents to 3 houses, because Santa goes north, and then Robo-Santa goes south.
     * - ^>v< now delivers presents to 3 houses, and Santa and Robo-Santa end up back where they started.
     * - ^v^v^v^v^v now delivers presents to 11 houses, with Santa going one direction and Robo-Santa going the other.
     *
     * This year, how many houses receive at least one present?
     */
    public function robo(string $input): int
    {
        $this->validateInput($input);

        $steps  = str_split($input);
        $houses = [[1]];

        $santa = $this->callSanta();
        $roboSanta = $this->callSanta();

        foreach ($steps as $i => $step) {
            $currentSanta = ($i % 2 === 0) ? $santa : $roboSanta;
            $currentSanta->move($step);
            $currentSanta->deliverPresent($houses);
        }

        return $this->count($houses);
    }

    private function callSanta()
    {
        return new class()
        {
            private $x = 0;
            private $y = 0;

            public function move(string $step)
            {
                switch ($step) {
                    case '<':
                        $this->x--;
                        break;
                    case '>':
                        $this->x++;
                        break;
                    case '^':
                        $this->y++;
                        break;
                    case 'v':
                        $this->y--;
                        break;
                }
            }

            public function deliverPresent(array &$houses)
            {
                if (! isset($houses[$this->x])) {
                    $houses[$this->x] = [];
                }
                if (! isset($houses[$this->x][$this->y])) {
                    $houses[$this->x][$this->y] = 0;
                }
                $houses[$this->x][$this->y]++;
            }
        };
    }

    private function validateInput(string $input)
    {
        Assertion::regex($input, '/^[\^><v]+$/', "Input must only consist these characters: '<', '^', '>', 'v");
    }

    private function count(array $houses): int
    {
        $result = 0;
        $recursiveIterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($houses));
        foreach ($recursiveIterator as $housePresents) {
            if ($housePresents >= 1) {
                $result++;
            }
        }

        return $result;
    }
}
