<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @desc ESNPBaseFramer
 *
 * @category  ESNPBaseFramer.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-7-15 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 */

namespace bma\common\esp\framer;

abstract Class ESNPBaseFramer {

    private static $_instance;

    function __construct() {
        
    }

    /**
     * 
     * @return \bma\common\esp\framer\ESNPBaseFramer
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 帧类型
     */
    private $framerType;

    /**
     * 体大小
     */
    private $framerBodyLength;

    public function getFramerType() {
        return framerType;
    }


    public function setFramerType($framerType) {
        $this->framerType = $framerType;
    }

    public function getFramerBodyLength() {
        return $this->framerBodyLength;
    }

    public function setFramerBodyLength($framerBodyLength) {
            $this->framerBodyLength = $framerBodyLength;
    }
	
    /**
    * 
    * @Title: setFramerBodyLength 
    * @Description: 从流中获取体大小数据
    * @param @param in
    * @param @throws IOException    
    * @return void    
    * @throws
     */
    public function setFramerBodyLengthIn($in) {
            $s = 0;
            $s += ($in->read() & 0xff) << 16;
            $s += ($in->read() & 0xff) << 8;
            $s += ($in->read() & 0xff) ;	
            $this->framerBodyLength = $s;
    }	

    /**
    * 
    * @Title: toStreamFramerBodyLength 
    * @Description: 将体大小数据写进流
    * @param @param out
    * @param @throws IOException    
    * @return void    
    * @throws
    */
    private function toStreamFramerBodyLength($out)  {
        $out->write($this->framerBodyLength >> 16);
        $out->write($this->framerBodyLength >> 8);
        $out->write($this->framerBodyLength >> 0);
    }
	
    /**
     * 
    * @Title: toStreamFramerBodyLength 
    * @Description: 将体大小数据写进流
    * @param @param out
    * @param @throws IOException    
    * @return void    
    * @throws
     */
    private function toStreamFramerBodyDataLength($out,$dataLength) {
        $out->write($dataLength >> 16);
        $out->write($dataLength >> 8);
        $out->write($dataLength >> 0);
    }

    /**
     * 
    * @Title: toOutputStream 
    * @Description: 将帧类型和体大小写入流
    * @param @param out
    * @param @throws IOException    
    * @return void    
    * @throws
     */
    public function toOutputStream($out){
            $typeByte = array();
            $typeByte[0] = $this->framerType;
            $out->write($typeByte);
            $this->toStreamFramerBodyLength($out);		
    }

    /**
     * 
    * @Title: toOutputStream 
    * @Description: 将帧类型和体大小写入流
    * @param @param out
    * @param @throws IOException    
    * @return void    
    * @throws
     */
    public function toOutputStreamData($out,$dataLength) {
            $typeByte = array();
            $typeByte[0] = $this->framerType;
            $out->write(typeByte);
            $this->toStreamFramerBodyLength($out,$dataLength);		
    }

    /**
     * 
    * @Title: readInputStream 
    * @Description: 从流中初始化对象
    * @param @param framerType
    * @param @param in    
    * @return void    
    * @throws
     */
    public abstract function readInputStream($framerType,$in) ;
    
    
}

?>
