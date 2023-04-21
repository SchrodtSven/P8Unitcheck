<?php

declare(strict_types=1);
/**
 *  loading test case files and execute test methods
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-09
 */

namespace P8UnitCheck\Type;

class ListType implements \Countable, \ArrayAccess,  \Iterator
{
    public function __construct(protected array $content=[])
    {

    }

    public function count(): int 
    {
        return count($this->content);
    }

    public function push(mixed $value): self
    {
        \array_push($this->content, $value);
        return $this;
    }

    public function pop(): mixed
    {
        return \array_pop($this->content);
    }

    public function unshift(mixed $value): self
    {
        \array_unshift($value);
        return $this;
    }

    public function shift(): mixed
    {
        return \array_shift($this->content);
    }

        // The following functions implement interface \ArrayAccess
        //  to provide accessing objects as arrays


    public function offsetGet($offset): mixed
    {
        return $this->content[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->content[] = $value;
        } else {
            $this->content[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->content[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->content[$offset]);
    }

// The following functions implement interface \Iterator making it possible
    // to iterate container objects with foreach

    /**
     * Resetting pointer to first array element
     */
    public function rewind(): void
    {
        reset($this->content);
    }

    /**
     * Getting current element
     *
     */
    public function current(): mixed
    {
        return current($this->content);
    }

    /**
     * Getting key of current element
     * 
     * @return mixed
     */
    public function key(): mixed
    {
        return key($this->content);
    }

    /**
     * Forward internal array pointer
     * 
     * @return mixed|void
     */
    public function next(): void
    {
        next($this->content);
    }

    /**
     * Returning if current element is valid
     *
     * @return bool
     */
    public function valid(): bool
    {
        return ($this->current() !== false);
    }


    // Some methods offering usage of PHP native funcions via oop (fluent) interface

    public function walk(callable $callback): void  
    {
        $tmp = $this->getContent();
        array_walk($tmp, $callback);
        $this->content = $tmp;
    }

    public function filter(callable $callback): self
    {
        return new ListType(\array_filter($this->content, $callback));
    }

    public function join(string $glue=', '): StringType 
    {
        return new StringType(\implode($glue, $this->content));
    }

    public function getContent(): array
    {
        return $this->content;
    }
}