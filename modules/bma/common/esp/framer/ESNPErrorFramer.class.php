<?php

/**
 * @desc ESNPErrorFramer
 *
 * @category  ESNPErrorFramer.class.php
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

class ESNPErrorFramer extends ESNPBaseFramer {
	
    //错误信息
    private $errorMes;
	
    public function getErrorMes() {
        return $this->errorMes;
    }

    public function setErrorMes($errorMes) {
            $this->errorMes = $errorMes;
    }
	
    public function buildFrameIn($framerType,$in){
        parent::setFramerType($framerType);
        parent::setFramerBodyLengthIn($in);
	$this->setErrorFramerIn($in);
    }
    
    public function readInputStream($framerType, $in) {
        parent::setFramerType($framerType);
        parent::setFramerBodyLength($in);
        $this->setErrorFramerIn($in);
    }
	
    public function setErrorFramerIn($in) {
        if(parent::getFramerType() == 0 || parent::getFramerBodyLength() == 0){
                return ;
        }

        $length = parent::getFramerBodyLength();
        if($in->available() < $length){
                return ;
        }
        $stringCoder = coder\impl\StringCoder::getInstance();
        $this->setErrorMes($stringCoder->decoder($in));
    }
	
    /**
     * 
    * @Title: errorFramerToOutputStream 
    * @Description: 将错误帧写入流
    * @param @param out
    * @param @throws IOException    
    * @return void    
    * @throws
     */
    public function errorFramerToOutputStream($out) {
            if($this->errorMes == null){
                    return ;
            }

            $errorOut = new coder\ByteArrayOutputStream();
            $stringCoder = coder\impl\StringCoder::getInstance();
            $stringCoder->encoder($errorOut, $this->errorMes);

            $errorByte = $errorOut->toByteArray();
            parent::toOutputStream($out,count($errorByte));	
            $out->write($errorByte);
    }
    
    
}
