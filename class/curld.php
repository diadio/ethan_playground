<?php

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
