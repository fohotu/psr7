<?php 
namespace Tests\Framework\Http;

use Framework\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{

    protected function setUp(): void 
    {
        parent::setUp();
        $_POST = [];
        $_GET = [];
    }

    public function testEmpty(): void
    {
        $request = new Request;
        self::assertEquals([],$request->getQueryParams());
        self::assertNull($request->getParsedBody());
    }

    public function testQueryParams(): void
    {
        $data =[
            'name'=>'Harry'
        ];

        $request = (new Request())
        ->withQueryParams($data);
        self::assertEquals($data,$request->getQueryParams());
        self::assertNull($request->getParsedBody());
    }

    public function testParsedBody(): void 
    {
   
        $data =[
            'name'=>'Harry'
        ];

        $request = (new Request())
        ->withParsedBody($data);
        self::assertEquals([],$request->getQueryParams());
        self::assertEquals($data,$request->getParsedBody());

    }
}
?>