<?php

class BaseController{
    public function loadView($path ,$datas=[]){
        require_once($path);
    }
}

?>