<?php

/**
 * @desc ESNPMesSnoFramer
 *
 * @category  ESNPMesSnoFramer.class.php
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


class ESNPMesSnoFramer extends ESNPBaseFramer {

    private static $_instance;

    /**
     * 
     * @return \bma\common\esp\framer\ESNPMesSnoFramer
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
    private $mesSno;

    function __construct() {
    }
    
    public function buildFrameIn($framerType,$in){
        parent::setFramerType($framerType);
        parent::setFramerBodyLengthIn($in);
	$this->setMesSnoIn($in);
    }
    

    public function getMesSno() {
            return $this->mesSno;
    }

    public function setMesSno($mesSno) {
            $this->mesSno = $mesSno;
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
    public function setMesSnoIn($in)  {
        if(parent::getFramerType() == 0 || parent::getFramerBodyLength() == 0){
                return ;
        }
        $uint64Coder = coder\impl\Uint64Coder::getInstance();
        $this->mesSno = $uint64Coder->decoder($in);
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
    public function mesSnoFramerToOutputStream($out){	
            $mesSnoOut = coder\ByteArrayOutputStream::getInstance();
            $coder = coder\impl\FixUint64Coder::getInstance();
            $coder->encode($mesSnoOut,$this->mesSno);
            $dataByte = $mesSnoOut->toByteArray();
            parent::toOutputStream($out,count($dataByte));	
            $out->write($dataByte);		
    }
    
    public function readInputStream($framerType, $in) {
            parent::setFramerType($framerType);
            parent::setFramerBodyLength($in);
            $this->setMesSnoIn($in);
    }
}
