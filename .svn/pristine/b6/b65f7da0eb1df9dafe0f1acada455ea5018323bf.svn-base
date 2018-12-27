<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtAmountControlModel;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\ImgsynUtil;

class ImgController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	public function index() {
		$amount = I("get.amount");
		ImgsynUtil::synthesisImg($amount, "Public/images/WechatIMG352.jpeg");
	}
	
}
?>