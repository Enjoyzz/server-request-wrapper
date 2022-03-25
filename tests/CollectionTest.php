<?php

declare(strict_types=1);

use Enjoys\ServerRequestWrapper\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{

    public function testGet()
    {
        $collection = new Collection([
            'get1 (array)' => ['array' => [2 => 'test', 'bool' => true]],
            'get2 (string)' => 'string',
            'get3 (bool)' => true,
        ]);
        $this->assertSame(['array' => [2 => 'test', 'bool' => true]], $collection->get('get1 (array)'));
        $this->assertSame([
            'get1 (array)' => ['array' => [2 => 'test', 'bool' => true]],
            'get2 (string)' => 'string',
            'get3 (bool)' => true,
        ], $collection->getAll());
        $this->assertSame(false, $collection->get('invalid', false));
        $this->assertSame(null, $collection->get('invalid'));
    }

}
