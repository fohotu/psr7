<?php
namespace Framework\Http;

class Response
{
    private $headers = [];
    private $body;
    private $statusCode;
    private $reasonPhrase = '';
    
    private static $phrases = [
        200 => 'ok',
        301 => 'Moved Permanently',
        403 => 'Forbitten'
    ];

    public function __construct($body,$status = 200)
    {
        $this->body = $body;
        $this->statusCode = $status;
    }

    public function getBody()
    {
        return $this->body;
    }
    public function withBody($body): self
    {
        $new = clone $this;
        $new->body = $body;
        return $new;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getReasonPhrase()
    {
        if(!$this->reasonPhrase && isset(self::$phrases[$this->statusCode])){
            $this->reasonPhrase = self::$phrases[$this->statusCode];
        }
        return $this->reasonPhrase;
    }

    public function withStatus($code,$reasonPhrase = ''): self
    {
        $new = clone $this;
        $new->statusCode = $code;
        $new->reasonPhrase = $reasonPhrase;
        return $new;
    }


    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function hasHeader($header): bool
    {
        return isset($this->headers[$header]);
    }

    public function getHeader($header)
    {
        if(!$this->hasHeader($header)){
            return null;
        }
        return $this->headers[$header];
    }


    public function withHeaders($header,$value = ''): self
    {
        $new = clone $this;
        if($this->hasHeader($header)){
           unset($new->headers[$header]);
        }
        $new->headers[$header] = $value;
        return $new;
    }

    

}