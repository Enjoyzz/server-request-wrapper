<?php

declare(strict_types=1);

namespace Enjoys;

use Doctrine\Common\Collections\ArrayCollection;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

final class ServerRequestWrapper
{
    private ArrayCollection $queryData;
    private ArrayCollection $postData;
    private ArrayCollection $cookieData;
    private ArrayCollection $serverData;
    private FilesCollection $filesData;
    private ArrayCollection $attributesData;
    private ServerRequestInterface $request;

    public function __construct(ServerRequestInterface $request)
    {
        $this->setRequest($request);
    }

    public function setRequest(ServerRequestInterface $request): ServerRequestWrapper
    {
        $this->request = $request;
        $this->mappingData($request);
        return $this;
    }

    private function mappingData(ServerRequestInterface $request): void
    {
        $this->queryData = new ArrayCollection($request->getQueryParams());
        $parsedBody = $request->getParsedBody();
        if (!is_null($parsedBody)) {
            $parsedBody = (array) $parsedBody;
        }
        $this->postData = new ArrayCollection($parsedBody ?? []);
        $this->cookieData = new ArrayCollection($request->getCookieParams());
        $this->serverData = new ArrayCollection($request->getServerParams());
        $this->attributesData = new ArrayCollection($request->getAttributes());
        $this->filesData = new FilesCollection($request->getUploadedFiles());
    }

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
     * @psalm-suppress MixedReturnStatement
     */
    public function getQueryData($key = null, $defaults = null)
    {
        if ($key == null) {
            return $this->queryData;
        }
        return $this->queryData->get($key) ?? $defaults;
    }

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
     * @psalm-suppress MixedReturnStatement
     */
    public function getPostData($key = null, $defaults = null)
    {
        if ($key == null) {
            return $this->postData;
        }
        return $this->postData->get($key) ?? $defaults;
    }

    /**
     * @template T as array-key|null
     * @param T $key
     * @param mixed|null $defaults
     * @psalm-return (
     *     T is null
     *     ? ArrayCollection
     *     : mixed|null
     * )
     * @psalm-suppress MixedReturnStatement
     */
    public function getCookieData($key = null, $defaults = null)
    {
        if ($key == null) {
            return $this->cookieData;
        }
        return $this->cookieData->get($key) ?? $defaults;
    }

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
     * @psalm-suppress MixedReturnStatement
     */
    public function getServerData($key = null, $defaults = null)
    {
        if ($key == null) {
            return $this->serverData;
        }
        return $this->serverData->get($key) ?? $defaults;
    }

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
     * @psalm-suppress MixedReturnStatement
     */
    public function getAttributesData($key = null, $defaults = null)
    {
        if ($key == null) {
            return $this->attributesData;
        }
        return $this->attributesData->get($key) ?? $defaults;
    }


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
    public function getFilesData($key = null)
    {
        if ($key == null) {
            return $this->filesData;
        }
        return $this->filesData->get($key);
    }

    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }
}
