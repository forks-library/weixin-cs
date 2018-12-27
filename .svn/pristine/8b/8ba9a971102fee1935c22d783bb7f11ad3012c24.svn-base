<?php
namespace Com\Mor\Util;

class EncryptUtil {
	
	protected static function encry($md1, $md2 = "") {
		$retMd = "";
		
		if (empty($md2)) {
			$md2 = time().rand();
		}
		
		if (!empty($md1) && !empty($md2)) {
			$retMd = md5(crypt($md1, $md2));
		}
		
		return $retMd;
	}
	
	protected static function ensha($md1, $md2 = "") {
		$retMd = "";
		
		if (empty($md2)) {
			$md2 = time().rand();
		}
		
		if (!empty($md1) && !empty($md2)) {
			$retMd = sha1(crypt($md1, $md2));
		}
		
		return $retMd;
	}
	
	protected static function ensup($md1, $md2 = "") {
		$retMd = "";
		
		if (empty($md2)) {
			$md2 = time().rand();
		}
		
		if (!empty($md1) && !empty($md2)) {
			$retMd = sha1(crypt(md5($md1), md5($md2)));
		}
		
		return $retMd;
	}
	
	/**
	 * $pass      : 用户密码
	 * $userHandy : 用户手机或者用户名 
	 */
	public static function pass($pass, $userHandy) {
		return self::encry($pass, $userHandy);
	}
	
	public static function randomId($randnum) {
		return self::encry($randnum);
	}
	
	public static function randomAvId($randnum) {
		return self::ensha($randnum);
	}
	
	public static function randomSupId($randnum) {
		return self::ensup($randnum);
	}
	
	/**
	 * DES加密:
	 * $str: 需要加密的字符串；$key：密钥
	 */
	public static function desEncode($str, $key = 'bb1e9ef3') {
		$result = "";
		if (!empty($str) && !empty($key)) {
			$str = self::paddingPKCS7($str);
			$td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_ECB, '');
			$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
			mcrypt_generic_init($td, $key, $iv);
			$result = mcrypt_generic($td, $str);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
			$result = urlencode(base64_encode($result));
		}
		return $result;
	}
	
	/**
	 * DES解密:
	 * $str: 需要解密的字符串；$key：密钥
	 */
	public static function desDecode($str, $key = 'bb1e9ef3') {
		if (!empty($str) && !empty($key)) {
			$str = base64_decode(urldecode($str));
//			$str = base64_decode($str);
			$td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_ECB, '');
			$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
			mcrypt_generic_init($td, $key, $iv);
			$result = mdecrypt_generic($td, $str);
			$str = self::unPaddingPKCS7($result);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
		}
		return $str;
	}
	
	private static function paddingPKCS7($str) {
		$srcData = $str;
		if (!empty($str)) {
			$blockSize = mcrypt_get_block_size('tripledes', 'ecb');
			$paddingChar = $blockSize - (strlen($str) % $blockSize);
			$srcData .= str_repeat(chr($paddingChar), $paddingChar);
		}
		return $srcData;
	}
	
	private static function unPaddingPKCS7($str) {
		if (!empty($str)) {
			$pad = ord($str[strlen($str) - 1]);
			if ($pad > strlen($str)) {
				return false;
			}
			if (strspn($str, chr($pad), strlen($str) - $pad) != $pad) {
				return false;
			}
			$str = substr($str, 0, -1 * $pad);
		}
		return $str;
	}
	
}
?>