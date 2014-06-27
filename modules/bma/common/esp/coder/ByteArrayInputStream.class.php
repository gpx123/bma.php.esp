<?php

/**
 * @desc InputStream
 *
 * @category  InputStream.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-6-16 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\coder;

Class ByteArrayInputStream {
    
    private $buf;
    
    private $count;
    
    private $pos;

    private static $_instance;
    
    function __construct($buf){
        $this->buf = $buf;
        $this->count = count($buf);
        $this->pos = 0;
    }
    
    public function available(){
        return $this->count - $this->pos;
    }
    
    /**
     * 
     * @return \bma\common\esp\coder\ByteArrayInputStream
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function read(){
        return ($this->pos < $this->count) ? ($this->buf[$this->pos++] & 0xff) : -1;
    }
    
}
