<?php
namespace Com\Mor\Util;

class SessionUtil {
	
	public static function logout() {
		unset($_SESSION[R_SYS_NAME.SESSION_USER_LOGINED]);
		unset($_SESSION[R_SYS_NAME.SESSION_LOGIN_USER_ID]);
		unset($_SESSION[R_SYS_NAME.SESSION_LOGIN_USER]);
		unset($_SESSION[R_SYS_NAME.SESSION_LOGIN_USER_NAME]);
		unset($_SESSION[R_SYS_NAME.SESSION_LOGIN_USER_PWD]);
//		unset($_SESSION[R_SYS_NAME.SESSION_PASSWORD_EXPIRE]);
		unset($_SESSION[R_SYS_NAME.SESSION_LOGIN_USER_AUTH]);
		unset($_SESSION[R_SYS_NAME.SESSION_STARTTIME]);
		unset($_SESSION[R_SYS_NAME.SESSION_LOGIN_USER_COMP_CODE]);
		
		return true;
	}
	
	public static function login($data, $configs) {
		if (empty($data) || empty($configs)) {
			return false;
		}
		
		session(R_SYS_NAME.SESSION_USER_LOGINED, true);
		session(R_SYS_NAME.SESSION_LOGIN_USER_ID, $data["mt_user_id"]);
		session(R_SYS_NAME.SESSION_LOGIN_USER, $data["user_name"]);
		session(R_SYS_NAME.SESSION_LOGIN_USER_NAME, $data["nick_name"]);
		session(R_SYS_NAME.SESSION_LOGIN_USER_PWD, $data["user_pass"]);
//		session(R_SYS_NAME.SESSION_PASSWORD_EXPIRE, $data["pass_exp"]);
		session(R_SYS_NAME.SESSION_LOGIN_USER_AUTH, $configs);
		session(R_SYS_NAME.SESSION_LOGIN_USER_COMP_CODE, $data["comp_code"]);
		
		return true;
	}
	
}
?>