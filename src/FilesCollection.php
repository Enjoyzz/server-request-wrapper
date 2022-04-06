<?php

declare(strict_types=1);

namespace Enjoys;

use Psr\Http\Message\UploadedFileInterface;

final class FilesCollection extends Collection
{
    public function get(string $key, $defaults = null): ?UploadedFileInterface
    {
        return parent::get($key);
    }
}
