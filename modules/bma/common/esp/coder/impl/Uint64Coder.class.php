<?php

/**
 * @desc Uint64Coder
 *
 * @category  Uint64Coder.class.php
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

class Uint64Coder implements coder\BaseCoder {

    private static $_instance;

    /**
     * 
     * @return \bma\common\esp\coder\impl\Uint64Coder
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct() {
        
    }

    public static function uint64Encoder($buf, $l) {
        if ($buf instanceof coder\ByteArrayOutputStream) {
            $i = 0;
            while ($l >= 0x80) {
                $buf->write($l | 0x80);
                $l = $l>>7;
                $i++;
            }
            $buf->write($l);
            return $i + 1;
        }
        throw new \Exception('not coder\ByteArrayOutputStream type');
    }

    public static function uint64Decoder($buf) {
        if ($buf instanceof coder\ByteArrayInputStream) {
            $s = $b = $w = $i = 0;
            $count = $buf->available();
            while ($count != 0) {
                $b = $buf->read();
                if ($b < 0x80) {
                    if ($i > 9 || $i == 9 && $b > 1) {
                        return 0; // overflow
                    }
                    return ($s | $b << $w);
                }
                $s = $s | ($b & 0x7f) << $w;
                $w += 7;
                $count--;
            }
            return 0;
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

    public function decoder($buf) {
        return Uint64Coder::uint64Decoder($buf);
    }

    public function encoder($buf, $obj) {
        return Uint64Coder::uint64Encoder($buf, $obj);
    }
}
