<?php
namespace Framework\Http;

class Request{

    private $queryParams = [];
    private $parsedBody;

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }
    public function getParsedBody()
    {
        return $this->parsedBody;
    }

    public function getBody()
    {
        return file_get_contents('php://input');
    }

    public function withQueryParams(array $query): self
    {
        $new = clone $this;
        $new->queryParams = $query;
        return $new;
    }

    public function withParsedBody($data): self
    {
        $new = clone $this;
        $new->parsedBody = $data;
        return $new;
    }

}