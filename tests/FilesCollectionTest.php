<?php

declare(strict_types=1);


use Enjoys\FilesCollection;
use GuzzleHttp\Psr7\UploadedFile;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UploadedFileInterface;
use Webmozart\Assert\InvalidArgumentException;

class FilesCollectionTest extends TestCase
{
    public function testFilesCollection()
    {
        $fileCollection = new FilesCollection([
            new UploadedFile('test', 98, UPLOAD_ERR_OK),
            new UploadedFile('test2', 100, UPLOAD_ERR_OK),
        ]);
        $this->assertInstanceOf(UploadedFileInterface::class, $fileCollection->get(0));
        $this->assertNull($fileCollection->get('invalid'));
    }

    public function testFilesCollectionInvalidType()
    {
        $this->expectException(InvalidArgumentException::class);
        $fileCollection = new FilesCollection([1,2]);
        $fileCollection->get(0);
    }
}
