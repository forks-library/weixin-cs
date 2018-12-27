<?php
namespace Com\Mor\Util;
use Com\Mor\Util\ValidateUtil;

class StringUtil {

    public static function startWith($str, $strMark) {
		$str = trim($str);
		if (!empty($str)) {
			return strpos($str, $strMark) === 0;
		}
		return false;
	}
	
	public static function endWith($str, $strMark) {
		$str = trim($str);
		if (!empty($str)) {
			$pos = strripos($str, $strMark);
			return $pos !== false && $pos == strlen($str) - strlen($strMark);
		}
		return false;
	}
	
	public static function endHas($str, $strMark) {
		$str = trim($str);
		if (!empty($str)) {
			$pos = strripos($str, $strMark);
			return $pos !== false;
		}
		return false;
	}
	
	public static function replace($str, $arrReplace = array()) {
		if (!empty($str) && !empty($arrReplace) && is_array($arrReplace) && sizeof($arrReplace) > 0) {
			for ($i = 0; $i < sizeof($arrReplace); $i++) {
				$str = str_replace("{".$i."}", $arrReplace[$i], $str);
			}
		}
		
		return $str;
	}
	
	public static function toDBDate($str) {
		$strReturn = "";
		
		if (!empty($str)) {
			if (strlen($str) == 8 && is_numeric($str)) {
				$strReturn = $str;
			} else if (strlen($str) == 10) {
				$year = substr($str, 0, 4);
				$month = substr($str, 5, 2);
				$day = substr($str, 8, 2);
				
				if (is_numeric($year) && is_numeric($month) && is_numeric($day)) {
					$strReturn = $year.$month.$day;
				}
			}
			
			if (!ValidateUtil::isDate($strReturn)) {
				$strReturn = "";
			}
		}
		
		return $strReturn;
	}
	
	public static function toWebDate($str) {
		$strReturn = "";
		
		if (!empty($str)) {
			if (strlen($str) == 8 && is_numeric($str)) {
				$year = substr($str, 0, 4);
				$month = substr($str, 4, 2);
				$day = substr($str, 6, 2);
				
				if (is_numeric($year) && is_numeric($month) && is_numeric($day)) {
					$strReturn = $year.HTML_WEB_DATE_FLAG.$month.HTML_WEB_DATE_FLAG.$day;
				}
			}
		}
		
		return $strReturn;
	}
	
	public static function toWebMoney($str) {
		if (!empty($str) && is_numeric($str)) {
			$str = number_format($str, 2, ".", ",");
		}
		
		return $str;
	}
    
    /**
	 * 获取拼接的字符串中数据
	 * $strList 以 '|' 拼接
	 * @param string	$strList 需要校验的字符串
	 * @return array	$data 返回数组
	 */
	public static function splitToArray($strList) {
		$data = array();
		
		if (!empty($strList)) {
			if (strpos($strList, "|") !== false) {
				$strList = explode("|", $strList);
				
				foreach ($strList as $key => $val) {
					if (!empty($val)) {
						$data[] = $val;
					}
				}
			} else {
				$data[] = $strList;
			}
		}
		
		return $data;
	}
	
	public static function splitUrlParamToArray($str, $mark1, $mark2 = "") {
		$data = array();
		
		if (!empty($str) && !empty($mark1)) {
//			if (strpos($str, $mark1) !== false) {
				$arrStr = explode($mark1, $str);
				
				foreach ($arrStr as $k1 => $v1) {
					if (!empty($mark2) && !empty($v1) && strpos($v1, $mark2) !== false) {
						$arrStr2 = explode($mark2, $v1);
						
						if (sizeof($arrStr2) === 2) {
							$data[$arrStr2[0]] = $arrStr2[1];
						}
					} else if (!empty($v1)) {
						$data[] = $v1;
					}
				}
//			} else {
//				$data[] = $str;
//			}
		}
		
		return $data;
	}
	
	public static function dbToHtml($str) {
		$rtnStr = "";
		
		if (!empty($str)) {
			$rtnStr = str_replace('&lt;', '<', $str);
			$rtnStr = str_replace('&gt;', '>', $rtnStr);
			$rtnStr = str_replace('&quot;', '"', $rtnStr);
			$rtnStr = str_replace('&amp;', '&', $rtnStr);
			$rtnStr = str_replace(PHP_EOL, "", $rtnStr);
		}
		
		return $rtnStr;
	}
	
}
?>