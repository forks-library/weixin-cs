<?php
namespace Com\Mor\Payer;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Manage\EncryptionManage;

class Wxpayer {
	
	private $_applyUrl   = "https://api.mch.weixin.qq.com/pay/unifiedorder";
	private $_refundUrl  = "https://api.mch.weixin.qq.com/secapi/pay/refund";
	private $_refundChk  = "https://api.mch.weixin.qq.com/pay/refundquery";
	private $_normalRP   = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
	private $_appId      = "";
	private $_shopId     = "";
	private $_wxKey      = "";
	private $_notify_url = "";
	
	public function __construct($appId, $shopId, $shopApiKey, $wxNotifyUrl) {
		if (!empty($appId)) {
			$this->_appId = $appId;
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
		}
		if (!empty($shopId)) {
			$this->_shopId = $shopId;
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
		}
		if (!empty($shopApiKey)) {
			$this->_wxKey = $shopApiKey;
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
		}
		if (!empty($wxNotifyUrl)) {
			$this->_notify_url = $wxNotifyUrl;
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
		}
	}
	
	public function applyPreOrder($orderNo, $amount, $userIp, $openId, $subject, $body = "") {
		$rtnStr = "";
		
		if (!empty($orderNo)
			&& !empty($amount) && is_numeric($amount) && floatval($amount) > 0
			&& !empty($userIp)
			&& !empty($openId)
			&& !empty($subject)) {
			$arrSign = array(
				'appid'             => $this->_appId
				,'mch_id'           => $this->_shopId
				,'nonce_str'        => $this->_noncestr()
				,'sign'             => ''
				,'body'             => $subject
				,'detail'           => !empty($body) ? $body : $subject
				,'out_trade_no'     => $orderNo
				,'fee_type'         => 'CNY'
				,'total_fee'        => floatval($amount) * 100
				,'spbill_create_ip' => $userIp
				,'notify_url'       => $this->_notify_url
				,'trade_type'       => 'JSAPI'
				,'openid'           => $openId
			);
			
			$arrSign = $this->arrSort($arrSign);
			$str  = $this->filterSign($arrSign);
			$str .= "&key=".$this->_wxKey;
			$sign = strtoupper(md5($str));
			$arrSign["sign"] = $sign;
			$xml  = $this->toXml($arrSign);
			\Think\Log::write("xml : ".$xml);
			if (!empty($xml)) {
				$rtnData = WebUtil::post($this->_applyUrl, $xml);
				
				if (!empty($rtnData)) {
					$rtnData = json_decode(json_encode(simplexml_load_string($rtnData, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
				}
				
				if (!empty($rtnData) && is_array($rtnData) && isset($rtnData["return_code"])) {
					if (strtoupper($rtnData["return_code"]) === "SUCCESS"
						&& $rtnData["appid"] === $this->_appId
						&& $rtnData["mch_id"] === $this->_shopId
						&& !empty($rtnData["prepay_id"])) {
						$arrSign = array(
							'appId'      => $this->_appId
							,'package'   => 'prepay_id='.$rtnData["prepay_id"].''
							,'nonceStr'  => $this->_noncestr()
							,'signType'  => 'MD5'
							,'timeStamp' => strval(time())
							,'sign'      => ''
						);
						
						$arrSign = $this->arrSort($arrSign);
						$str  = $this->filterSign($arrSign);
						$str .= "&key=".$this->_wxKey;
						$sign = strtoupper(md5($str));
						$arrSign["sign"] = $sign;
						// 页面js获取
						$rtnStr = $arrSign;
					}
				}
			}
		}
		
		return $rtnStr;
	}
	
//	public function validPayOrder($wxData) {
//		$blnValid = false;
//		
//		if (!empty($wxData) && is_array($wxData) && isset($wxData["result_code"]) && strtoupper($wxData["result_code"]) === "SUCCESS") {
//			$arrCheck = $this->arrSort($wxData);
//			$str      = $this->filterSign($arrCheck);
//			$str     .= "&key=".$this->_wxKey;
//			$sign     = strtoupper(md5($str));
//			
//			if ($sign === $wxData["sign"] && intval($wxData["total_fee"]) > 0) {
//				$blnValid = true;
//			}
//		}
//		
//		return $blnValid;
//	}
	
//	public function refundPayedOrder($data) {
//		$blnRefundSucc = false;
//		
//		if (!empty($data) && is_array($data)
//			&& isset($data["payOrderNo"]) && !empty($data["payOrderNo"])
//			&& isset($data["refundOrderNo"]) && !empty($data["refundOrderNo"])
//			&& isset($data["orderAmount"]) && !empty($data["orderAmount"]) && is_numeric($data["orderAmount"]) && floatval($data["orderAmount"]) > 0) {
//			$data["orderAmount"] = floatval($data["orderAmount"]) * 100;
//				
//			$arrSign = array(
//				'appid'             => $this->_appId
//				,'mch_id'           => $this->_shopId
//				,'nonce_str'        => $this->_noncestr()
//				,'sign'             => ''
//				,'out_trade_no'     => $data["payOrderNo"]
//				,'out_refund_no'    => $data["refundOrderNo"]
//				,'total_fee'        => $data["orderAmount"]
//				,'refund_fee'       => $data["orderAmount"]
//				,'op_user_id'       => $this->_shopId
//			);
//			
//			$arrSign = $this->arrSort($arrSign);
//			$str  = $this->filterSign($arrSign);
//			$str .= "&key=".$this->_wxKey;
//			$sign = strtoupper(md5($str));
//			$arrSign["sign"] = $sign;
//			$xml  = $this->toXml($arrSign);
//			\Think\Log::write("xml : ".$xml);
//			
//			if (!empty($xml)) {
//				$rtnData = $this->sslCurl($xml, $this->_refundUrl);
//				$rtnData = json_decode(json_encode(simplexml_load_string($rtnData, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
//				
//				if ($rtnData["result_code"] === "SUCCESS" && $rtnData["return_code"] === "SUCCESS") {
//					$blnRefundSucc = true;
//				}
//			}
//		}
//		
//		return $blnRefundSucc;
//	}
	
//	public function refundCompletePayedOrder($refundNo) {
//		$blnComplete = false;
//		
//		if (!empty($refundNo)) {
//			$arrSign = array(
//				'appid'             => $this->_appId
//				,'mch_id'           => $this->_shopId
//				,'nonce_str'        => $this->_noncestr()
//				,'sign'             => ''
//				,'out_refund_no'    => $refundNo
//			);
//			
//			$arrSign = $this->arrSort($arrSign);
//			$str  = $this->filterSign($arrSign);
//			$str .= "&key=".$this->_wxKey;
//			$sign = strtoupper(md5($str));
//			$arrSign["sign"] = $sign;
//			$xml  = $this->toXml($arrSign);
//			\Think\Log::write("xml : ".$xml);
//			
//			if (!empty($xml)) {
//				$rtnData = WebUtil::post($this->_refundChk, $xml);
//				$rtnData = json_decode(json_encode(simplexml_load_string($rtnData, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
//				
//				if ($rtnData["result_code"] === "SUCCESS" && $rtnData["return_code"] === "SUCCESS") {
//					$blnComplete = true;
//				}
//			}
//		}
//		
//		return $blnComplete;
//	}
	
//	public function normalRedpacket($openId, $totalAmount, $strWish, $ip, $actName, $remark) {
//		$blnSended = false;
//		
//		if (!empty($openId) && !empty($totalAmount) && is_numeric($totalAmount) && floatval($totalAmount) > 1
//			&& !empty($strWish) && !empty($ip) && !empty($actName) && !empty($remark)) {
//			$totalAmount = floatval($totalAmount) * 100;
//			$arrSign = array(
//				'nonce_str'        => $this->_noncestr()
//				,'sign'            => ''
//				,'mch_billno'      => $this->_shopId.date("Ymd").rand(1000000000, 9999999999)
//				,'mch_id'          => $this->_shopId
//				,'wxappid'         => $this->_appId
//				,'send_name'       => "伊爱小店"
//				,'re_openid'       => $openId
//				,'total_amount'    => $totalAmount
//				,'total_num'       => '1'
//				,'wishing'         => $strWish
//				,'client_ip'       => $ip
//				,'act_name'        => $actName
//				,'remark'          => $remark
//			);
//			
//			$arrSign = $this->arrSort($arrSign);
//			$str  = $this->filterSign($arrSign);
//			$str .= "&key=".$this->_wxKey;
//			$sign = strtoupper(md5($str));
//			$arrSign["sign"] = $sign;
//			$xml  = $this->toXml($arrSign);
//			\Think\Log::write("xml : ".$xml);
//			
//			if (!empty($xml)) {
//				$rtnData = $this->sslCurl($xml, $this->_normalRP);
//				$rtnData = json_decode(json_encode(simplexml_load_string($rtnData, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
//				var_dump($rtnData);
//				if ($rtnData["result_code"] === "SUCCESS" && $rtnData["return_code"] === "SUCCESS") {
//					$blnSended = true;
//				}
//			}
//		}
//		
//		return $blnSended;
//	}
	
	private function sslCurl($vars, $url) {
		if (!empty($vars) && !empty($url)) {
			$ch = curl_init();
			//超时时间
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			//这里设置代理，如果有的话
			if (defined('SERVER_RESOURCE') && defined('HTTP_PROXY')) {
	        	curl_setopt($ch, CURLOPT_PROXY, HTTP_PROXY);
	        	curl_setopt($ch, CURLOPT_PROXYUSERPWD, HTTP_PPROXY_USERPWD);
	        }
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			
			//第一种方法，cert 与 key 分别属于两个.pem文件
			//默认格式为PEM，可以注释
			curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
			curl_setopt($ch, CURLOPT_SSLCERT, dirname(__FILE__).'/apiclient_cert.pem');
			//默认格式为PEM，可以注释
			curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
			curl_setopt($ch, CURLOPT_SSLKEY, dirname(__FILE__).'/apiclient_key.pem');
			
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
			$data = curl_exec($ch);
			
			if ($data) {
				curl_close($ch);
				return $data;
			} else { 
				$error = curl_errno($ch);
				curl_close($ch);
				return false;
			}
		}
	}
	
	private function toXml($arrData) {
		$xml = "";
		
		if (!empty($arrData) && is_array($arrData)) {
			$xml .= "<xml>";
			foreach ($arrData as $k1 => $val) {
				if (is_numeric($val)) {
	                $xml .= "<".$k1.">".$val."</".$k1.">";
	            } else {
	                $xml .= "<".$k1."><![CDATA[".$val."]]></".$k1.">";
	            }
			}
			$xml .= "</xml>";
		}
		
		return $xml;
	}
	
	private function arrSort($arrSign) {
		if (!empty($arrSign) && is_array($arrSign)) {
			ksort($arrSign);
			reset($arrSign);
		}
		
		return $arrSign;
	}
	
	private function filterSign($arrSign, $isAll = false) {
		$str = '';
		
		if (!empty($arrSign) && is_array($arrSign)) {
			foreach ($arrSign as $k1 => $sign) {
				if ($isAll === false && ($k1 === 'sign_type' || $k1 === 'sign')) {
					continue;
				} else {
					if (empty($str)) {
						$str = $k1.'='.$sign;
					} else {
						$str = $str.'&'.$k1.'='.$sign;
					}
				}
			}
		}
		
		return $str;
	}
	
	private function _noncestr() {
		return EncryptionManage::randomPass(30);
	}
	
}
?>