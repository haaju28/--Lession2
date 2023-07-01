<?php

class App{
    private $controller = 'productController';
    private $action ='index';
    private $parameter=[];

    public function __construct(){
        if(isset($_GET['url'])){
            $url = $_GET['url'];
            $url = explode('/',$url);
            $this->controller = ($url[0] ?? 'product') . 'Controller';
            require_once './controller/'. $this->controller .'.php';
            $this->action = $url[1] ?? 'index';
            $this->parameter = $url[2] ?? [];
            $this->controller = new $this->controller();
            call_user_func_array([$this->controller, $this->action], [$this->parameter]);
        }
    }
}

?>