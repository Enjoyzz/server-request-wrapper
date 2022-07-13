<?php

declare(strict_types=1);

namespace Enjoys;

use Doctrine\Common\Collections\ArrayCollection;
use Psr\Http\Message\UploadedFileInterface;
use Webmozart\Assert\Assert;

final class FilesCollection extends ArrayCollection
{
    /**
     * @param array-key $key
     * @return null|UploadedFileInterface|UploadedFileInterface[]
     */
    public function get($key)
    {
        $result = parent::get($key);

        if (is_array($result)) {
            Assert::allIsInstanceOf($result, UploadedFileInterface::class);
            if (count($result) <= 1) {
                return current($result);
            }

            return $result;
        }

        Assert::nullOrIsInstanceOf($result, UploadedFileInterface::class);
        return $result;
    }
}
