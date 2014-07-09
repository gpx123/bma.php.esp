<?php

/**
 * @desc StringCoder
 *
 * @category  StringCoder.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-6-24 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\coder\impl;

use \bma\common\esp\coder as coder;

class LenStringCoder implements coder\BaseCoder {
    
    private static $_instance;

    function __construct() {
        
    }

    /**
     * 
     * @return \bma\common\esp\coder\impl\LenStringCoder
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function decoder($buf) {
        if ($buf instanceof coder\ByteArrayInputStream) {
            $int32Coder = coder\impl\Int32Coder::getInstance();
            $i = $int32Coder->decoder($buf);
            $bytes = array();
            $buf->readByLen($bytes, 0, $i);
            return eval("return pack('c*', ". join(',', $bytes) .");");
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

    public function encoder($buf, $obj) {
        if ($buf instanceof coder\ByteArrayOutputStream) {
            $bytes = unpack('c*',$obj);
            $i = count($bytes);
            $int32Coder = coder\impl\Int32Coder::getInstance();
            $int32Coder->encoder($buf, $i);
            $stringCoder = coder\impl\StringCoder::getInstance();
            $stringCoder->encoder($buf, $obj);
            return ;
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

}
