<?php
namespace Wxint\Controller;
use Think\Controller;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Weixin\WXBizMsgCrypt;
use Com\Mor\Model\Weixin\WxUserResourceModel;

class CommandController extends Controller {
	
	protected $_token = "QrVVLo6xzFRKF6fDS7gLboX6BBdBkfOf";
	protected $_EncodingAESKey = "feHWkzPLgmqlerA9cLmLWN4NVuIBf59nMVyU50g1lmS";
	
	public function __construct() {
		parent::__construct();
		header("Content-Type: text/html; charset=UTF-8");
	}
	
	public function index() {
		if (isset($_GET["echostr"])) {
			$this->validate();
		} else {
			$this->responseMsg();
		}
	}
	
	private function validate() {
		$signature = I("get.signature");
		$timestamp = I("get.timestamp");
		$nonce     = I("get.nonce");
		$echostr   = I("get.echostr");
		
		$tmpArr = array($this->_token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		
		if ($signature === $tmpStr) {
			echo $echostr;
		} else {
			echo "false";
		}
		exit();
	}
	
	private function responseMsg() {
		$postStr       = $GLOBALS["HTTP_RAW_POST_DATA"];
		$timestamp     = I("get.timestamp");
		$nonce         = I("get.nonce");
		$msg_signature = I("get.msg_signature");
		$encrypt_type  = I("get.encrypt_type");
		$resultStr     = "";
		$wxBizMsg      = "";
		
		if ($encrypt_type == 'aes') {
			$wxBizMsg   = new WXBizMsgCrypt($this->_token, $this->_EncodingAESKey, WEIXIN_APP_ID);
			$decryptMsg = "";
			$errCode    = $wxBizMsg->decryptMsg($msg_signature, $timestamp, $nonce, $postStr, $decryptMsg);
			$postStr    = $decryptMsg;
		}
		
		if (!empty($postStr)) {
			libxml_disable_entity_loader(true);
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			
			$fromUsername = $postObj->FromUserName;
			$toUsername   = $postObj->ToUserName;
			$msgType      = $postObj->MsgType;
			$event        = $postObj->Event;
			
			if ($msgType == 'event' && $event == 'LOCATION') {
				$lat = $postObj->Latitude;
				$lng = $postObj->Longitude;
				
				$wxUserResourceModel = new WxUserResourceModel();
				$wxUserResourceModel->updUserLocation($fromUsername, $lat, $lng);
			}
		}
		
		if ($encrypt_type == 'aes' && !empty($wxBizMsg) && !empty($resultStr)) {
			$encryptMsg = '';
			$errCode = $wxBizMsg->encryptMsg($resultStr, time(), $nonce, $encryptMsg);
			$resultStr = $encryptMsg;
		}
		
		echo $resultStr;
	}
	
}
?>