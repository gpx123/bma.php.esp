<?php

/**
 * @desc VarTypeCommon
 *
 * @category  VarTypeCommon.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-7-4 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\po;

class VarTypeCommon {
    
    private static $_instance;
    
    const TYPE_NULL = 0;
    const TYPE_BOOLEAN = 1;
    const TYPE_INT = 2;
    const TYPE_INT8 = 3;
    const TYPE_INT16 = 4;
    const TYPE_INT32 = 5;
    const TYPE_INT64 = 6;
    const TYPE_UINT = 7;
    const TYPE_UINT8 = 8;
    const TYPE_UINT16 = 9;
    const TYPE_UINT32 = 10;
    const TYPE_UINT64 = 11;
    const TYPE_FLOAT32 = 13;
    const TYPE_FLOAT64 = 14;
    const TYPE_LEN_BYTES = 17;
    const TYPE_MAP = 21;
    const TYPE_LIST = 23;
    const TYPE_LEN_STRING = 24;

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
    
}
