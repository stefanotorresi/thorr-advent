<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\Advent\Puzzle;

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
            'brightness' => 'The total brightness is <info>%d</info>',
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
     * To defeat your neighbors this year, all you have to do is set up your lights
     * by doing the instructions Santa sent you in order.
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
        $pattern = '/^(?<command>\w+)(?: (?<value>[\w-]+))? (?<x1>\d+),(?<y1>\d+) through (?<x2>\d+),(?<y2>\d+)\n?$/i';

        if ($grid === null) {
            $grid = $this->createGrid(1000, 1000);
        }

        foreach (explode("\n", trim($input)) as $line) {
            $valid = preg_match($pattern, $line, $matches);
            Assertion::eq($valid, true, sprintf('Invalid input line: %s', $line));

            $instruction = $this->marshallInstruction($matches);

            $this->execute($grid, ...$instruction);
        }

        return $this->count($grid);
    }

    /**
     * You just finish implementing your winning light pattern when you realize
     * you mistranslated Santa's message from Ancient Nordic Elvish.
     *
     * The light grid you bought actually has individual brightness controls;
     * each light can have a brightness of zero or more. The lights all start at zero.
     *
     * The phrase turn on actually means that you should increase the brightness of those lights by 1.
     *
     * The phrase turn off actually means that you should decrease the brightness of those lights by 1,
     * to a minimum of zero.
     *
     * The phrase toggle actually means that you should increase the brightness of those lights by 2.
     *
     * For example:
     *
     * - turn on 0,0 through 0,0 would increase the total brightness by 1.
     * - toggle 0,0 through 999,999 would increase the total brightness by 2000000.
     *
     * What is the total brightness of all lights combined after following Santa's instructions?
     *
     * @param string     $input
     * @param array|null $grid
     *
     * @return int
     */
    public function brightness(string $input, array &$grid = null): int
    {
        $input = preg_replace(['/^turn on/im', '/^turn off/im', '/^toggle/im'], ['tune up', 'tune down', 'tune up-twice'], $input);

        return $this->lights($input, $grid);
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return bool[][]
     */
    public function createGrid(int $x, int $y): array
    {
        return array_fill(0, $x, array_fill(0, $y, 0));
    }

    public function turn(&$light, string $value)
    {
        $light = $value === 'on';
    }

    public function toggle(&$light)
    {
        $light = ! $light;
    }

    public function tune(&$light, string $value)
    {
        switch ($value) {
            case 'up':
                $increment = 1;
                break;
            case 'down':
                $increment = -1;
                break;
            case 'up-twice':
                $increment = 2;
                break;
            default:
                $increment = 0;
        }

        if ($light + $increment < 0) {
            $light = 0;
            return;
        }

        $light += $increment;
    }

    private function execute(array &$grid, callable $command, string $value, int $x1, int $y1, int $x2, int $y2)
    {
        for ($x = $x1; $x <= $x2; $x++) {
            for ($y = $y1; $y <= $y2; $y++) {
                $command($grid[$x][$y], $value);
            }
        }
    }

    private function count(array $grid): int
    {
        $result = 0;
        $recursiveIterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($grid));
        foreach ($recursiveIterator as $light) {
            $result += $light;
        }

        return $result;
    }

    private function marshallInstruction(array $matches): array
    {
        $args = array_filter(array_splice($matches, 1), function ($key) {
            return is_string($key);
        }, ARRAY_FILTER_USE_KEY);

        array_walk($args, function (&$val, $key) {
            if (in_array($key, [ 'x1', 'x2', 'y1', 'y2' ])) {
                $val = (int) $val;
            }
        });

        $args['command'] = [$this, $args['command']];

        return array_values($args);
    }
}
