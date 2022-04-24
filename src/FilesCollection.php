<?php

declare(strict_types=1);

namespace Enjoys;

use Psr\Http\Message\UploadedFileInterface;
use Webmozart\Assert\Assert;

final class FilesCollection extends Collection
{
    /**
     * @param string $key
     * @param mixed|null $defaults
     * @return UploadedFileInterface|null
     */
    public function get(string $key, $defaults = null): ?UploadedFileInterface
    {
        $value = parent::get($key);
        Assert::nullOrIsInstanceOf($value, UploadedFileInterface::class);
        return $value;
    }
}
