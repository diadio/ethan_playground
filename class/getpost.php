<?php

class getpostCtrl{
    function __construct(){
        $this->filename = 'files.txt';
        $this->mode = FILE_APPEND;
        $this->data = var_export($_REQUEST, ture);
        $this->data .= var_export($_SERVER, ture);
        $this->data .= var_export($_FILES, true);
    }
    public function saveContent(){
        file_put_contents($this->filename, $this->data, $this->mode);

        echo file_get_contents($this->filename);
        echo "<div>THE END -SAVED</div>";
        return true;
    }
    public function rmContent(){
        unlink ($this->filename);
        echo "<div>THE END -REMOVED</div>";
        return true;
    }
    public function showContent(){
        echo file_get_contents($this->filename);
        echo "<div>THE END -SHOWING</div>";
        return true;
    }
}
