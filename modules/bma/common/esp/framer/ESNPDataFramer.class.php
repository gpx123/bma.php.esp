<?php

/**
 * @desc ESNPDataFramer
 *
 * @category  ESNPDataFramer.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-7-21 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */


namespace bma\common\esp\framer;

use \bma\common\esp\coder as coder;


class ESNPDataFramer extends ESNPBaseFramer {

    private static $_instance;

    /**
     * 
     * @return \bma\common\esp\framer\ESNPDataFramer
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct() {
    }
	
	
    /**
     * 数据名
     */
    private $dataName;

    /**
     * 数据类型
     */
    private $dataType;


    /**
     * 数据
     */
    private $data;
	
    public function buildFrameIn($framerType,$in){
        parent::setFramerType($framerType);
        parent::setFramerBodyLengthIn($in);
	$this->setMesTypeIn($in);
    }
		
    public function getDataName() {
        return $this->dataName;
    }

    public function setDataName($dataName) {
        $this->dataName = $dataName;
    }

    public function getDataType() {
        return $this->dataType;
    }

    public function setDataType($dataType) {
        $this->dataType = $dataType;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    /**
     * 
    * @Title: setDataList 
    * @Description: 从流中读取数据信息
    * @param @param in
    * @param @throws IOException    
    * @return void    
    * @throws
     */
    public function setDataFramer($in) {
        if(parent::getFramerType() == 0 || parent::getFramerBodyLength() == 0){
            return ;
        }

        $length = parent::getFramerBodyLength();
        if($in->available() < $length){
            return ;
        }
        $dataByte = array();
        $in->readByLen($dataByte, 0, $length);
        $dataIn = new coder\ByteArrayInputStream($dataByte);
        $lenStringCoder = coder\impl\LenStringCoder::getInstance();
        $this->setDataName($lenStringCoder->decoder($dataIn));
        $t = $dataIn->read();
        $this->setDataType($t);
        $varCoder = coder\impl\VarCoder::getInstance();
        $this->setData($varCoder->decoderByType($dataIn,$t));
    }
	
    /**
     * 
    * @Title: addressFramerToOutputStream 
    * @Description: 将地址帧写入流
    * @param @param out
    * @param @throws IOException    
    * @return void    
    * @throws
     */
    public function dataFramerToOutputStream($out) {
        if($this->dataName == null || $this->data == null){
                return ;
        }
        $dataOut = new coder\ByteArrayOutputStream();
        $lenStringCoder = coder\impl\LenStringCoder::getInstance();
        $lenStringCoder->encoder($dataOut, $this->dataName);
        $varCoder = coder\impl\VarCoder::getInstance();
        $varCoder->encoderByType($dataOut, $this->data, $this->dataType);
        $dataByte = $dataOut->toByteArray();
        parent::toOutputStream($out,count($dataByte));	
        $out->write($dataByte);
    }

    public function readInputStream($framerType, $in) {
        parent::setFramerType(framerType);
        parent::setFramerBodyLength($in);
        $this->setDataFramer($in);		
    }
    
}
