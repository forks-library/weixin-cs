<?php
namespace Pay\Controller;
use Think\Controller;
use Com\Mor\Model\Sys\MtHelpOrderModel;
use Com\Mor\Payer\Wxpayvalidater;
use Com\Mor\Util\WebUtil;
use Com\Mor\Manage\WeiXinManage;
use Com\Mor\Model\Weixin\WxTokenModel;
use Com\Mor\Model\Weixin\WxTicketModel;

class PayvalidController extends Controller {
	
	public function __construct() {
//		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	public function valid() {
		$wxData = "";
		$wxPost = file_get_contents('php://input');
		
		if (!empty($wxPost)) {
			$wxData = json_decode(json_encode(simplexml_load_string($wxPost, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		}
		
		if (!empty($wxData) && is_array($wxData) && isset($wxData["result_code"])
			&& strtoupper($wxData["result_code"]) === "SUCCESS") {
			$wxpayer  = new Wxpayvalidater(WEIXIN_API_KEY);
			$blnValid = $wxpayer->validPayOrder($wxData);
			
			if ($blnValid === true) {
				$mtHelpOrderModel = new MtHelpOrderModel();
				list($blnSucc, $helpTitle, $payAmount) = $mtHelpOrderModel->updDonationOrder($wxData["out_trade_no"]);
				
				if ($blnSucc !== false) {
					$tempId    = "9GfgXTW7L0RT14N0a99vnOEnDziItdCENlgfixU0JGg";
					$template  = "";
					$template .= '"first":{';
					$template .= '"value":"感谢为东莞慈善贡献您的一份爱心"';
					$template .= ',"color":"#173177"';
					$template .= '}';
					$template .= ',"DonateNum":{';
					$template .= '"value":"'.$helpTitle.'"';
					$template .= ',"color":"#173177"';
					$template .= '}';
					$template .= ',"DonateSum":{';
					$template .= '"value":"'.$payAmount.'"';
					$template .= ',"color":"#173177"';
					$template .= '}';
					$template .= ',"remark":{';
					$template .= '"value":"我们会定期公布善款执行明细，敬请关注"';
					$template .= ',"color":"#173177"';
					$template .= '}';
					
					if (!empty($template)) {
						$baseTemp  = "";
						$baseTemp .= '{';
						$baseTemp .= '"touser":"'.$blnSucc.'"';
						$baseTemp .= ',"template_id":"'.$tempId.'"';
						$baseTemp .= ',"data":{';
						$baseTemp .= $template;
						$baseTemp .= '}';
						$baseTemp .= '}';
						
						$template = $baseTemp;
						
						$weixinManage = new WeiXinManage(WEIXIN_APP_ID, WEIXIN_APP_SECRET, new WxTokenModel(), new WxTicketModel());
						$weixinManage->sendTemplate($template);
					}
					
					echo "success";
				}
			}
		}
	}
	
}
?>