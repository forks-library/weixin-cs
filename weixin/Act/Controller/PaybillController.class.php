<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtNewsDynamicModel;
use Com\Mor\Util\JsonUtil;

class PaybillController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	public function payList() {
		$mtNewsDynamicModel = new MtNewsDynamicModel();
		$arrStatue = $mtNewsDynamicModel->getPayList();
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $arrStatue));
	}
	
	public function paybillPage() {
		$no     = I("post.no");
		$statue = array();
		
		if (!empty($no)) {
			$mtNewsDynamicModel = new MtNewsDynamicModel();
			$statue = $mtNewsDynamicModel->getPaybillDetail($no);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("paybill" => $statue));
	}
	
}
?>