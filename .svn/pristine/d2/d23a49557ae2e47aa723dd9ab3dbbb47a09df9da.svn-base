<?php
namespace Com\Mor\Util;

class ArrayUtil {
	
	public static function impoldeToStr($arr, $mark1 = "", $mark2 = "") {
		$str = "";
		
		if (!empty($arr) && is_array($arr)) {
			foreach ($arr as $k1 => $v1) {
				if (!empty($str)) {
					$str .= $mark2;
				}
				
				$str .= $k1;
				$str .= $mark1;
				
				if (is_string($v1)) {
					$str .= $v1;
				} else if (is_array($v1)) {
					$str .= self::impoldeToStr($v1, $mark1, $mark2);
				}
			}
		}
		
		return $str;
	}
	
}
?>