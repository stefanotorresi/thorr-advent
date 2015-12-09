<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\Advent;

use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\InputOption;

class Application extends ConsoleApplication
{
    const VERSION = '1.0.0';

    public function __construct($name = 'Thorr\'s Advent Of Code', $version = self::VERSION)
    {
        parent::__construct($name, $version);

        $this->getDefinition()
             ->addOption(new InputOption(
                 'short',
                 's',
                 InputOption::VALUE_NONE,
                 "Short output: omit puzzle instructions"
             ))
        ;

        $puzzleFiles = glob(__DIR__ . '/Puzzle/Day*.php');

        foreach ($puzzleFiles as $file) {
            $puzzleName = pathinfo($file, PATHINFO_FILENAME);
            $className = __NAMESPACE__ . "\\Puzzle\\$puzzleName";
            $this->add(new PuzzleCommand(strtolower($puzzleName), new $className()));
        }
    }
}
