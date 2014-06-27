<?php

header("Content-Type:text/html; charset=utf-8");
require_once __DIR__ . '/../bootstrap.php';
echo "<pre>";

use \bma\common\esp\coder as coder;
use bma\common\esp\util as util;

if (true) {
    $bos = coder\ByteArrayOutputStream::getInstance();
    $obj = 0;
    $coder = coder\impl\Uint64Coder::getInstance();
    $coder->encoder($bos, $obj);
    var_dump(util\StringUtil::byte2Hex($bos->toByteArray()));
    $bis = new coder\ByteArrayInputStream($bos->toByteArray());
    var_dump($coder->decoder($bis)) ;
}