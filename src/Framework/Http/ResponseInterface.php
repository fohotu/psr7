<?php 
namespace Framework\Http;

interface ServerRequestInterface
{

    public function withBody($body);

    public function getStatusCode();

    public function getReasonPhrase();

    public function withStatus($code,$reasonPhrase = '');



    public function getHeaders(): array;

    public function hasHeader($header): bool;

    public function getHeader($header);

    public function withHeaders($header,$value = '');

}
