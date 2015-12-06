<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Thorr\AdventOfCode\Puzzle\Day1\{floor, basement};

class Day1Command extends AbstractCommand
{
    const TASK_FLOOR    = 'floor';
    const TASK_BASEMENT = 'basement';

    public function __construct(string $name = 'day1')
    {
        parent::__construct($name, [ static::TASK_FLOOR, static::TASK_BASEMENT ]);

        $this->setDescription('Day 1 puzzles');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tasks = $this->validateTasks($input);

        $inputFileContents = $this->validateInputFile($input);

        if (in_array(static::TASK_FLOOR, $tasks)) {
            $floor = floor($inputFileContents);
            $output->writeln(sprintf('Santa is at floor <info>%s</info>', $floor));
        }

        if (in_array(static::TASK_BASEMENT, $tasks)) {
            $basement = basement($inputFileContents);
            $output->writeln(sprintf('Santa entered the basement after stepping into <info>%s</info> floors', $basement));
        }
    }
}

