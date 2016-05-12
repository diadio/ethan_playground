<?php
class curld{
    public function __construct($ch, $url, $header=array(), $opt=array()){

        if(count($opt)==0)
        {
            $opt=array(
                CURLOPT_URL => $url,
                CURLOPT_HEADER => false,
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
        if(!$contents = curl_exec($ch))
        {
            trigger_error(curl_error($ch));
            return self::failed(31, "curl取内容出错(content-error)");
        }

        if (strlen($contents) < 10) {
            return self::failed(32, "curl取内容异常：contents=$contents");
        }
        return $contents;
    }
}
$url = 'www.google.com';
$ch = curl_init();
$this->curld($ch, $url); //先爬首页 让cookie等参数抓取
sleep(0.5);
$contents = $this->curld($ch, $secUrl);
curl_close($ch); //关闭所有连线