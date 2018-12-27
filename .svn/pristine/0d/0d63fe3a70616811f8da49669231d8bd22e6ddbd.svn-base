<?php
namespace Com\Mor\Payer;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Manage\EncryptionManage;

class Wxpayvalidater {
	
	private $_applyUrl   = "https://api.mch.weixin.qq.com/pay/unifiedorder";
	private $_refundUrl  = "https://api.mch.weixin.qq.com/secapi/pay/refund";
	private $_refundChk  = "https://api.mch.weixin.qq.com/pay/refundquery";
	private $_normalRP   = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
	private $_appId      = "";
	private $_shopId     = "";
	private $_wxKey      = "";
	private $_notify_url = "";
	
	public function __construct($shopApiKey) {
		if (!empty($shopApiKey)) {
			$this->_wxKey = $shopApiKey;
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
		}
	}
	
	public function validPayOrder($wxData) {
		$blnValid = false;
		
		if (!empty($wxData) && is_array($wxData) && isset($wxData["result_code"]) && strtoupper($wxData["result_code"]) === "SUCCESS") {
			$arrCheck = $this->arrSort($wxData);
			$str      = $this->filterSign($arrCheck);
			$str     .= "&key=".$this->_wxKey;
			$sign     = strtoupper(md5($str));
			
			if ($sign === $wxData["sign"] && intval($wxData["total_fee"]) > 0) {
				$blnValid = true;
			}
		}
		
		return $blnValid;
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
	
}
?>