<?php

/**
 * @desc BooleanCoder
 *
 * @category  BooleanCoder.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-6-16 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\coder\impl;
use \bma\common\esp\coder as coder;

class BooleanCoder implements coder\BaseCoder {

    private static $_instance;

    function __construct() {
        
    }

    /**
     * 
     * @return \bma\common\esp\coder\impl\BooleanCoder
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function decoder($buf) {
        if ($buf instanceof coder\ByteArrayInputStream) {
            return $buf->read() == 0 ? false : true;
        }
        throw new \Exception('not \bma\common\esp\coder\ByteArrayInputStream type');
    }

    public function encoder($buf, $obj) {
        if (is_bool($obj)) {
            $bt = 1;
            if (!$obj) {
                $bt = 0;
            }
            if ($buf instanceof coder\ByteArrayOutputStream) {
                $buf->write($bt);
            }else{
                throw new \Exception('not \bma\common\esp\coder\ByteArrayOutputStream type');
            }
            return;
        }
        throw new \Exception('not boolean type');
    }

}
