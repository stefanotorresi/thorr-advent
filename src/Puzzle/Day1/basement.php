<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Puzzle\Day1;

function basement(string $input): int
{
    $offset = 1;
    $length = strlen($input);

    while ($offset <= $length) {
        if (floor(substr($input, 0, $offset)) === -1) {
            return $offset;
        }
        $offset++;
    }

    throw new \InvalidArgumentException('Santa never went to the basement');
}
