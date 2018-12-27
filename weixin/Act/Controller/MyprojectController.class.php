<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpOrderModel;
use Com\Mor\Model\Sys\MtHelpInformationModel;
use Com\Mor\Model\Sys\MtActivityApplyModel;
use Com\Mor\Model\Weixin\WxUserResourceModel;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Util\ValidateUtil;

class MyprojectController extends WeixinController {
	
	private $_mtHelpOrderModel        = "";
	private $_mtHelpInformationModel  = "";
	private $_mtActivityApplyModel    = "";
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	protected function dbMtHelpOrderModel() {
		if (empty($this->_mtHelpOrderModel)) {
			$this->_mtHelpOrderModel = new MtHelpOrderModel();
		}
		
		return $this->_mtHelpOrderModel;
	}
	
	protected function dbMtHelpInformationModel() {
		if (empty($this->_mtHelpInformationModel)) {
			$this->_mtHelpInformationModel = new MtHelpInformationModel();
		}
		
		return $this->_mtHelpInformationModel;
	}
	
	protected function dbMtActivityApplyModel() {
		if (empty($this->_mtActivityApplyModel)) {
			$this->_mtActivityApplyModel = new MtActivityApplyModel();
		}
		
		return $this->_mtActivityApplyModel;
	}
	
	public function helpProject() {
		$userId = I("post.userId");
		$arrResult = array();
		
		if (!empty($userId)) {
			$arrResult1 = $this->dbMtHelpOrderModel()->getHelpProject($userId);
			$arrResult2 = $this->dbMtHelpInformationModel()->getSeekHelpProject($userId);
			$arrResult3 = $this->dbMtActivityApplyModel()->getApplyActivity($userId);
			
			$arrResult["juan"]     =  $arrResult1;
			$arrResult["seek"]     =  $arrResult2;
			$arrResult["activity"] =  $arrResult3;
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $arrResult));
	}
	
}
?>