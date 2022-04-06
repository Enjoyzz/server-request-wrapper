<?php

declare(strict_types=1);


use Enjoys\FilesCollection;
use GuzzleHttp\Psr7\UploadedFile;
use PHPUnit\Framework\TestCase;

class FilesCollectionTest extends TestCase
{
    public function testFilesCollection()
    {
        $collection = new FilesCollection([
            'key1' => new UploadedFile('test', 98, UPLOAD_ERR_OK),
            '0' => new UploadedFile('test2', 100, UPLOAD_ERR_OK),
            new UploadedFile('test3', 105, UPLOAD_ERR_OK),
        ]);
        $this->assertSame(98, $collection->get('key1')->getSize());
        $this->assertNull($collection->get('invalid', false));
        $this->assertSame(true, $collection->has('key1'));
        $this->assertSame(105, $collection->get('1')->getSize());

        $this->assertCount(3, $collection->getAll());
    }
}
