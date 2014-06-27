<?php

/**
 * @desc FixInt64Coder
 *
 * @category  FixInt64Coder.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-6-23 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\coder\impl;

use \bma\common\esp\coder as coder;

class FixInt64Coder implements coder\BaseCoder {

    private static $_instance;

    function __construct() {
        
    }

    /**
     * 
     * @return \bma\common\esp\coder\impl\FixInt64Coder
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function decoder($buf) {
        if ($buf instanceof coder\ByteArrayInputStream) {
            $s = 0;
            $s += ($buf->read() & 0xff) << 56;
            $s += ($buf->read() & 0xff) << 48;
            $s += ($buf->read() & 0xff) << 40;
            $s += ($buf->read() & 0xff) << 32;
            $s += ($buf->read() & 0xff) << 24;
            $s += ($buf->read() & 0xff) << 16;
            $s += ($buf->read() & 0xff) << 8;
            $s += ($buf->read() & 0xff) << 0;
            return $s;
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

    public function encoder($buf, $obj) {
        if ($buf instanceof coder\ByteArrayOutputStream) {
            $buf->write($obj >> 56);
            $buf->write($obj >> 48);
            $buf->write($obj >> 40);
            $buf->write($obj >> 32);
            $buf->write($obj >> 24);
            $buf->write($obj >> 16);
            $buf->write($obj >> 8);
            $buf->write($obj >> 0);
            return;
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

}
