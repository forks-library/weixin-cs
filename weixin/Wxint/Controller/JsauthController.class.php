<?php
namespace Wxint\Controller;
use Think\Controller;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Manage\WeiXinManage;
use Com\Mor\Model\Weixin\WxTokenModel;
use Com\Mor\Model\Weixin\WxTicketModel;

class JsauthController extends Controller {
	
	public function __construct() {
		parent::__construct();
		header("Content-Type: text/html; charset=UTF-8");
	}
	
	public function apiKey() {
		$targetUrl = I("post.target_url");
		
//		\Think\Log::write("target url : ".$targetUrl);
		
		if (empty($targetUrl)) {
			JsonUtil::response(JsonUtil::RET_PARAM_NOTNULL);
		}
		
		$targetUrl = base64_decode(urldecode($targetUrl));
		
//		\Think\Log::write("target url : ".$targetUrl);
		$weiXinManage = new WeiXinManage(WEIXIN_APP_ID, WEIXIN_APP_SECRET, new WxTokenModel(), new WxTicketModel());
		
		list($noncestr, $timestamp, $signature) = $weiXinManage->getJsApiSign($targetUrl);
		
//		\Think\Log::write("appId : ".WEIXIN_APP_ID);
//		\Think\Log::write("noncestr : ".$noncestr);
//		\Think\Log::write("timestamp : ".$timestamp);
//		\Think\Log::write("signature : ".$signature);
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("appId" => WEIXIN_APP_ID, "nonceStr" => $noncestr, "timestamp" => $timestamp, "signature" => $signature));
	}
	
}
?>