<?php
namespace Com\Mor\Util;

class VerifyUtil {
	
	/*
	 * 生成验证码
	 */
	public static function createCode($len = 6, $setSession = false) {
//		$verifyLength = RedisManage::this()->get(VERIFY_LENGTH);
		$vchar = "0,1,2,3,4,5,6,7,8,9";
		$vcharList = explode(",", $vchar);
		$verifyCode = "";
		
		if (!empty($len) && intval($len) > 0) {
			for ($i = 0; $i < $len; $i++) {
				$randNum = rand(0, 9);
				$verifyCode .= $vcharList[$randNum];
			}
			
			if ($setSession === true) {
				$_SESSION[VERIFY_CODE] = $verifyCode;
				$_SESSION[VERIFY_STARTTIME] = date("Y-m-d H:i:s", time());
			}
		} else {
//			Logger::error("验证码长度没进行配置，请重新进行配置！");
//			throw new SystemException("系统发生错误，请稍后重试！");
		}
		
		return $verifyCode;
	}
	
	public static function unsetCode() {
		unset($_SESSION[VERIFY_CODE]);
		unset($_SESSION[VERIFY_STARTTIME]);
	}
	
}
?>