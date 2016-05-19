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
        if($_GET['act'] == 'rm')
        {
            $this->rmContent();
        }elseif($_GET['act'] == 'show'){
            $this->showContent();
        }else{  
            $this->saveContent();
        }
    }
    public function saveContent(){
        $form = $this->data->result[0]->content->from;
        $msg = $this->data->result[0]->content->text;
        $data_arr = array("form_id"=>$form, "msg"=>$msg, "time"=>time());
        $data = json_encode($data_arr).PHP_EOL;
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
    private function sendDataLToLine($id, $msg){
        $url = 'https://trialbot-api.line.me/v1/events';
        $ch = curl_init();
        $headers = array( 
            "Content-Type: application/json; charser=UTF-8",
            "User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36",
            "X-Line-ChannelID: 1467309815",
            "X-Line-ChannelSecret: 4e09f7b1c211ff953ce14efc772f508e", 
            "X-Line-Trusted-User-With-ACL: u4e1165732698f7880f324a13efe95655"
            
        );

        $data = array('to' => array('u5912407b444e54885d00111f7b0ce375'), 'toChannel' => 1383378250, 'eventType'=>'138311608800106203','content'=>
            array('contentType'=>1, 'toType'=>1, 'text'=>'Hello,Jose!')
        );

        var_dump(json_encode($data));
        //$this->curld($ch, $url); //先爬首页 让cookie等参数抓取

        $c = new curld($ch, $url, $headers, json_encode($data));
        var_dump($c->getContent());
        file_put_contents('ttt.html', $c->getContent());
        sleep(0.5);
        curl_close($ch); //关闭所有连线
    }

}
