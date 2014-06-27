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

class StringCoder implements coder\BaseCoder {
    
    private static $_instance;

    function __construct() {
        
    }

    /**
     * 
     * @return \bma\common\esp\coder\impl\StringCoder2
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function decoder($buf) {
        if ($buf instanceof coder\ByteArrayInputStream) {
            $bytes = array();
            while($buf->available()>0){
                $bytes[] = $buf->read();
            }
            return eval("return pack('c*', ". join(',', $bytes) .");");
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

    public function encoder($buf, $obj) {
        if ($buf instanceof coder\ByteArrayOutputStream) {
            $bytes = unpack('c*',$obj);
            foreach ($bytes as $byte) {
                $buf->write($byte);
            }
            return ;
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

}
