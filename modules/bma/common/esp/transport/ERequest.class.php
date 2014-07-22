<?php

/**
 * @desc ERequest
 *
 * @category  ERequest.class
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-7-22 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\transport;

use bma\common\esp\framer as framer;

class ERequest {

    private static $_instance;

    /**
     * 
     * @return \bma\common\esp\transport\ERequest
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct() {
        $this->addressList = array();
        $this->dataList = array();
    }
    
	
    /**
     * 消息ID
     */
    private $mesNo;

    /**
     * 消息类型
     */
    private $mesType;

    /**
     * 地址
     */
    private $addressList;

    /**
     * 数据
     */
    private $dataList;
    
    public function addAddressFramer($af){
            $this->addressList[] = $af;
    }

    public function addDataFramer($df){
            $this->dataList[] = $df;
    }
	
    /**
     * 
    * @Title: getData 
    * @Description: 获取请求参数集
    * @param @return    
    * @return Map<String,Object>    
    * @throws
     */
    public function getDataMap(){
        $dataMap = array();
        foreach ($this->dataList as $df) {
            $dataMap[$df->getDataName()] = $df->getData();
        }
        return $dataMap;
    }

    public function getAddressMap(){
        $addressMap = array();
        foreach ($this->addressList as $af) {
            $addressMap[$af->getAddressType()] = $af->getAddress();
        }
        return $addressMap;
    }

    public function getMesNo() {
        return $this->mesNo;
    }

    public function setMesNo($mesNo) {
        $this->mesNo = $mesNo;
    }

    public function getMesType() {
        return $this->mesType;
    }

    public function setMesType($mesType) {
        $this->mesType = $mesType;
    }

    public function getAddressList() {
        return $this->addressList;
    }

    public function setAddressList($addressList) {
            $this->addressList = $addressList;
    }

    public function getDataList() {
        return $this->dataList;
    }

    public function setDataList($dataList) {
        $this->dataList = $dataList;
    }

}
