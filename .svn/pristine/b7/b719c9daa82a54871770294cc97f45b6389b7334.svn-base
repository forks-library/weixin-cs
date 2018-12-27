<?php
namespace Com\Mor\Util;

/**
 * Copyright (C), 2015-2016, Lesky tech. Co., Ltd.
 * FileName: JsonUtil.class.php
 * Summary:  Json工具
 * @author   Yan Zheng
 * @Date     2016/6/5
 * @version  1.0.0
 */
class ValidateUtil {
	
	/**
	 * 校验是否日期
	 */
	public static function isDate($strDate) {
		$bln = false;
		
		if (!empty($strDate)) {
			if (strlen($strDate) === 8 && is_numeric($strDate)) {
				// 例: 20160701
				$bln = $strDate == date('Ymd', strtotime($strDate."000000"));
			} else if (strlen($strDate) === 10 && is_numeric($strDate)) {
				// 例: 2016070101
				$bln = $strDate."0000" == date('YmdHis', strtotime($strDate."0000"));
			} else if (strlen($strDate) === 12 && is_numeric($strDate)) {
				// 例: 201607010101
				$bln = $strDate."00" == date('YmdHis', strtotime($strDate."00"));
			} else if (strlen($strDate) === 14 && is_numeric($strDate)) {
				// 例: 20160701010101
				$bln = $strDate == date('YmdHis', strtotime($strDate));
			} else if (strlen($strDate) === 10) {
				// 例: 2016/07/01
				$bln = $strDate == date('Y'.HTML_WEB_DATE_FLAG.'m'.HTML_WEB_DATE_FLAG.'d', strtotime($strDate." 00:00:00"));
			}
		}
		
		return $bln;
	}
	
	public static function isEffectiveDay($strDate) {
		return self::isCorrectStartEndDate(date("YmdHis", time()), $strDate);
	}
	
	public static function isCorrectStartEndDate($startDate, $endDate) {
		$bln = false;
		
		if (!empty($startDate) && !empty($endDate)) {
			// 开始时间
			if (strlen($startDate) === 8 && is_numeric($startDate)) {
				// 例: 20160701
				$startDate = strtotime($startDate."000000");
			} else if (strlen($startDate) === 10 && is_numeric($startDate)) {
				// 例: 2016070101
				$startDate = strtotime($startDate."0000");
			} else if (strlen($startDate) === 12 && is_numeric($startDate)) {
				// 例: 201607010101
				$startDate = strtotime($startDate."00");
			} else if (strlen($startDate) === 14 && is_numeric($startDate)) {
				// 例: 20160701010101
				$startDate = strtotime($startDate);
			} else if (strlen($startDate) === 10) {
				// 例: 2016/07/01
				$startDate = strtotime($startDate." 00:00:00");
			}
			// 结束时间
			if (strlen($endDate) === 8 && is_numeric($endDate)) {
				// 例: 20160701
				$endDate = strtotime($endDate."000000");
			} else if (strlen($endDate) === 10 && is_numeric($endDate)) {
				// 例: 2016070101
				$endDate = strtotime($endDate."0000");
			} else if (strlen($endDate) === 12 && is_numeric($endDate)) {
				// 例: 201607010101
				$endDate = strtotime($endDate."00");
			} else if (strlen($endDate) === 14 && is_numeric($endDate)) {
				// 例: 20160701010101
				$endDate = strtotime($endDate);
			} else if (strlen($endDate) === 10) {
				// 例: 2016/07/01
				$endDate = strtotime($endDate." 00:00:00");
			}
			
			if ($endDate >= $startDate) {
				$bln = true;
			}
		}
		
		return $bln;
	}
	
	public static function isExcludeDay($strDate, $day) {
		$bln = false;
		
		if (!empty($strDate) && !empty($day) && is_numeric($day) && intval($day) > 0) {
			if (strlen($strDate) === 8 && is_numeric($strDate)) {
				// 例: 20160701
				$strDate = strtotime($strDate."000000");
				$starttime = date("Ymd", time());
				$starttime = strtotime($starttime."000000");
				$endtime   = $starttime + intval($day) * 24 * 3600;
			} else if (strlen($strDate) === 10 && is_numeric($strDate)) {
				// 例: 2016070101
				$strDate = strtotime($strDate."0000");
				$starttime = date("YmdH", time());
				$starttime = strtotime($starttime."0000");
				$endtime   = $starttime + intval($day) * 24 * 3600;
			} else if (strlen($strDate) === 12 && is_numeric($strDate)) {
				// 例: 201607010101
				$strDate = strtotime($strDate."00");
				$starttime = date("YmdHi", time());
				$starttime = strtotime($starttime."00");
				$endtime   = $starttime + intval($day) * 24 * 3600;
			} else if (strlen($strDate) === 10) {
				$strDate = strtotime($strDate);
				$starttime = date("Ymd", time());
				$starttime = strtotime($starttime." 00:00:00");
				$endtime   = $starttime + intval($day) * 24 * 3600;
			}
			
			if ($strDate >= $starttime && $strDate <= $endtime) {
				$bln = true;
			}
		}
		
		return $bln;
	}
	
	/**
	 * 校验是否钱
	 */
	public static function isMoney($str) {
		$bln = false;
		
		if (!empty($str)) {
			$bln = preg_match("/^[0-9]+\.{0,1}[0-9]{0,2}$/", $str);
		}
		
		return $bln;
	}
	
	/**
	 * 校验是否手机号码
	 */
	public static function isHandy($str) {
		$bln = false;
		
		if (!empty($str) && is_numeric($str) && strlen($str) === 11) {
			$bln = true;
		}
		
		return $bln;
	}
	
