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

use \bma\common\esp\po as po;


class ESNPMesNoFramer extends ESNPBaseFramer {

    private static $_instance;

    /**
     * 
     * @return \bma\common\esp\framer\ESNPMesNoFramer
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
    private $mesNo;

    function __construct() {
    }
    
    public function buildFrameIn($framerType,$in){
        parent::setFramerType($framerType);
        parent::setFramerBodyLengthIn($in);
	$this->setMesNoIn($in);
    }
    

    public function getMesNo() {
            return $this->mesNo;
    }

    public function setMesNo($mesNo) {
            $this->mesNo = $mesNo;
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
    public function setMesNoIn($in) {
        if(parent::getFramerType() == 0 || parent::getFramerBodyLength() == 0){
            return ;
        }
        $coder = coder\impl\FixUint16Coder::getInstance();
        $this->mesNo = $coder->decoder($in);
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
    public function mesNoFramerToOutputStream($out){	
            $mesNoOut = coder\ByteArrayOutputStream::getInstance();
            $coder = coder\impl\FixUint64Coder::getInstance();
            $coder->encode($mesNoOut,$this->mesNo);
            $dataByte = $mesNoOut->toByteArray();
            parent::toOutputStream($out,count($dataByte));	
            $out->write($dataByte);		
    }
    
    public function readInputStream($framerType, $in) {
            parent::setFramerType($framerType);
            parent::setFramerBodyLength($in);
            $this->setMesNoIn($in);
    }
	
    /**
     * 生成源帧
     * @param mnf
     * @return
     */
    public function tranToMesSnoFramer(){
        $msf = coder\ESNPMesSnoFramer::getInstance();
        $msf->setMesSno($this->getMesNo());
        $msf->setFramerType(po\FramerCommon::FRAMER_TYPE_SID);
        return msf;
    }
}
