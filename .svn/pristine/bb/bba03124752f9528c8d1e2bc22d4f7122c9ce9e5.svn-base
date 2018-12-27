<?php
namespace Com\Mor\Util;

class WebUtil {
	
	public static function isExist($url) {
		$bln = false;
		
		if (!empty($url) && function_exists('curl_init')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	        
	        if (defined('SERVER_RESOURCE') && defined('HTTP_PROXY')) {
	        	curl_setopt($ch, CURLOPT_PROXY, HTTP_PROXY);
	        	curl_setopt($ch, CURLOPT_PROXYUSERPWD, HTTP_PPROXY_USERPWD);
	        }
	        
			$result = curl_exec($ch);
			
			if ($result !== false) {
				$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if ($statusCode == 200) {
					$bln = true;
				}
			}
			
			curl_close($ch);
		}
		
		return $bln;
	}
	
	/**
	 * 模拟GET
	 * $url 完整的带参数URL
	 */
	public static function get($url) {
		$data = '';
		
		if (!empty($url) && function_exists('curl_init')) {
			$ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_VERBOSE, 1);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	        
	        if (defined('SERVER_RESOURCE') && defined('HTTP_PROXY')) {
	        	curl_setopt($ch, CURLOPT_PROXY, HTTP_PROXY);
	        	curl_setopt($ch, CURLOPT_PROXYUSERPWD, HTTP_PPROXY_USERPWD);
	        }
	
	        if (!curl_exec($ch)) {
	            error_log(curl_errno($ch).':'.curl_error($ch));
	            $data = '';
	        } else {
	            $data = curl_multi_getcontent($ch);
	        }
	        curl_close($ch);
		}

        return $data;
	}
	
	/**
	 * 模拟POST
	 * $url  完整的URL
	 * $data 需要提交的数据
	 */
	public static function post($url, $data, $extranet = true) {
		$rtnData = '';
		
		if (!empty($url) && !empty($data) && function_exists('curl_init')) {
			$ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
		    curl_setopt($ch, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
		    curl_setopt($ch, CURLOPT_TIMEOUT, 120); // 设置超时限制防止死循环
		    curl_setopt($ch, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
	        
	        if (defined('SERVER_RESOURCE') && defined('HTTP_PROXY') && $extranet === true) {
	        	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Expect:"));
	        	curl_setopt($ch, CURLOPT_PROXY, HTTP_PROXY);
	        	curl_setopt($ch, CURLOPT_PROXYUSERPWD, HTTP_PPROXY_USERPWD);
	        }
	
	        $rtnData = curl_exec($ch);
	        if (!$rtnData) {
	            error_log(curl_errno($ch).':'.curl_error($ch));
	        }
	        curl_close($ch);
		}

        return $rtnData;
	}
	
	/**
	 * socket post
	 */
	public static function sock_post($url, $query) {
		$data = "";
		$info = parse_url($url);
		$fp = fsockopen($info["host"], 80, $errno, $errstr, 30);
		
		if (!$fp) {
			return $data;
		}
		
		$head = "POST ".$info['path']." HTTP/1.0\r\n";
		$head .= "Host: ".$info['host']."\r\n";
		$head .= "Referer: http://".$info['host'].$info['path']."\r\n";
		$head .= "Content-type: application/x-www-form-urlencoded\r\n";
		$head .= "Content-Length: ".strlen(trim($query))."\r\n";
		$head .= "\r\n";
		$head .= trim($query);
		
		$write = fputs($fp, $head);
		
		$header = "";
		
		while ($str = trim(fgets($fp, 4096))) {
			$header .= $str;
		}
		
		while (!feof($fp)) {
			$data .= fgets($fp, 4096);
		}
		
		return $data;
	}
	
	public static function isWeixin() {
		$userAgent = $_SERVER["HTTP_USER_AGENT"];
		
		if (strpos($userAgent, "MicroMessenger") !== false && strpos($userAgent, "WindowsWechat") === false) {
			return true;
		}
		return false;
	}
	
	public static function isIOS() {
		$userAgent = $_SERVER["HTTP_USER_AGENT"];
		return strpos($userAgent, "iPhone") || strpos($userAgent, "iPad");
	}
	
	public static function isAndroid() {
		$userAgent = $_SERVER["HTTP_USER_AGENT"];
		return strpos($userAgent, "Android");
	}
	
	/**
	 * 获取微信端IP
	 */
	public static function getRealIp() {
		return get_client_ip(0, true);
	}
	
}
?>