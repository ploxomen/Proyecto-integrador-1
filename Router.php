<?php
class Router{
    private $_uri = [];
    private $_accion = [];
    public function add(string $uri,$accion = null)
    {
        $this->_uri[] = '/' . trim($uri,"/");
        if(!is_null($accion)){
            $this->_accion[] = $accion;
        }
    }
    public function run()
    {
        $uriGet = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        foreach ($this->_uri as $key => $value) {
            if(preg_match("#^$value$#",$uriGet)){
                $accion = $this->_accion[$key];
                $this->runAction($accion);
            }
        }
    }
    private function runAction($accion)
    {
        if($accion instanceof \Closure){
            $accion();
        }else{
            $params = explode('@',$accion);
            $obj = new $params[0];
            $obj->{$params[1]}();
        }
    }
}

?>