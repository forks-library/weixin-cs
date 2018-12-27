<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpInformationModel;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\ImgsynUtil;
use Com\Mor\Model\Sys\MtAmountControlModel;

class NopublicController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	public function getNoPublic() {
		$infoNo = I("post.no");
		$data   = array();
		
		if (!empty($infoNo)) {
			$mtHelpInformationModel = new MtHelpInformationModel();
			$data = $mtHelpInformationModel->getProjectDetail($infoNo);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $data));
	}	
	
	public function getAmount() {
		$mtAmountControlModel = new MtAmountControlModel();
		$amountList = $mtAmountControlModel->getAmountList();
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $amountList));
	}
}
?>