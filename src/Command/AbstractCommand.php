<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Command;

use Assert\Assertion;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

abstract class AbstractCommand extends Command
{
    const TASK_ALL = 'all';

    /**
     * @var string[]
     */
    protected $validTasks = [ self::TASK_ALL ];

    public function __construct(string $name, array $validTasks)
    {
        parent::__construct($name);

        $this->validTasks = array_values(array_unique(array_merge($this->validTasks, $validTasks)));

        $this
            ->addArgument(
                'input-file',
                InputArgument::REQUIRED,
                'The puzzle input file path'
            )
            ->addOption(
                'task',
                't',
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                sprintf('The task to execute (%s)', implode(' | ', $this->validTasks)),
                [self::TASK_ALL]
            )
        ;
    }

    protected function validateTasks(InputInterface $input): array
    {
        $tasks = $input->getOption('task');

        Assertion::notEmpty(array_intersect($tasks, $this->validTasks), 'None of the specified tasks was valid');

        if (in_array(static::TASK_ALL, $tasks)) {
            return $this->validTasks;
        }

        return $tasks;
    }

    protected function validateInputFile(InputInterface $input): string
    {
        $inputFileContents = file_get_contents($input->getArgument('input-file'));

        Assertion::string($inputFileContents, 'Could not read input file');

        return $inputFileContents;
    }
}
