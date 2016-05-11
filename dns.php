<?php
    error_reporting(E_ALL);

    echo "<h2>UDP/IP Connection</h2>\n";

    /* Get the port for the WWW service. */
    $service_port = getservbyname('www', 'tcp');
    $service_port = 53;

    /* Get the IP address for the target host. */
    $address = gethostbyname('www.yahoo.com');
    $address = '8.8.8.8';

    /* Create a TCP/IP socket. */
    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    if ($socket === false) {
        echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
    } else {
        echo "OK.\n";
    }

    echo "Attempting to connect to '$address' on port '$service_port'...";
    $result = socket_connect($socket, $address, $service_port);
    if ($result === false) {
        echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
    } else {
        echo "OK.\n";
    }
    
    /*
        GET /manual/en/function.getservbyname.php HTTP/1.1
        Host: php.net
        Connection: keep-alive
        Cache-Control: max-age=0
    */
        //Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8
    /*      
        Upgrade-Insecure-Requests: 1
        User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36
        Referer: https://www.google.com.ph/
        Accept-Encoding: gzip, deflate, sdch
        Accept-Language: en-US,en;q=0.8,fr;q=0.6,ja;q=0.4
        Cookie: COUNTRY=NA%2C203.192.160.250; LAST_LANG=en
        If-Modified-Since: Tue, 10 May 2016 04:08:20 GMT
    */
    $in = "GET / HTTP/1.1";
    $in .= "Host: www.example.com\r\n";
    $in .= "Connection: keep-alive\r\n\r\n";
    
    /*
    [Request In: 913]
    Transaction ID: 0x2c7a
    Flags: 0x8180 Standard query response, No error
    Questions: 1
    Answer RRs: 3
    Authority RRs: 4
    Additional RRs: 4
    */
    $in2 = "";
    
    $out = '';

    echo "Sending HTTP HEAD request...";
    socket_write($socket, $in2, strlen($in2));
    echo "OK.\n";

    echo "Reading response:\n\n";
    while ($out = socket_read($socket, 2048)) {
        echo $out;
    }

    echo "Closing socket...";
    socket_close($socket);
    echo "OK.\n\n";
    //exit;
?>