<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Puzzle;

use Assert\Assertion;

class Day6 extends Puzzle
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $name = "Probably a Fire Hazard",
        array $parts = [
            'lights' => 'There are <info>%d</info> lights lit',
        ]
    ) {
        parent::__construct($name, $parts);
    }

    /**
     * Because your neighbors keep defeating you in the holiday house decorating contest year after year,
     * you've decided to deploy one million lights in a 1000x1000 grid.
     *
     * Furthermore, because you've been especially nice this year, Santa has mailed you instructions
     * on how to display the ideal lighting configuration.
     *
     * Lights in your grid are numbered from 0 to 999 in each direction;
     * the lights at each corner are at 0,0, 0,999, 999,999, and 999,0.
     * The instructions include whether to turn on, turn off, or toggle various
     * inclusive ranges given as coordinate pairs. Each coordinate pair represents
     * opposite corners of a rectangle, inclusive; a coordinate pair like 0,0 through 2,2
     * therefore refers to 9 lights in a 3x3 square.
     * The lights all start turned off.
     *
     * To defeat your neighbors this year, all you have to do is set up your lights by doing the instructions Santa sent you in order.
     *
     * For example:
     *
     * - turn on 0,0 through 999,999 would turn on (or leave on) every light.
     * - toggle 0,0 through 999,0 would toggle the first line of 1000 lights,
     *   turning off the ones that were on, and turning on the ones that were off.
     * - turn off 499,499 through 500,500 would turn off (or leave off) the middle four lights.
     *
     * After following the instructions, how many lights are lit?
     *
     * @param string $input
     * @param array  $grid
     *
     * @return int
     */
    public function lights(string $input, array &$grid = null): int
    {
        $pattern = '/^(?<instruction>turn|toggle)(?: (?<mode>on|off))? (?<x1>\d+),(?<y1>\d+) through (?<x2>\d+),(?<y2>\d+)\n?$/i';

        if ($grid === null) {
            $grid = $this->createGrid(1000, 1000);
        }

        foreach (explode("\n", trim($input)) as $line) {
            $valid = preg_match($pattern, $line, $matches);
            Assertion::same($valid, 1, sprintf('Invalid input line: %s', $line));

            $args = $this->marshallInstructionArgs($matches);

            $this->{$matches['instruction']}($grid, ...$args);
        }

        return $this->count($grid);
    }

    protected function turn(array &$grid, string $mode, int $x1, int $y1, int $x2, int $y2)
    {
        for ($x = $x1; $x <= $x2; $x++) {
            for ($y = $y1; $y <= $y2; $y++) {
                $grid[$x][$y] = $mode === 'on' ? true : false;
            }
        }
    }

    protected function toggle(array &$grid, int $x1, int $y1, int $x2, int $y2)
    {
        for ($x = $x1; $x <= $x2; $x++) {
            for ($y = $y1; $y <= $y2; $y++) {
                $grid[$x][$y] = ! $grid[$x][$y];
            }
        }
    }

    private function count(array $grid): int
    {
        $result = 0;
        $recursiveIterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($grid));
        foreach ($recursiveIterator as $light) {
            if ($light) {
                $result++;
            }
        }

        return $result;
    }

    private function marshallInstructionArgs(array $matches): array
    {
        $args = array_filter(array_splice($matches, 2), function ($val, $key) {
            return is_string($key) && $val !== '';
        }, ARRAY_FILTER_USE_BOTH);

        array_walk($args, function (&$val, $key) {
            if (in_array($key, [ 'x1', 'x2', 'y1', 'y2' ])) {
                $val = (int) $val;
            }
        });

        return array_values($args);
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return bool[][]
     */
    public function createGrid(int $x, int $y): array
    {
        return array_fill(0, $x, array_fill(0, $y, false));
    }
}
