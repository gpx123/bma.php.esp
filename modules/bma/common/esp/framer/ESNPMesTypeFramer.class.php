<?php

/**
 * @desc ESNPMesNoFramer
 *
 * @category  ESNPMesNoFramer.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-7-15 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */


namespace bma\common\esp\framer;

use \bma\common\esp\coder as coder;


class ESNPMesTypeFramer extends ESNPBaseFramer {

    private static $_instance;

    /**
     * 
     * @return \bma\common\esp\framer\ESNPMesTypeFramer
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
    /**
     * ID编号
     */
    private $mesType;

    function __construct() {
    }
    
    public function buildFrameIn($framerType,$in){
        parent::setFramerType($framerType);
        parent::setFramerBodyLengthIn($in);
	$this->setMesTypeIn($in);
    }
    

    public function getMesType() {
            return $this->mesType;
    }

    public function setMesType($mesType) {
            $this->mesType = $mesType;
    }
	
    /**
     * 
    * @Title: setMesNo 
    * @Description: 从流中读取消息编号
    * @param @param in
    * @param @throws IOException    
    * @return void    
    * @throws
     */
    public function setMesTypeIn($in) {
        if(parent::getFramerType() == 0 || parent::getFramerBodyLength() == 0){
            return ;
        }
        $coder = coder\impl\FixUint32Coder::getInstance();
        $this->mesType = $coder->decoder($in);
    }
	
    /**
     * 
    * @Title: mesNoFramerToOutputStream 
    * @Description: 将消息帧写入流
    * @param @param out
    * @param @throws IOException    
    * @return void    
    * @throws
     */
    public function mesTypeFramerToOutputStream($out){	
            $mesNoOut = coder\ByteArrayOutputStream::getInstance();
            $coder = coder\impl\FixUint64Coder::getInstance();
            $coder->encode($mesNoOut,$this->mesType);
            $dataByte = $mesNoOut->toByteArray();
            parent::toOutputStream($out,count($dataByte));	
            $out->write($dataByte);		
    }
    
    public function readInputStream($framerType, $in) {
            parent::setFramerType($framerType);
            parent::setFramerBodyLength($in);
            $this->setMesTypeIn($in);
    }
}
