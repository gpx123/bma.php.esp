<?php

header("Content-Type:text/html; charset=utf-8");
require_once __DIR__ . '/../bootstrap.php';
echo "<pre>";

if (true) {
    $socketAddr = "172.19.16.195";
    $socketPort = "11211";
    $packet = "get good".PHP_EOL;
    $socket = bma\common\esp\socket\Socket::singleton();
    $socket->connect($socketAddr, $socketPort); //连服务器            
    $socket->sendRequest($packet); // 将包发送给服务器 
    var_dump($socket->waitForResponse());
    $socket->disconnect(); //关闭链接
}
