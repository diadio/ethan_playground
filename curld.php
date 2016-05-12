<?php
class curld{
    function __construct($ch, $url, $header=array(), $data=array(), $opt=array()){

        if(count($opt)==0)
        {
            $opt=array(
                CURLOPT_URL => $url,
                CURLOPT_HEADER => false,
                CURLOPT_POST => true, //application/x-www-form-urlencoded 
                CURLOPT_POSTFIELDS=> $data,
                //CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_AUTOREFERER => true,
                CURLOPT_FOLLOWLOCATION => true, // 自動重導303 302等
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
            trigger_error(curl_error($ch));
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
$url = '127.0.0.1';
$ch = curl_init();
$data = array('name' => 'Foo', 'file' => '@/home/user/test.png');
//$this->curld($ch, $url); //先爬首页 让cookie等参数抓取

$c = new curld($ch, $url, $data);
var_dump($c->getContent());

sleep(0.5);
curl_close($ch); //关闭所有连线