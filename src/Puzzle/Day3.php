<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Puzzle;

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
     *
     * @param string $input
     *
     * @return int
     */
    public function houses(string $input)
    {
        $this->validateInput($input);

        $result = 0;
        $steps  = str_split($input);
        $houses = [[1]];

        $santa = $this->callSanta();

        foreach ($steps as $step) {
            switch ($step) {
                case '<':
                    $santa->moveLeft();
                    $santa->deliverPresent($houses);
                    break;
                case '>':
                    $santa->moveRight();
                    $santa->deliverPresent($houses);
                    break;
                case '^':
                    $santa->moveUp();
                    $santa->deliverPresent($houses);
                    break;
                case 'v':
                    $santa->moveDown();
                    $santa->deliverPresent($houses);
                    break;
            }
        }

        $recursiveIterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($houses));
        foreach ($recursiveIterator as $housePresents) {
            if ($housePresents >= 1) {
                $result++;
            }
        }

        return $result;
    }

    private function callSanta()
    {
        return new class() {
            private $pos = ['x' => 0, 'y' => 0];

            public function moveLeft() {
                $this->pos['x']++;
            }
            public function moveRight() {
                $this->pos['x']--;
            }
            public function moveUp() {
                $this->pos['y']++;
            }
            public function moveDown() {
                $this->pos['y']--;
            }
            public function deliverPresent(array &$houses) {
                if (! isset($houses[$this->pos['x']])) {
                    $houses[$this->pos['x']] = [];
                }
                if (! isset($houses[$this->pos['x']][$this->pos['y']])) {
                    $houses[$this->pos['x']][$this->pos['y']] = 0;
                }
                $houses[$this->pos['x']][$this->pos['y']]++;
            }
        };
    }

    private function validateInput(string $input)
    {
        Assertion::regex($input, '/^[\^><v]+$/', "Input must only consist these characters: '<', '^', '>', 'v");
    }
}
