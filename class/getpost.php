<?php

class getpostCtrl{
    function __construct(){
        $this->filename = 'files.txt';
        $this->mode = FILE_APPEND;
        $this->data = json_decode(file_get_contents('php://input'));
        if(!$this->data)
            return 'error';
        //$this->data .= var_export($_REQUEST, ture);
        //$this->data .= var_export($_SERVER, ture);
        //$this->data .= file_get_contents('php://input');
    }
    public function saveContent(){
        $form = $this->data->result[0]->content->from;
        $msg = $this->data->result[0]->content->text;
        $data = '{from_id:"'$form.'", msg:"'.$msg.'"}'.PHP_EOL;

        file_put_contents($this->filename, $data, $this->mode);
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
