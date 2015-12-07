<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Puzzle;

class Day5 extends Puzzle
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $name = "Doesn't He Have Intern-Elves For This?",
        array $parts = [
            'strings' => 'There are <info>%d</info> nice strings in there',
        ]
    ) {
        parent::__construct($name, $parts);
    }

    /**
     * Santa needs help figuring out which strings in his text file are naughty or nice.
     * A nice string is one with all of the following properties:
     *
     * - It contains at least three vowels (aeiou only), like aei, xazegov, or aeiouaeiouaeiou.
     * - It contains at least one letter that appears twice in a row, like xx, abcdde (dd), or aabbccdd (aa, bb, cc, or dd).
     * - It does not contain the strings ab, cd, pq, or xy, even if they are part of one of the other requirements.
     *
     * For example:
     *
     * - ugknbfddgicrmopn is nice because it has at least three vowels (u...i...o...), a double letter (...dd...),
     *   and none of the disallowed substrings.
     * - aaa is nice because it has at least three vowels and a double letter,
     *   even though the letters used by different rules overlap.
     * - jchzalrnumimnmhp is naughty because it has no double letter.
     * - haegwjzuvuyypxyu is naughty because it contains the string xy.
     * - dvszwmarrgswjxmb is naughty because it contains only one vowel.
     *
     * How many strings are nice?
     *
     * @param string $input
     *
     * @return int
     */
    public function strings(string $input): int
    {
        $hasAtLeastThreeVowels = '(?:.*[aeiou].*){3,}';
        $hasTwoLettersInARow = '(?:.*([a-z])\1.*)+';
        $blacklist = 'ab|cd|pq|xy';

        $count = 0;

        foreach (explode("\n", $input) as $line) {
            if (
                preg_match("/$hasAtLeastThreeVowels/i", $line)
                && preg_match("/$hasTwoLettersInARow/i", $line)
                && ! preg_match("/$blacklist/i", $line)
            ) {
                $count++;
            }
        }

        return $count;
    }
}
