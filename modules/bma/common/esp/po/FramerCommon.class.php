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

class FramerCommon {
    
    private static $_instance;
    
    //ID
    const  FRAMER_TYPE_ID = 0x11;
    //源ID
    const  FRAMER_TYPE_SID = 0x12;
    //请求类型
    const  FRAMER_TYPE_TYPE = 0x13;
    //请求地址
    const  FRAMER_TYPE_ADDRESS = 0x17;
    //数据
    const  FRAMER_TYPE_DATA = 0x15;
    //错误
    const  FRAMER_TYPE_ERROR = 0x1D;

    function __construct() {
        
    }

    /**
     * 
     * @return \bma\common\esp\po\FramerCommon
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
}
