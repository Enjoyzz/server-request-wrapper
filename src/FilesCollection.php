<?php

declare(strict_types=1);

namespace Enjoys;

use Doctrine\Common\Collections\ArrayCollection;
use Psr\Http\Message\UploadedFileInterface;

final class FilesCollection extends ArrayCollection
{
    /**
     * {@inheritDoc}
     */
    public function get($key): ?UploadedFileInterface
    {
        return parent::get($key);
    }
}
