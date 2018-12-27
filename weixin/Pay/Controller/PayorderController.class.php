<?php
namespace Pay\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpOrderModel;
use Com\Mor\Payer\Wxpayer;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Util\ValidateUtil;

class PayorderController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	public function payoffDonation() {
		$userId     = I("post.id");
		$infoNo     = I("post.no");
		$donation   = I("post.donation");
		$donateComp = I("post.comp");
		$contactNm  = I("post.name");
		$contactHd  = I("post.handy");
		$userIp     = WebUtil::getRealIp();
		
		if (ValidateUtil::isNull($userId) || ValidateUtil::isNull($infoNo) || ValidateUtil::isNull($userIp)
			|| ValidateUtil::isNull($donation) || !ValidateUtil::isMoney($donation)) {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
		}
		
		$donation = floatval(sprintf("%.2f", $donation));
		
		if (!empty($userId) && !empty($infoNo) && !empty($userIp) && !empty($donation) && is_numeric($donation) && floatval($donation) > 0) {
			$subject = WX_PAY_SUBJECT;
			
			$order = array();
			$order["userId"]    = $userId;
			$order["helpCode"]  = $infoNo;
			$order["payAmount"] = $donation;
			$order["company"]   = $donateComp;
			$order["helpNm"]    = $contactNm;
			$order["handy"]     = $contactHd;
			
			$mtHelpOrderModel = new MtHelpOrderModel();
			$orderNo = $mtHelpOrderModel->createDoantionOrder($order);
			
			if (empty($orderNo)) {
				JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
			}
			
			$payOrderNo = $mtHelpOrderModel->createDonationPayOrder($orderNo);
			
			if (empty($payOrderNo)) {
				JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
			}
			
			// 请求微信支付
			$wxpayer  = new Wxpayer(WEIXIN_APP_ID, WEIXIN_SHOP_ID, WEIXIN_API_KEY, WEIXIN_NOTIFY_URL);
			$signCode = $wxpayer->applyPreOrder($payOrderNo, $order["payAmount"], $userIp, $userId, $subject);
			
			if (empty($signCode)) {
				JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
			}
			
			JsonUtil::response(JsonUtil::RET_SUCC, array("signCode" => $signCode));
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
		}
	}
	
}
?>