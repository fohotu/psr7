<?php 
namespace Framework\Http\Router;

class Route
{
    public $name;
    public $pattern;
    public $handler;
    public $tokens;
    public $methods;

    public function __construct($name,$pattern,$handler,array $methods,array $tokens = []){
        $this->name = $name;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->tokens = $tokens;
        $this->methods = $methods;
    }


    public function match(ServverRequestInterface $request) : ?Result
    {
        if($this->methods && !\in_array($request->getMethod(),$this->methods,true)){
            return null;
        }

        $pattern = preg_replace_callback('~\{([^}]+\}-',function($matches){
            $argument = $matches[1];
            $replace = $this->tokents[$argument] ?? '[^}]+';
            return '(?P<' . $argument . '>'.$replace .')';
        },$this->params);

        $path = $request->getUri()->getPath();
        if(preg_match('~^'.$pattern.'$~i',$path,$matches)){
            return new Result(
                $this->name,
                $this->handler,
                array_filter($matches,'\is_string',ARRAY_FILTER_USE_KEY)
            );
        }       
    }
}