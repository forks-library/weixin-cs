<?php
namespace Com\Mor\Manage;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Util\EncryptUtil;

class EncryptionManage {
	
	const   NEWEST     = 1000000;
	private $_keys     = "";
	private $_secModel = "";
	
	public function __construct() {
		$this->_keys = array();
	}
	
	/**
	 * 随机密码
	 */
	public static function randomPass($length = 8) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    	$password = '';
    	for ($i = 0; $i < $length; $i++) {
    		$password .= $chars[mt_rand(0, strlen($chars) - 1)];
    	}
    	return $password;
	}
	
}
?>