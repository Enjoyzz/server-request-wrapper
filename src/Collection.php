<?php

declare(strict_types=1);

namespace Enjoys;

use function array_key_exists;

class Collection
{
    private array $collection;

    public function __construct(array $collection = [])
    {
        $this->collection = $collection;
    }

    public function getAll(): array
    {
        return $this->collection;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function add(string $key, $value)
    {
        if (!$this->has($key)) {
            $this->collection[$key] = $value;
        }
    }

    /**
     * @template T
     * @param string $key
     * @param T $defaults
     * @return mixed|T
     */
    public function get(string $key, $defaults = null)
    {
        return $this->has($key) ? $this->collection[$key] : $defaults;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->collection);
    }
}
