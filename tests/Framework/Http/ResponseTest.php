<?php 
namespace Tests\Framework\Http;

use Framework\Http\Response;
use PHPUnit\Framework\TestCase;


class ResponseTest extends TestCase{
    public function testEmpty(): void
    {
        $response = new Response($body = 'Body');
        self::assertEquals($body,$response->getBody());
        self::assertEquals(200,$response->getStatusCode()); 
    }
}