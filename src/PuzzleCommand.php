<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\Advent;

use Assert\Assertion;
use ReflectionMethod;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{InputArgument, InputInterface, InputOption};
use Symfony\Component\Console\Output\OutputInterface;
use Ubench;

class PuzzleCommand extends Command
{
    const PART_ALL = 'all';

    /**
     * @var string[]
     */
    private $validParts = [ self::PART_ALL ];

    /**
     * @var Puzzle\Puzzle
     */
    private $puzzle;

    public function __construct(string $name, Puzzle\Puzzle $puzzle)
    {
        parent::__construct($name);

        $this->puzzle = $puzzle;
        $this->validParts = array_values(array_unique(array_merge($this->validParts, $puzzle->getPartMethods())));

        $this
            ->setDescription($puzzle->getName())
            ->addArgument(
                'file',
                InputArgument::OPTIONAL,
                'The puzzle input file path (in alternative, you can use stdin)'
            )
            ->addOption(
                'part',
                'p',
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                sprintf('The part to execute (%s)', implode(' | ', $this->validParts)),
                [ self::PART_ALL ]
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parts       = $this->marshallParts($input);
        $inputBuffer = $this->marshallInput($input);

        $output->writeln(sprintf('<question>%s</question>', $this->puzzle->getName()).PHP_EOL);
        $bench = new Ubench();

        foreach ($parts as $i => $part) {
            $output->writeln(sprintf('<info>** Part %d: %s **</info>', $i+1, $part).PHP_EOL);

            if (! $input->getOption('short')) {
                $this->printPuzzleInstructions($output, $part);
            }

            $result = $bench->run([ $this->puzzle, $part ], $inputBuffer);
            $output->writeln(sprintf($this->puzzle->getPartFormat($part), $result));

            $output->writeln(sprintf(
                'Time elapsed: %s | Memory usage: %s',
                $bench->getTime(),
                $bench->getMemoryUsage()
            ).PHP_EOL);
        }
    }

    protected function marshallParts(InputInterface $input): array
    {
        $parts = $input->getOption('part');
        $invalidParts = array_diff($parts, $this->validParts);

        Assertion::noContent($invalidParts, sprintf('Invalid parts specified: %s', implode(', ', $invalidParts)));

        if (in_array(static::PART_ALL, $parts)) {
            $parts = $this->puzzle->getPartMethods();
        }

        return $parts;
    }

    protected function marshallInput(InputInterface $input): string
    {
        $inputFile   = $input->getArgument('file');

        if ($inputFile) {
            Assertion::file($inputFile);
            $inputBuffer = file_get_contents($inputFile);
        } else {
            $inputBuffer = '';
            $stdin = fopen('php://stdin', 'r');
            stream_set_blocking($stdin, false);
            while ($line = fgets($stdin)) {
                $inputBuffer .= $line;
            }
        }

        Assertion::notEmpty($inputBuffer, 'Input must not be empty');

        return $inputBuffer;
    }

    protected function printPuzzleInstructions(OutputInterface $output, string $part)
    {
        $methodRefl = new ReflectionMethod($this->puzzle, $part);
        $output->writeln(sprintf(
            '<comment>%s</comment>',
            preg_replace('/^\s{4}/m', '', $methodRefl->getDocComment())
        ) . PHP_EOL);
    }
}
