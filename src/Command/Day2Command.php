<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Command;

use Symfony\Component\Console\{Input\InputInterface, Output\OutputInterface};

use function Thorr\AdventOfCode\Puzzle\Day2\{paper};

class Day2Command extends AbstractCommand
{
    const TASK_PAPER    = 'paper';

    public function __construct(string $name = 'day2')
    {
        parent::__construct($name, [ static::TASK_PAPER ]);

        $this->setDescription('Day 2 puzzles');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tasks = $this->validateTasks($input);

        $inputFileContents = $this->validateInputFile($input);

        if (in_array(static::TASK_PAPER, $tasks)) {
            $paper = paper($inputFileContents);
            $output->writeln(sprintf('The elves should order <info>%s</info> square feets of paper', $paper));
        }


    }
}

