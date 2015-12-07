<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Puzzle\Day2;

use Assert\Assertion;

function paper(string $input): int
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

        $faces = [$l*$w,  $w*$h, $h*$l];
        $smallestFace = min($faces);

        $area = 0;
        array_walk($faces, function (int $face) use (&$area) {
            $area += 2 * $face;
        });

        $totalAmount += ($area + $smallestFace);
    }

    return $totalAmount;
}
