<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Puzzle\Day2;

use Assert\Assertion;

function ribbon(string $input): int
{
    Assertion::regex(
        $input,
        '/^(?:\d+x){2}\d+\n?$/m',
        "Input must only consist of a list of three integers per line, separated by 'x'"
    );

    $boxes = explode("\n", trim($input));

    $totalAmount = 0;

    foreach ($boxes as $box) {
        $sizes = explode('x', $box);
        list($l, $w, $h) = $sizes;

        $facePerimeters = [($l+$w)*2, ($w+$h)*2, ($h+$l)*2];
        $smallestFacePerimeter = min($facePerimeters);

        $volume = $l*$w*$h;

        $totalAmount += ($smallestFacePerimeter + $volume);
    }

    return $totalAmount;
}
