<?php

/**
 * @desc VarCoder
 *
 * @category  VarCoder.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-6-30 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\coder\impl;

use \bma\common\esp\coder as coder;

use bma\common\esp\po\VarTypeCommon as VarTypeCommon;

class VarCoder implements coder\BaseCoder {

    private static $_instance;

    function __construct() {
        
    }

    /**
     * 
     * @return \bma\common\esp\coder\impl\VarCoder
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function decoderByType($buf,$type) {
        if ($buf instanceof coder\ByteArrayInputStream) {
            switch ($type) {
                case VarTypeCommon::TYPE_BOOLEAN:
                    $coder = coder\impl\BooleanCoder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_INT16:
                    $coder = coder\impl\Int16Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_INT32:
                    $coder = coder\impl\Int32Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_INT64:
                    $coder = coder\impl\Int64Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_UINT16:
                    $coder = coder\impl\Uint16Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_UINT32:
                    $coder = coder\impl\Uint32Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_UINT64:
                    $coder = coder\impl\Uint64Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_LEN_STRING:
                    $coder = coder\impl\LenStringCoder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_LIST:
                    $coder = coder\impl\ListCoder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_MAP:
                    $coder = coder\impl\MapCoder::getInstance();
                    return $coder->decoder($buf);
            }
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

    public function decoder($buf) {
        if ($buf instanceof coder\ByteArrayInputStream) {
            $type = $buf->read();
            switch ($type) {
                case VarTypeCommon::TYPE_BOOLEAN:
                    $coder = coder\impl\BooleanCoder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_INT16:
                    $coder = coder\impl\Int16Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_INT32:
                    $coder = coder\impl\Int32Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_INT64:
                    $coder = coder\impl\Int64Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_UINT16:
                    $coder = coder\impl\Uint16Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_UINT32:
                    $coder = coder\impl\Uint32Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_UINT64:
                    $coder = coder\impl\Uint64Coder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_LEN_STRING:
                    $coder = coder\impl\LenStringCoder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_LIST:
                    $coder = coder\impl\ListCoder::getInstance();
                    return $coder->decoder($buf);
                case VarTypeCommon::TYPE_MAP:
                    $coder = coder\impl\MapCoder::getInstance();
                    return $coder->decoder($buf);
            }
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }
    
    public function encoderByType($buf,$obj,$type){
        if ($buf instanceof coder\ByteArrayOutputStream) {
            $buf->write($type);
            switch ($type) {
                case VarTypeCommon::TYPE_BOOLEAN:
                    $coder = coder\impl\BooleanCoder::getInstance();
                    $coder->encoder($buf, $obj);   
                    return ;
                case VarTypeCommon::TYPE_INT16:
                    $coder = coder\impl\Int16Coder::getInstance();
                    $coder->encoder($buf, $obj);   
                    return ;
                case VarTypeCommon::TYPE_INT32:
                    $coder = coder\impl\Int32Coder::getInstance();
                    $coder->encoder($buf, $obj);   
                    return ;
                case VarTypeCommon::TYPE_INT64:
                    $coder = coder\impl\Int64Coder::getInstance();
                    $coder->encoder($buf, $obj);   
                    return ;
                case VarTypeCommon::TYPE_UINT16:
                    $coder = coder\impl\Uint16Coder::getInstance();
                    $coder->encoder($buf, $obj);   
                    return ;
                case VarTypeCommon::TYPE_UINT32:
                    $coder = coder\impl\Uint32Coder::getInstance();
                    $coder->encoder($buf, $obj);   
                    return ;
                case VarTypeCommon::TYPE_UINT64:
                    $coder = coder\impl\Uint64Coder::getInstance();
                    $coder->encoder($buf, $obj);   
                    return ;
                case VarTypeCommon::TYPE_LEN_STRING:
                    $coder = coder\impl\LenStringCoder::getInstance();
                    $coder->encoder($buf, $obj);   
                    return ;
                case VarTypeCommon::TYPE_LIST:
                    $coder = coder\impl\ListCoder::getInstance();
                    $coder->encoder($buf, $obj);   
                    return ;
                case VarTypeCommon::TYPE_MAP:
                    $coder = coder\impl\MapCoder::getInstance();
                    $coder->encoder($buf, $obj);   
                    return ;
                default :
                    throw new \Exception('not support type');
            }         
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

    public function encoder($buf, $obj) {
        if ($buf instanceof coder\ByteArrayOutputStream) {
            if ($obj instanceof coder\type\Boolean) {
                $buf->write(VarTypeCommon::TYPE_BOOLEAN);
                $coder = coder\impl\BooleanCoder::getInstance();
                $coder->encoder($buf, $obj->getvalue());
                return ;
            } else if ($obj instanceof coder\type\Int16) {
                $buf->write(\VarTypeCommon::TYPE_INT16);
                $coder = coder\impl\Int16Coder::getInstance();
                $coder->encoder($buf, $obj->getvalue());
                return ;
            }else if ($obj instanceof coder\type\Int32) {
                $buf->write(\VarTypeCommon::TYPE_INT32);
                $coder = coder\impl\Int32Coder::getInstance();
                $coder->encoder($buf, $obj->getvalue());
                return ;
            }else if ($obj instanceof coder\type\Int64) {
                $buf->write(\VarTypeCommon::TYPE_INT64);
                $coder = coder\impl\Int64Coder::getInstance();
                $coder->encoder($buf, $obj->getvalue());
                return ;
            }else if ($obj instanceof coder\type\LenString) {
                $buf->write(\VarTypeCommon::TYPE_LEN_STRING);
                $coder = coder\impl\LenStringCoder::getInstance();
                $coder->encoder($buf, $obj->getvalue());
                return ;
            }else if ($obj instanceof coder\type\ListType) {
                $buf->write(\VarTypeCommon::TYPE_LIST);
                $coder = coder\impl\ListCoder::getInstance();
                $coder->encoder($buf, $obj->getvalue());
                return ;
            }else if ($obj instanceof coder\type\Map) {
                $buf->write(\VarTypeCommon::TYPE_MAP);
                $coder = coder\impl\MapCoder::getInstance();
                $coder->encoder($buf, $obj->getvalue());
                return ;
            }else if ($obj instanceof coder\type\Uint16) {
                $buf->write(\VarTypeCommon::TYPE_UINT16);
                $coder = coder\impl\Uint16Coder::getInstance();
                $coder->encoder($buf, $obj->getvalue());
                return ;
            }else if ($obj instanceof coder\type\Uint32) {
                $buf->write(\VarTypeCommon::TYPE_UINT32);
                $coder = coder\impl\Uint32Coder::getInstance();
                $coder->encoder($buf, $obj->getvalue());
                return ;
            }else if ($obj instanceof coder\type\Uint64) {
                $buf->write(\VarTypeCommon::TYPE_UINT64);
                $coder = coder\impl\Uint64Coder::getInstance();
                $coder->encoder($buf, $obj->getvalue());
                return ;
            }else{
                throw new \Exception('not support type');
            }
        }
        throw new \Exception('not coder\ByteArrayInputStream type');
    }

}
