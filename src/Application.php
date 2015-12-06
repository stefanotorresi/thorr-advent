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

        $this->add(new Command\Day1Command());
    }
}
