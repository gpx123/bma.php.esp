<?php

/**
 * @desc StringUtil
 *
 * @category  StringUtil.php
 * @package   
 * @author fangyuan <fangyuan@yy.com>
 * @version  2014-6-16 fangyuan Exp $
 * @ignore UTF-8 
 * @copyright 多玩游戏  2012 版权所有
 * @link www.duowan.com
 * 
 */

namespace bma\common\esp\util;

class StringUtil {

    static $digit = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

    static function Isdec($num) {
        if (round($num) == $num) {
            return false;
        } else {
            return true;
        }
    }

    static function decshiftr($number, $amount) {
        if (self::Isdec($number)) {
            $decimal = substr($number, (strlen($number) - round($number) + 1));
            $decimal*=pow(10, strlen($decimal) - 1);
            $Shiftr = ($number >> $amount) + (($decimal >> $amount) / pow(10, strlen($decimal)));
        } else {
            $Shiftr = $number >> $amount;
        }
        return $Shiftr;
    }

    public static function byte2Hex($data) {
        $buf = "";
        foreach ($data as $ib) {
            $buf .= self::$digit[ self::decshiftr($ib,4) & 0x0F];
            $buf .= self::$digit[$ib & 0x0F];
        }
        return $buf;
    }

}
