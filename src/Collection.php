<?php

declare(strict_types=1);


namespace Enjoys\ServerRequestWrapper;


final class Collection
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

    public function get(string $key, $defaults = null)
    {
        return $this->has($key) ? $this->collection[$key] : $defaults;
    }

    public function has(string $key): bool
    {
        return \array_key_exists($key, $this->collection);
    }
}