<?php

/**
 * @desc FixUint32
 *
 * @category  FixUint32.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-7-9 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\coder\type;

class FixUint32 {

    private static $_instance;
    
    private $value;

    function __construct($value) {
        $this->setValue($value);
    }
    
    public function setValue($value){
        $this->value = $value;
    }
    
    public function getValue(){
        return $this->value;
    }

    /**
     * 
     * @return \bma\common\esp\coder\type\FixUint32
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
