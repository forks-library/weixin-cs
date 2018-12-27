<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtLeaveWordModel;
use Com\Mor\Model\Sys\MtHelpInformationModel;
use Com\Mor\Model\Sys\MtHelpTypeModel;
use Com\Mor\Util\JsonUtil;

class LeavewordController extends WeixinController {
	private $_mtLeaveWordModel = "";
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	protected function dbMtLeaveWordModel() {
		if (empty($this->_mtLeaveWordModel)) {
			$this->_mtLeaveWordModel = new MtLeaveWordModel();
		}
		
		return $this->_mtLeaveWordModel;
	}
	
	//查询留言
	public function getAllLeaveWords() {
		$dataId = I("post.dataId");
		$page   = I("post.page");
		$leaveWords = array();
		
		if(!empty($dataId)) {
			$leaveWords = $this->dbMtLeaveWordModel()->getAllLeaves($dataId, $page);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $leaveWords));
	}
	
	//添加留言
	public function addLeaveWords() {
		$userId  = I("post.userId");
		$dataId  = I("post.dataId");
		$note    = I("post.note");
		$name    = I("post.name");
		$blnSucc = false;
		
		if (!empty($userId) && !empty($dataId) && !empty($note)) {
			$blnSucc = $this->dbMtLeaveWordModel()->addLeaveWord($userId, $dataId, $note, $name);
		}
		
		if ($blnSucc !== false) {
			JsonUtil::response(JsonUtil::RET_SUCC);
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);								
		}
	}
}
?>