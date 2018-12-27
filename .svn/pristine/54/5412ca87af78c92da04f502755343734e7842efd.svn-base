<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtBanModel;
use Com\Mor\Util\JsonUtil;

class BannerController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}

	public function getBan() {
		$ban  = array();
		$banModel = new MtBanModel();
	    $topBan   = $banModel->getBanList(1);
		$downBan  = $banModel->getBanList(2);
		
		$ban['top']  = $topBan;
		$ban['down'] = $downBan;
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $ban));
		
	}
	
}
?>