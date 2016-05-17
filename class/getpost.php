<?php

class getpostCtrl{
    function __construct(){
        var_dump($_REQUEST);
    }
    public function getContent(){
        return $this->contents;
    }
    
}
