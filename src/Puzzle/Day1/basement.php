<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Puzzle\Day1;

use Assert\Assertion;

function basement(string $input): int
{
    Assertion::regex($input, '/^[\(\)]+$/', 'Input must only consist of \'(\' or \')\'');

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
