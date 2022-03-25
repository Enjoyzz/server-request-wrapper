<?php

declare(strict_types=1);


use Enjoys\ServerRequestWrapper\FilesCollection;
use PHPUnit\Framework\TestCase;

class FilesCollectionTest extends TestCase
{
    public function testFilesCollection()
    {
        $collection = new FilesCollection([
            'key1' => '1', '0' => 2 , 3
        ]);
        $this->assertSame('1', $collection->get('key1'));
        $this->assertSame(null, $collection->get('invalid', false));
        $this->assertSame(true, $collection->has('key1'));
        $this->assertSame(2, $collection->get('0'));
    }
}
