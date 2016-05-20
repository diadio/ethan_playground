<?php

class autoSendCtrl{
    include './class/curld.php';
    function __construct(){
        $this->filename = './save/files.php';
        $this->mode = FILE_APPEND;

        $this->sendDataToLine('ud1118f8f3f6714869cae193942b023a3', "Welcome!");
    }

    private function sendDataToLine($id, $msg){
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

        //$this->curld($ch, $url); //先爬首页 让cookie等参数抓取

        $c = new curld($ch, $url, $headers, json_encode($data));
        var_dump($c->getContent());
        file_put_contents('ttt.html', $c->getContent());
        sleep(0.5);
        curl_close($ch); //关闭所有连线
    }

}
$a = autoSendCtrl();