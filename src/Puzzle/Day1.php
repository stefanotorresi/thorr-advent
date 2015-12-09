<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\Advent\Puzzle;

use Assert\Assertion;

class Day1 extends Puzzle
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $name = "Not Quite Lisp",
        array $parts = [
            'floor' => 'Santa is at floor <info>%d</info>',
            'basement' => 'Santa entered the basement after stepping into <info>%d</info> floors'
        ]
    ) {
        parent::__construct($name, $parts);
    }

    /**
     * Santa is trying to deliver presents in a large apartment building,
     * but he can't find the right floor - the directions he got are a little confusing.
     * He starts on the ground floor (floor 0) and then follows the instructions one character at a time.
     *
     * An opening parenthesis, (, means he should go up one floor,
     * and a closing parenthesis, ), means he should go down one floor.
     *
     * The apartment building is very tall, and the basement is very deep; he will never find the top or bottom floors.
     *
     * For example:
     *
     * - (()) and ()() both result in floor 0.
     * - ((( and (()(()( both result in floor 3.
     * - ))((((( also results in floor 3.
     * - ()) and ))( both result in floor -1 (the first basement level).
     * - ))) and )())()) both result in floor -3.
     *
     * To what floor do the instructions take Santa?
     */
    public function floor(string $input): int
    {
        $this->validateInput($input);

        $positiveMatches = preg_match_all('/\(/', $input);
        $negativeMatches = preg_match_all('/\)/', $input);

        return $positiveMatches - $negativeMatches;
    }

    /**
     * Now, given the same instructions,
     * find the position of the first character that causes him to enter the basement (floor -1).
     * The first character in the instructions has position 1, the second character has position 2, and so on.
     *
     * For example:
     *
     * - ) causes him to enter the basement at character position 1.
     * - ()()) causes him to enter the basement at character position 5.
     *
     * What is the position of the character that causes Santa to first enter the basement?
     */
    public function basement(string $input): int
    {
        $this->validateInput($input);

        $floor = 0;
        $steps = str_split($input);

        foreach ($steps as $pos => $step) {
            $floor += ($step === '(' ? 1 : -1);
            if ($floor === -1) {
                return $pos+1;
            }
        }

        throw new \InvalidArgumentException('Santa never went to the basement');
    }

    private function validateInput(string $input)
    {
        Assertion::regex($input, '/^[\(\)]+$/', 'Input must only consist of \'(\' or \')\'');
    }
}