	public static function isDesTime($str) {
		$bln = false;
		
		if (!empty($str) && is_numeric($str) && (strlen($str) === 6 || strlen($str) === 8)) {
			$bln = true;
		}
		
		return $bln;
	}
	
	public static function isSex($str) {
		$bln = false;
		
		if (!empty($str) && is_numeric($str) && (floatval($str) == 2 || floatval($str) == 3 || floatval($str) == 1)) {
			$bln = true;
		}
		
		return $bln;
	}
	
	public static function isTrueType($str) {
		$bln = false;
		
		if (!is_null($str) && is_numeric($str) && (floatval($str) == 0 || floatval($str) == 1)) {
			$bln = true;
		}
		
		return $bln;
	}
	
	public static function isLoginType($str) {
		$bln = false;
		
		if (!empty($str) && is_numeric($str) && (floatval($str) == 1 || floatval($str) == 2 || floatval($str) == 3 || floatval($str) == 4)) {
			$bln = true;
		}
		
		return $bln;
	}
	
	public static function isSwitchType($str) {
		$bln = false;
		
		if (!empty($str) && is_numeric($str) && (floatval($str) == 1 || floatval($str) == 2)) {
			$bln = true;
		}
		
		return $bln;
	}
	
	public static function isThreeType($str) {
		$bln = false;
		
		if (!empty($str) && is_numeric($str) && (floatval($str) == 1 || floatval($str) == 2 || floatval($str) == 3)) {
			$bln = true;
		}
		
		return $bln;
	}
	
	public static function isFourType($str) {
		$bln = false;
		
		if (!empty($str) && is_numeric($str) && (floatval($str) == 1 || floatval($str) == 2 || floatval($str) == 3 || floatval($str) == 4)) {
			$bln = true;
		}
		
		return $bln;
	}
	public static function isFiveType($str) {
		$bln = false;
		
		if (!empty($str) && is_numeric($str) && (floatval($str) == 1 || floatval($str) == 2 || floatval($str) == 3 || floatval($str) == 4 || floatval($str) == 5)) {
			$bln = true;
		}
		
		return $bln;
	}
	
	public static function isIntegerNum($str) {
		$bln = false;
		
		if (self::isNull($str) === false) {
			if (is_numeric($str) && strpos($str, ".") === false && intval($str) >= 0) {
				$bln = true;
			}
		}
		
		return $bln;
	}
	public static function isZeroSwitchType($str) {
		$bln = false;
		
		if (!empty($str) && is_numeric($str) && (floatval($str) == 0 || floatval($str) == 1 || floatval($str) == 2)) {
			$bln = true;
		}
		
		return $bln;
	}
	
	/**
	 * 匹配URL
	 */
	public static function isUrl($test) {
		if (!empty($test)) {
			$rule = "/(http|https|ftp|mms):\/\/([A-Za-z0-9.|\:|\/|\-_])+$/";
	        $re = preg_match($rule, $test);
	    	return $re > 0;
		}
		
		return false;
    }
    
    /**
	 * 匹配图片URL
	 */
	public static function isPicUrl($test) {
		if (!empty($test)) {
			$rule = "/(http):\/\/([A-Za-z0-9.|\/|\-_])+(\.)(gif|jpg|jpeg|png|GIF|JPG|PNG)$/";
	        $re = preg_match($rule, $test);
	    	return $re > 0;
		}
		
		return false;
    }
    
    /**
     * 校验是否包含特殊字符
     */
    public static function isContainSpecialsWords($str) {
    	if (!empty($str)) {
    		$strTemp = self::replaceSpecialChar($str);
    		return strlen($strTemp) != strlen($str);
    	}
    	
    	return false;
    }
    
    
    public static function replaceSpecialChar($strParam) {
    	if (!empty($strParam)) { 
    		 $regex = "/\~|\`|!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\+|\||\\\|\/|\?|\<|\>|\'|\【|\】|\{|\}/";
	    	 $strParam = preg_replace($regex,"",$strParam);
       }
       
	   return $strParam;
	}
	
	
	/**
	 * 匹配email
	 */
	public static function isEmail($test) {
		if (!empty($test)) { 
			$rule = '/^[0-9A-Za-zd]+([-_.][0-9A-Za-zd]+)*@([0-9A-Za-zd]+[-.])+[A-Za-zd]{2,5}$/';
	        $re = preg_match($rule,$test);
	    	return $re > 0;
		}
		
		return true;
    }
    
    public static function isNull($str) {
		$bln = false;
		
		if (is_null($str) || trim($str) == '') {
			$bln = true;
		}
		
		return $bln;
	}
	
	public static function isUnicode($str) {
		$bln = false;
		
		if (!empty($str)) {
			$pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
			preg_match_all($pattern, $str, $matches);
			if (!empty($matches)) {
				$bln = true;
			}
		}
		
		return $bln;
	}
	
	/**
	 * 验证字符长度
	 */ 	
	public static function isLength($str, $max, $min) {
		$bln = false;
		
		if (!empty($str) && !empty($max) && is_numeric($max) && !empty($min) && is_numeric($min)){
			if (mb_strlen($str, "utf8") > $max || mb_strlen($str, "utf8") < $min) {
				$bln = false;
			} else {
				$bln = true;
			}	
		}
		
		return $bln;
	}
	
	/**
	 * 检查状态
	 */
	protected function isNineType($str) {
		$bln = false;
		
		if (!empty($str) && is_numeric($str) && (floatval($str) == 1 || floatval($str) == 2 || floatval($str) == 3 || floatval($str) == 4 || floatval($str) == 5 || floatval($str) == 6 || floatval($str) == 7 || floatval($str) == 8 || floatval($str) == 9)) {
			$bln = true;
		}
		
		return $bln;
	}
	
}
?>