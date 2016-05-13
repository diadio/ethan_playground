<?php
// Report all PHP errors
error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
class curld{
    static function failed($num, $msg){
        echo json_encode( array('code'=>$num, 'msg'=>$msg) );
    }
    function __construct($ch, $url, $header=array(), $data=array(), $opt=array()){

        if(count($opt)==0)
        {
            $opt=array(
                CURLOPT_URL => $url,
                CURLOPT_HEADER => false,
                CURLOPT_POST => true, //application/x-www-form-urlencoded 
                CURLOPT_POSTFIELDS=> $data,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_FOLLOWLOCATION => true, // 自動重導303 302等
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_FRESH_CONNECT => 1,
                CURLOPT_HTTPHEADER => $header
            );
        }

        curl_setopt_array($ch, $opt);
        // grab URL and pass it to the browser
        if(!$this->contents = curl_exec($ch))
        {
            //trigger_error(curl_error($ch));
            return self::failed(31, "curl取内容出错(content-error)");
        }

        if (strlen($this->contents) < 10) {
            return self::failed(32, "curl取内容异常：contents=$contents");
        }

    }
    public function getContent(){
        return $this->contents;
    }
    
}
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