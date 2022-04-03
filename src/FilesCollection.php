<?php

declare(strict_types=1);

namespace Enjoys;

final class FilesCollection
{
    private Collection $collection;

    public function __construct(array $data)
    {
        $this->collection = new Collection($data);
    }

    public function get(string $key)
    {
        return $this->collection->get($key);
    }

    public function __call($name, $arguments)
    {
        return $this->collection->{$name}(...$arguments);
    }
}
