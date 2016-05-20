<?php

class getpostCtrl{
    function __construct(){
        $this->filename = './save/files.php';
        $this->mode = FILE_APPEND;

        //$this->data .= var_export($_REQUEST, ture);
        //$this->data .= var_export($_SERVER, ture);
        //$this->data .= file_get_contents('php://input');
        if($_GET['act'] == 'rm')
        {
            $this->rmContent();
        }elseif($_GET['act'] == 'show'){
            if($_GET['code']!='C938617CEEB4C6352F2AE71147B2313BE1CDA94817CD1AA29825A13DC6932B25E13C496ACB4DA26745B2D624186D84F5B3AA591329BEE8575F54')
                $this->showContent();
            else
                die();
        }else{
            $this->data = json_decode(file_get_contents('php://input'));
            if(!$this->data)
                die('error');
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
        for($i=0; $i<10; $i++)
        {
            $this->sendDataLToLine($form, $msg.time());
            sleep(3);
        }
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
            "X-Line-ChannelSecret: cf634ffe936c452a77b4ff8003eac0a9", 
            "X-Line-Trusted-User-With-ACL: u4e1165732698f7880f324a13efe95655"
        );

        $data = array('to' => array($id), 'toChannel' => 1383378250, 'eventType'=>'138311608800106203','content'=>
            array('contentType'=>1, 'toType'=>1, 'text'=>$msg)
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
