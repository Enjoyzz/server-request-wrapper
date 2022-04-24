<?php

declare(strict_types=1);

namespace Enjoys;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

/**
 * @template T as string|null
 */
final class ServerRequestWrapper
{
    private Collection $queryData;
    private Collection $postData;
    private Collection $cookieData;
    private Collection $serverData;
    private FilesCollection $filesData;
    private Collection $attributesData;
    private ServerRequestInterface $request;

    /**
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->setRequest($request);
    }

    /**
     * @param ServerRequestInterface $request
     * @return $this
     */
    public function setRequest(ServerRequestInterface $request): ServerRequestWrapper
    {
        $this->request = $request;
        $this->mappingData($request);
        return $this;
    }

    /**
     * @param ServerRequestInterface $request
     * @return void
     */
    private function mappingData(ServerRequestInterface $request)
    {
        $this->queryData = new Collection($request->getQueryParams());
        $parsedBody = $request->getParsedBody();
        if (!is_null($parsedBody)) {
            $parsedBody = (array) $parsedBody;
        }
        $this->postData = new Collection($parsedBody ?? []);
        $this->cookieData = new Collection($request->getCookieParams());
        $this->serverData = new Collection($request->getServerParams());
        $this->attributesData = new Collection($request->getAttributes());
        $this->filesData = new FilesCollection($request->getUploadedFiles());
    }

    /**
     * @param T $key
     * @param mixed|null $defaults
     * @return Collection|mixed|null
     * @psalm-return (
     *     T is null
     *     ? Collection
     *     : mixed|null
     * )
     * @psalm-suppress MixedReturnStatement
     */
    public function getQueryData(string $key = null, $defaults = null)
    {
        if ($key == null) {
            return $this->queryData;
        }
        return $this->queryData->get($key, $defaults);
    }

    /**
     * @param T $key
     * @param mixed|null $defaults
     * @return Collection|mixed|null
     * @psalm-return (
     *     T is null
     *     ? Collection
     *     : mixed|null
     * )
     * @psalm-suppress MixedReturnStatement
     */
    public function getPostData(string $key = null, $defaults = null)
    {
        if ($key == null) {
            return $this->postData;
        }
        return $this->postData->get($key, $defaults);
    }

    /**
     * @param T $key
     * @param mixed|null $defaults
     * @return Collection|mixed|null
     * @psalm-return (
     *     T is null
     *     ? Collection
     *     : mixed|null
     * )
     * @psalm-suppress MixedReturnStatement
     */
    public function getCookieData(string $key = null, $defaults = null)
    {
        if ($key == null) {
            return $this->cookieData;
        }
        return $this->cookieData->get($key, $defaults);
    }

    /**
     * @param T $key
     * @param mixed|null $defaults
     * @return Collection|mixed|null
     * @psalm-return (
     *     T is null
     *     ? Collection
     *     : mixed|null
     * )
     * @psalm-suppress MixedReturnStatement
     */
    public function getServerData(string $key = null, $defaults = null)
    {
        if ($key == null) {
            return $this->serverData;
        }
        return $this->serverData->get($key, $defaults);
    }

    /**
     * @param T $key
     * @return FilesCollection|UploadedFileInterface|null
     * @psalm-return (
     *     T is null
     *     ? FilesCollection
     *     : UploadedFileInterface|null
     * )
     * @psalm-suppress MixedReturnStatement
     */
    public function getFilesData(string $key = null)
    {
        if ($key == null) {
            return $this->filesData;
        }
        return $this->filesData->get($key);
    }

    /**
     * @param T $key
     * @param mixed|null $defaults
     * @return Collection|mixed|null
     * @psalm-return (
     *     T is null
     *     ? Collection
     *     : mixed|null
     * )
     * @psalm-suppress MixedReturnStatement
     */
    public function getAttributesData(string $key = null, $defaults = null)
    {
        if ($key == null) {
            return $this->attributesData;
        }
        return $this->attributesData->get($key, $defaults);
    }


    /**
     * @return ServerRequestInterface
     */
    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }
}
