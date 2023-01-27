<?php 
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

use Framework\Http\ResponseSender;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';


$request = ServerRequestFactory::fromGlobals();


$path = $request->getUri()->getPath();

if($path == '/'){
    $action = function(ServeRequestInterface $request){
        $name = $request->getQueryParams()['name'] ?? 'Guest';
        return new HtmlResponse('Hello '.$name);  
    
    };
     
}else if($path == '/about'){
    $action = function(){
      return  new HtmlResponse('About Page'); 
    };
    
}else if($path ='/blog'){
    $action = function(){
        return new JsonResponse([
            ['id'=>2,'title'=>'Blog 2'],
            ['id'=>1,'title'=>'Blog 1'],
        ]);
    };

}else if(preg_match('#^/blog/(?P<id>\d+)$#i',$path,$matches)){
    $id = $matches['id'];
    if($id > 2){
        return JsonResponse(['error'=>'Undifined page'],404);
    }else{
        return JsonResponse(['id'=>$id,'title'=>'Post #'.$id]);
    }
}else{
    return  JsonResponse(['error'=>'Page Not found'],404);

}

if($action){
    $response = $action($request);
}else{
    $response = new JsonResponse(['error'=>'Undifined page'],404);
}

//$response = (new HtmlResponse('Hello'.$name.'-'))
$response->withHeader('X-Devoloper','Fp');


$emitter = new SapiEmitter();
$emitter->emit($response);
/*
$router = new Router();

$router->get('/',function(){});
$router->get('/about',function(){});
$router->get('/blog',function(){});

$result = $router->match($request);
$action = $result->getAction();
$attributes = $result->getAttributes();

foreach($attributes as $name => $value){
    $request = $request->withAttribute($name,$value);
}
$response = $action($request);

*/