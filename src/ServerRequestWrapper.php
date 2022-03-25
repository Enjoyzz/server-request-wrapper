<?php

declare(strict_types=1);


namespace Enjoys;

use Psr\Http\Message\ServerRequestInterface;

final class ServerRequestWrapper
{

    private Collection $queryData;
    private Collection $postData;
    private Collection $cookieData;
    private Collection $serverData;
    private FilesCollection $filesData;
    private Collection $attributesData;
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

    private function mappingData(ServerRequestInterface $request)
    {
        $this->queryData = new Collection($request->getQueryParams());
        $this->postData = new Collection($request->getParsedBody());
        $this->cookieData = new Collection($request->getCookieParams());
        $this->serverData = new Collection($request->getServerParams());
        $this->attributesData = new Collection($request->getAttributes());
        $this->filesData = new FilesCollection($request->getUploadedFiles());
    }

    public function getQueryData($key = null, $defaults = null): Collection
    {
        if ($key == null){
            return $this->queryData;
        }
        return $this->queryData->get($key, $defaults);
    }

    public function getPostData($key = null, $defaults = null): Collection
    {
        if ($key == null){
            return $this->postData;
        }
        return $this->postData->get($key, $defaults);
    }

    public function getCookieData($key = null, $defaults = null): Collection
    {
        if ($key == null){
            return $this->cookieData;
        }
        return $this->cookieData->get($key, $defaults);
    }

    public function getServerData($key = null, $defaults = null): Collection
    {
        if ($key == null){
            return $this->serverData;
        }
        return $this->serverData->get($key, $defaults);
    }

    public function getFilesData($key = null): FilesCollection
    {
        if ($key == null){
            return $this->filesData;
        }
        return $this->filesData->get($key);
    }

    public function getAttributesData($key = null, $defaults = null): Collection
    {
        if ($key == null){
            return $this->attributesData;
        }
        return $this->attributesData->get($key, $defaults);
    }


    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }




}