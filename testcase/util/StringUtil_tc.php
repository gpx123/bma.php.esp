<?php

header("Content-Type:text/html; charset=utf-8");
require_once __DIR__ . '/../bootstrap.php';
echo "<pre>";

use bma\common\esp\util as util;

if (true) {
    $data = array(5, 90);
    $a = util\StringUtil::byte2Hex($data);
    var_dump($a);
}