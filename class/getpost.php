<?php

class getpostCtrl{
    function __construct(){
        $this->filename = 'files.txt';
        $this->mode = FILE_APPEND;
        $this->data = var_export($_REQUEST, ture);

        file_put_contents($this->filename, $this->data, $this->mode);
        echo file_get_contents($this->filename);
        echo "<div>THE END</div>";
    }
    public function getContent(){
        return $this->contents;
    }
}
