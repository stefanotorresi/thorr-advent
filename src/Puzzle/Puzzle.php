<?php
/**
 * @author  Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE for copying permission.
 * ************************************************
 */

declare(strict_types=1);

namespace Thorr\Advent\Puzzle;

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
     * Puzzle constructor.
     *
     * @param string   $name  The puzzle name
     * @param string[] $parts The different puzzle parts in a 'method' => 'output format' array
     */
    public function __construct(string $name, array $parts)
    {
        $this->name = $name;

        foreach ($parts as $method => $format) {
            Assertion::methodExists(
                $method,
                $this,
                sprintf("Could not find part '%s' method in %s", $method, get_called_class())
            );
            Assertion::string($format);
        }

        $this->parts = $parts;
    }

    /**
     * Get the name of the puzzle
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the method names of every puzzle part
     *
     * @return string[]
     */
    public function getPartMethods(): array
    {
        return array_keys($this->parts);
    }

    /**
     * Get the output format for a specific part
     *
     * @param string $part
     *
     * @return string
     */
    public function getPartFormat(string $part): string
    {
        return $this->parts[$part];
    }
}
