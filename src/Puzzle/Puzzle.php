<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\AdventOfCode\Puzzle;

use Assert\Assertion;

abstract class Puzzle
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string[]
     */
    protected $parts;

    /**
     * AbstractPuzzle constructor.
     *
     * @param string   $name  The puzzle name
     * @param string[] $parts The different puzzle parts names
     */
    public function __construct(string $name, array $parts)
    {
        $this->name = $name;

        foreach ($parts as $part) {
            Assertion::methodExists($part, $this, sprintf("Could not find part '%s' method in %s", $part, get_called_class()));
        }

        $this->parts = $parts;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string[]
     */
    public function getParts(): array
    {
        return $this->parts;
    }
}
