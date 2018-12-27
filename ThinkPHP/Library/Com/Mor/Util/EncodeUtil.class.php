<?php
namespace Com\Mor\Util;
use Com\Mor\Util\ValidateUtil;

class EncodeUtil {
	
	public static function unicodeEncode($str) {
		$rtnStr = "";
		
		if (!empty($str)) {
			$rtnStr = json_encode($str);
			$rtnStr = str_replace("\"", "", $rtnStr);
			$rtnStr = str_replace("'",  "*", $rtnStr);
		}
		
		return $rtnStr;
	}
	
	public static function unicodeDecode($str) {
		$rtnStr = "";
		
		if (!empty($str)) {
			$rtnStr = json_decode('"'.$str.'"');
		}
		
		return $rtnStr;
	}
	
	public static function dbUnicodeEncode($str) {
		$rtnStr = "";
		
		if (!ValidateUtil::isNull($str)) {
			$rtnStr = str_replace('\\', '_', $str);
		}
		
		return $rtnStr;
	}
	
	public static function dbUnicodeDecode($str) {
		$rtnStr = "";
		
		if (!ValidateUtil::isNull($str)) {
			$rtnStr = str_replace('_', '\\', $str);
		}
		
		return $rtnStr;
	}
	
}
?>