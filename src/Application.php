<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode;

use Symfony\Component\Console\Application as ConsoleApplication;

class Application extends ConsoleApplication
{
    const NAME = 'Thorr\'s Advent Of Code';
    const VERSION = '1.0.0';

    public function __construct($name = self::NAME, $version = self::VERSION)
    {
        parent::__construct($name, $version);

        $this->add(new PuzzleCommand('day1', new Puzzle\Day1()));
        $this->add(new PuzzleCommand('day2', new Puzzle\Day2()));
        $this->add(new PuzzleCommand('day3', new Puzzle\Day3()));
    }
}
