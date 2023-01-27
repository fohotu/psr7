<?php 
namespace Framework\Http\Router;

class Router{
    private $routes;

    public function __construct()
    {
        $this->routes = $routes;
    }

    public function match(ServRequestInerface $request) : Result
    {
        foreach($this->routes->getRoutes() as $route){
            if(preg_match($pattern,$request->getUri()->getPath(),$matches)){
                return new Result($name,$handler,$attributes);
            }
        }

        throw new RequestNotMatchedException($request);
    }

    public function generate($name,array $params = []):string 
    {
        $arguments = array_filter($params);
        foreach($this->routes->getRoutes() as $route){
            if($name !== $route->name){
                continue;
            }
            if($url !==null)
            {
                return $url;
            }
        }
        throw new RouteNotFoundException($name,$params);
    }
}