<?php

/**
 * @desc ESNPAddressFramer
 *
 * @category  ESNPAddressFramer.class.php
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


class ESNPAddressFramer  extends ESNPBaseFramer {

    private static $_instance;

    /**
     * 
     * @return \bma\common\esp\framer\ESNPAddressFramer
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    //服务组
    const ADDRESS_GROUP = 50;
    //主机(节点)
    const ADDRESS_HOST = 40; 
    //服务
    const ADDRESS_SERVICE = 30;
    //操作
    const ADDRESS_OP = 20;
    //操作关联对象
    const ADDRESS_OBJECT = 10;

    /**
     * 地址类型
     */
    private $addressType;

    /**
     * 地址
     */
    private $address;

    public function getAddressType() {
        return addressType;
    }

    public function setAddressType($addressType) {
        $this->addressType = $addressType;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    function __construct() {
    }
    
    public function buildFrameIn($framerType,$in){
        parent::setFramerType($framerType);
        parent::setFramerBodyLengthIn($in);
        $this->setAddressFramer($in);
    }
	
    /**
     * 
    * @Title: setAddressList 
    * @Description: 从流中读取地址信息
    * @param @param in
    * @param @throws IOException    
    * @return void    
    * @throws
     */
    public function setAddressFramer($in) {
        if(parent::getFramerType() == 0 || parent::getFramerBodyLength() == 0){
                return ;
        }
        $length = parent::getFramerBodyLength();
        if($in->available() < $length){
            return ;
        }
        $addressByte = array();
        $in->read($addressByte, 0, $length);
        $addressIn = new coder\ByteArrayInputStream($addressByte);
        $intCoder = coder\impl\Int32Coder::getInstance();
        $this->setAddressType($intCoder->decode($addressIn));
        $lenStringCoder = coder\impl\LenStringCoder::getInstance();
        $this->setAddress($lenStringCoder->decode($addressIn));
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
    public function addressFramerToOutputStream($out) {
        if($this->addressByte == 0 || $this->address == null){
            return ;
        }
        $adressOut = coder\ByteArrayOutputStream::getInstance();
        $intCoder = coder\impl\Int32Coder::getInstance();
        $intCoder->encoder($adressOut, $this->getAddressType());
        $lenStringCoder = coder\impl\LenStringCoder::getInstance();
        $lenStringCoder->encoder($adressOut, $this->getAddress());
        $adressByte = $adressOut->toByteArray();
        parent::toOutputStream($out,count($adressByte));	
        $out->write($this->addressByte);
    }

    public function readInputStream($framerType, $in) {
        parent::setFramerType($framerType);
        parent::setFramerBodyLength($in);
        $this->setAddressFramer($in);
    }
}
