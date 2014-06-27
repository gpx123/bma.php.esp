<?php

header("Content-Type:text/html; charset=utf-8");
require_once __DIR__ . '/../bootstrap.php';
echo "<pre>";

use \bma\common\esp\coder as coder;
use bma\common\esp\util as util;

if (true) {
    $bos = coder\ByteArrayOutputStream::getInstance();
    $obj = true;
    $coder = coder\impl\BooleanCoder::getInstance();
    $coder->encoder($bos, $obj);
    $bis = new coder\ByteArrayInputStream($bos->toByteArray());
    var_dump($coder->decoder($bis)) ;
}