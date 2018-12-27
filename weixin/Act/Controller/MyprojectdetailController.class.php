<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpOrderModel;
use Com\Mor\Model\Sys\MtHelpInformationModel;
use Com\Mor\Model\Weixin\WxUserResourceModel;
use Com\Mor\Model\Sys\MtActivityApplyModel;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Util\ValidateUtil;

class MyprojectdetailController extends WeixinController {
	
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
	
	public function seekProjectDetail() {
		$helpNo    = I("post.helpCode");
		$arrResult = array();
		
		if (!empty($helpNo)) {
			$arrResult = $this->dbMtHelpInformationModel()->getSeekDetail($helpNo);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("data" => $arrResult));
	}
	
	public function applyActivityDetail() {
		$activityNo    = I("post.no");
		$arrResult = array();
		
		if (!empty($activityNo)) {
			$arrResult = $this->dbMtActivityApplyModel()->getActivityDetail($activityNo);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("data" => $arrResult));
	}
	
}
?>