<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Puzzle;

use Assert\Assertion;

class Day2 extends Puzzle
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $name = "I Was Told There Would Be No Math",
        array $parts = [
            'paper' => 'The elves should order <info>%d</info> square feets of paper',
            'ribbon' => 'The elves should order <info>%d</info> feets of ribbon',
        ]
    ) {
        parent::__construct($name, $parts);
    }

    /**
     * The elves are running low on wrapping paper, and so they need to submit an order for more.
     * They have a list of the dimensions (length l, width w, and height h) of each present,
     * and only want to order exactly as much as they need.
     *
     * Fortunately, every present is a box (a perfect right rectangular prism),
     * which makes calculating the required wrapping paper for each gift a little easier:
     * find the surface area of the box, which is 2*l*w + 2*w*h + 2*h*l.
     * The elves also need a little extra paper for each present: the area of the smallest side.
     *
     * For example:
     *
     * - A present with dimensions 2x3x4 requires 2*6 + 2*12 + 2*8 = 52 square feet of wrapping paper
     *   plus 6 square feet of slack, for a total of 58 square feet.
     * - A present with dimensions 1x1x10 requires 2*1 + 2*10 + 2*10 = 42 square feet of wrapping paper
     *   plus 1 square foot of slack, for a total of 43 square feet.
     *
     * All numbers in the elves' list are in feet. How many total square feet of wrapping paper should they order?
     *
     * @param string $input
     *
     * @return int
     */
    public function paper(string $input): int
    {
        $this->validateInput($input);

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

    /**
     * The elves are also running low on ribbon. Ribbon is all the same width,
     * so they only have to worry about the length they need to order, which they would again like to be exact.
     *
     * The ribbon required to wrap a present is the shortest distance around its sides,
     * or the smallest perimeter of any one face. Each present also requires a bow made out of ribbon as well;
     * the feet of ribbon required for the perfect bow is equal to the cubic feet of volume of the present.
     * Don't ask how they tie the bow, though; they'll never tell.
     *
     * For example:
     *
     * - A present with dimensions 2x3x4 requires 2+2+3+3 = 10 feet of ribbon to wrap the present
     *   plus 2*3*4 = 24 feet of ribbon for the bow, for a total of 34 feet.
     * - A present with dimensions 1x1x10 requires 1+1+1+1 = 4 feet of ribbon to wrap the present
     *   plus 1*1*10 = 10 feet of ribbon for the bow, for a total of 14 feet.
     *
     * How many total feet of ribbon should they order?
     *
     * @param string $input
     *
     * @return int
     */
    public function ribbon(string $input): int
    {
        $this->validateInput($input);

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

    private function validateInput(string $input)
    {
        Assertion::regex(
            $input,
            '/^(?:\d+x){2}\d+\n?$/m',
            "Input must only consist of three integers separated by 'x', per line"
        );
    }
}
