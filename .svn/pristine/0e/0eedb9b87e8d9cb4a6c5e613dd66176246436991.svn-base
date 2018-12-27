<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpTypeModel;
use Com\Mor\Util\JsonUtil;

class HelpdetailController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}

	public function detailData() {
		$no = I("post.no");
		$arrResult = array();
		
		if (!empty($no)) {
			$mtHelpTypeModel = new MtHelpTypeModel();
			$arrResult = $mtHelpTypeModel->getHelpDetail($no);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("data" => $arrResult));
	}
	
}
?>