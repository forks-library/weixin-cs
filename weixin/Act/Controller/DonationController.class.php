<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpInformationModel;
use Com\Mor\Model\Sys\MtHelpOrderModel;
use Com\Mor\Util\JsonUtil;

class DonationController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	public function donationList() {
		$searchText = I("post.search");
		
		$mtHelpInformationModel = new MtHelpInformationModel();
		$arrMoneyTop = $mtHelpInformationModel->getAllHelpInformation("1", $searchText);
		$arrNewTop   = $mtHelpInformationModel->getAllHelpInformation("2", $searchText);
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("moneyTop" => $arrMoneyTop, "newTop" => $arrNewTop));
	}
	
	public function donationDetail() {
		$no        = I("post.no");
		$arrResult = array();
		
		if (!empty($no)) {
			$mtHelpInformationModel = new MtHelpInformationModel();
			$arrResult = $mtHelpInformationModel->getHelpInformationDetail($no);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("data" => $arrResult));
	}
	
	public function donatorList() {
		$no        = I("post.no");
		$arrResult = array();
		
		if (!empty($no)) {
			$mtHelpOrderModel = new MtHelpOrderModel();
			$arrResult = $mtHelpOrderModel->getDonatorList($no);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $arrResult));
	}
	
	public function getDonationIsYuan() {
		$no = I('post.no');
		
		$isYuan = array();
		if (!empty($no)) {
			$mtHelpInformationModel = new MtHelpInformationModel();
			$isYuan = $mtHelpInformationModel->getIsYuan($no);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("data" => $isYuan));
	}
	
}
?>