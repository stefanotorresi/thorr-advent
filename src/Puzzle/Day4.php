<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\Advent\Puzzle;

class Day4 extends Puzzle
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $name = "The Ideal Stocking Stuffer",
        array $parts = [
            'mine' => 'The first AdventCoin is <info>%d</info>',
            'mineHarder' => 'The second AdventCoin is <info>%d</info>',
        ]
    ) {
        parent::__construct($name, $parts);
    }

    /**
     * Santa needs help mining some AdventCoins (very similar to bitcoins) to use as gifts
     * for all the economically forward-thinking little girls and boys.
     *
     * To do this, he needs to find MD5 hashes which, in hexadecimal, start with at least five zeroes.
     * The input to the MD5 hash is some secret key (your puzzle input, given below) followed by a number in decimal.
     * To mine AdventCoins, you must find Santa the lowest positive number (no leading zeroes: 1, 2, 3, ...)
     * that produces such a hash.
     *
     * For example:
     *
     * - If your secret key is abcdef, the answer is 609043, because the MD5 hash of abcdef609043 starts with
     *   five zeroes (000001dbbfa...), and it is the lowest such number to do so.
     * - If your secret key is pqrstuv, the lowest number it combines with to make an MD5 hash starting with
     *   five zeroes is 1048970; that is, the MD5 hash of pqrstuv1048970 looks like 000006136ef....
     */
    public function mine(string $input, string $padding = '00000'): int
    {
        $result = 0;
        $input = trim($input);

        while (strpos(md5($input.$result), $padding) !== 0) {
            $result++;
        }

        return $result;
    }

    /**
     * Now find one that starts with six zeroes.
     */
    public function mineHarder(string $input): int
    {
        return $this->mine($input, '000000');
    }
}
