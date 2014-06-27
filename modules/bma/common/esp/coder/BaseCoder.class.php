<?php

/**
 * @desc BaseCoder
 *
 * @category  BaseCoder.class.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-6-16 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\coder;

interface  BaseCoder {  
    
    public function decoder($buf);
    
    public function encoder($buf , $obj);
    
}
