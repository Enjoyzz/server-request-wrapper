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

    public function getQueryData(): Collection
    {
        return $this->queryData;
    }

    public function getPostData(): Collection
    {
        return $this->postData;
    }

    public function getCookieData(): Collection
    {
        return $this->cookieData;
    }

    public function getServerData(): Collection
    {
        return $this->serverData;
    }

    public function getFilesData(): FilesCollection
    {
        return $this->filesData;
    }

    public function getAttributesData(): Collection
    {
        return $this->attributesData;
    }


    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }




}