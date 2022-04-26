<?php

declare(strict_types=1);

namespace Enjoys;

use Doctrine\Common\Collections\ArrayCollection;
use Psr\Http\Message\UploadedFileInterface;
use Webmozart\Assert\Assert;


final class FilesCollection extends ArrayCollection
{

    /**
     * {@inheritDoc}
     */
    public function get($key): ?UploadedFileInterface
    {
        $result = parent::get($key);
        Assert::nullOrIsInstanceOf($result, UploadedFileInterface::class);
        return $result;
    }
}
