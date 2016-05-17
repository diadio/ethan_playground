<?php

class getpostCtrl{
    function __construct(){
        $this->filename = 'files.txt';
        $this->mode = FILE_APPEND;
        $this->data = var_export($_REQUEST);

        file_put_contents($this->file, $this->data, $this->mode);
        echo file_get_contents('./files.txt');
    }
    public function getContent(){
        return $this->contents;
    }
    
}
