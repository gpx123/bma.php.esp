<?php

/**
 * @desc MapCoder
 *
 * @category  MapCoder.class.php
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

class MapCoder implements coder\BaseCoder {

    private static $_instance;

    function __construct() {
        
    }

    /**
     * 
     * @return \bma\common\esp\coder\impl\MapCoder
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function decoder($buf) {
        if ($buf instanceof coder\ByteArrayInputStream) {
            $obj = array();
            $coder = coder\impl\Int32Coder::getInstance();
            $varCoder = coder\impl\VarCoder::getInstance();
            $size = $coder->decoder($buf);
            $mark = 1;
            while ($mark <= $size) {
                $obj[] = $varCoder->decoder($buf);
                $mark++;
            }
            return $obj;
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

    public function encoder($buf, $obj) {
        if ($buf instanceof coder\ByteArrayOutputStream) {
            if ($obj == null) {
                return;
            }
            //map长度
            $coder = coder\impl\Int32Coder::getInstance();
            $varCoder = coder\impl\VarCoder::getInstance();
            $lenStringCoder = coder\impl\LenStringCoder::getInstance();
            $coder->encoder($buf, count($obj));
            foreach ($obj as $k=>$o) {
                $lenStringCoder->encoder($buf, $k);
                $varCoder->encoder($buf, $o);
            }
            return;
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

}
