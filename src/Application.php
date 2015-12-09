<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\Advent;

use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\InputOption;

class Application extends ConsoleApplication
{
    const VERSION = '1.1.0-dev';

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

        for ($day = 1; $day <= 6; $day++) {
            $className = __NAMESPACE__ . "\\Puzzle\\Day$day";
            $this->add(new PuzzleCommand(strtolower("day$day"), new $className()));
        }
    }

    public function getLongVersion()
    {
        $version = parent::getLongVersion();
        $commit  = '@git-commit-short@';

        if ('@'.'git-commit-short@' !== $commit) {
            $version .= " ($commit)";
        }

        return $version . ' by <comment>Stefano Torresi</comment>';
    }

}
