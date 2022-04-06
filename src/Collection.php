<?php

declare(strict_types=1);

namespace Enjoys;

class Collection
{
    private array $collection;

    public function __construct(array $collection = [])
    {
        $this->collection = $collection;
    }

    public function getAll()
    {
        return $this->collection;
    }

    public function add($key, $value)
    {
        if(!$this->has($key)){
            $this->collection[$key] = $value;
        }
    }

    public function get(string $key, $defaults = null)
    {
        return $this->has($key) ? $this->collection[$key] : $defaults;
    }

    public function has(string $key): bool
    {
        return \array_key_exists($key, $this->collection);
    }
}
