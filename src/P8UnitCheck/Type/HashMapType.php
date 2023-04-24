<?php

declare(strict_types=1);
/**
 * Class implementing assoc. arrays as Hash map instances
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/P8UnitCheck
 * @package P8UnitCheck
 * @version 0.1
 * @since 2023-04-21
 */
namespace P8UnitCheck\Type;

class HashMapType extends ListType
{
    public function hasKey(string $key):bool
    {
        return \array_key_exists($key, $this->content);
    }

    public function get(string $key): mixed
    {
        return $this->content[$key] ?? null;
    }

    public function delete(string $key): self
    {
        unset($this->content[$key]);
        return $this;
    }

    public function set(string $key, mixed $value): self
    {
        $this->content[$key] = $value;
        return $this;
    }

    public function getKeys(): ListType
    {
        return new ListType(\array_keys($this->content));
    }


}