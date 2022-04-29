<?php

declare(strict_types=1);


namespace Enjoys;


use Doctrine\Common\Collections\ArrayCollection;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

interface ServerRequestWrapperInterface
{

    /**
     * @template T of array-key|null
     * @param T $key
     * @param mixed|null $defaults
     * @return ArrayCollection|mixed|null
     * @psalm-return (
     *     T is null
     *     ? ArrayCollection
     *     : mixed|null
     * )
     */
    public function getQueryData($key = null, $defaults = null);

    /**
     * @template T of array-key|null
     * @param T $key
     * @param mixed|null $defaults
     * @return ArrayCollection|mixed|null
     * @psalm-return (
     *     T is null
     *     ? ArrayCollection
     *     : mixed|null
     * )
     */
    public function getPostData($key = null, $defaults = null);

    /**
     * @template T as array-key|null
     * @param T $key
     * @param mixed|null $defaults
     * @psalm-return (
     *     T is null
     *     ? ArrayCollection
     *     : mixed|null
     * )
     */
    public function getCookieData($key = null, $defaults = null);

    /**
     * @template T of array-key|null
     * @param T $key
     * @param mixed|null $defaults
     * @return ArrayCollection|mixed|null
     * @psalm-return (
     *     T is null
     *     ? ArrayCollection
     *     : mixed|null
     * )
     */
    public function getServerData($key = null, $defaults = null);

    /**
     * @template T of array-key|null
     * @param T $key
     * @param mixed|null $defaults
     * @return ArrayCollection|mixed|null
     * @psalm-return (
     *     T is null
     *     ? ArrayCollection
     *     : mixed|null
     * )
     */
    public function getAttributesData($key = null, $defaults = null);

    /**
     * @template T of array-key|null
     * @param T $key
     * @return FilesCollection|UploadedFileInterface|null
     * @psalm-return (
     *     T is null
     *     ? FilesCollection
     *     : UploadedFileInterface|null
     * )
     */
    public function getFilesData($key = null);

    public function getRequest(): ServerRequestInterface;
}
