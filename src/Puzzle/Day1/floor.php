<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Puzzle\Day1;

use Assert\Assertion;

function floor(string $input): int
{
    Assertion::regex($input, '/^[\(\)]+$/', 'Input must only consist of \'(\' or \')\'');

    $positiveMatches = preg_match_all ('/\(/', $input);
    $negativeMatches = preg_match_all ('/\)/', $input);

    return $positiveMatches - $negativeMatches;
}
