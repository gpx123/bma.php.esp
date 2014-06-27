<?php

/**
 * @desc OutputStream
 *
 * @category  OutputStream.class
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-6-16 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\coder;

Class ByteArrayOutputStream {
    
    private $buf;
    
    private $count;

    private static $_instance;

    function __construct() {
        
    }
    
    public function toByteArray(){
        return $this->buf;
    }
    
    /**
     * 
     * @return \bma\common\esp\coder\ByteArrayOutputStream
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function write($b){
        $this->buf[] = $b;
        $this->count = count($this->buf);
    }
}
