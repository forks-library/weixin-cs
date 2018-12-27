<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtAmountControlModel;
use Com\Mor\Util\JsonUtil;

class AmountcontrolController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	public function amountList() {
		
		$mtAmountControlModel = new MtAmountControlModel();
		$amountList = $mtAmountControlModel->getAmountList();
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("amountList" => $amountList));
	}
	
}
?>