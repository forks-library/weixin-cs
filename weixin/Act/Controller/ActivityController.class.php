<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtActivityApplyModel;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Util\ValidateUtil;

class ActivityController extends WeixinController {
	
	private $_mtActivityApplyModel = "";
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	protected function dbModel() {
		if (empty($this->_mtActivityApplyModel)) {
			$this->_mtActivityApplyModel = new MtActivityApplyModel();
		}
		
		return $this->_mtActivityApplyModel;
	}
	
	public function addActivityInfor() {
		$userId         = I("post.id");
		$applicantUnit  = I("post.applicantUnit");
		$contacts       = I("post.contacts");
		$phone          = I("post.phone");
		$note           = I("post.note");
		$aboutDataImg   = I("post.aboutDataImg");
 		
		$blnSucc = false;
		if (!empty($userId) && !empty($applicantUnit) && !empty($contacts) && !empty($phone) && !empty($note) && !empty($aboutDataImg)) {
			
			$blnSucc = $this->dbModel()->addActivity($userId, $applicantUnit, $contacts, $phone, $note, $aboutDataImg);
		}
		
		if ($blnSucc !== false) {
			JsonUtil::response(JsonUtil::RET_SUCC);
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);								
		}
		
	}
	
}
?>