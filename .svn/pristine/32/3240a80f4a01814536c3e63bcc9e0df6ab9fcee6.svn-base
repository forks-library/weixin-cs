<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtKingKidsModel;
use Com\Mor\Util\JsonUtil;

class KingkidsController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}

	public function listData() {
		$arrResult = array();
			
		$mtKingKidsModel = new MtKingKidsModel();
		$arrResult = $mtKingKidsModel->getlist();
		
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $arrResult));
	}

	public function detailData() {
		$no = I("post.no");
		$arrResult = array();
		
		if (!empty($no)) {
			$mtKingKidsModel = new MtKingKidsModel();
			$arrResult = $mtKingKidsModel->getone($no);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("dynamic" => $arrResult));
	}
	
}
?>