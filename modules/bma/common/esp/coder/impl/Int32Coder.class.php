<?php

/**
 * @desc Int64Coder
 *
 * @category  Int64Coder.class.php
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

class Int64Coder implements coder\BaseCoder {

    private static $_instance;

    function __construct() {
        
    }
    /**
     * 
     * @return \bma\common\esp\coder\impl\Int64Coder
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function decoder($buf) {
        $l = coder\impl\Uint64Coder::uint64Decoder($buf);
        $l2 = $l >> 1;
        if(($l & 1) != 0){
                $l2 = ~$l2;
        }
        return $l2;
    }

    public function encoder($buf, $obj) {
        if(is_int($obj)){
            $l = $obj << 1;
            if($obj < 0){
                $l = ~$l;
            }
            return coder\impl\Uint64Coder::uint64Encoder($buf, $l);
        }
    }
    
}
