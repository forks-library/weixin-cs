<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\WxVolunteerApplyModel;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Util\ValidateUtil;

class VolunteerController extends WeixinController {
	
	private $_mtVolunteerApplyModel = "";
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	protected function dbModel() {
		if (empty($this->_mtVolunteerApplyModel)) {
			$this->_mtVolunteerApplyModel = new WxVolunteerApplyModel();
		}
		
		return $this->_mtVolunteerApplyModel;
	}
	
	public function addVolunteerInfor() {
		$userId         = I("post.userId");
		$no		        = I("post.no");
		$applicantUnit  = I("post.applicantUnit");
		$contacts       = I("post.contacts");
		$phone          = I("post.phone");
		$note           = I("post.note");
		$aboutDataImg   = I("post.aboutDataImg");
 		
		$blnSucc = false;
		if (!empty($userId) && !empty($applicantUnit) && !empty($contacts) && !empty($phone) && !empty($note) && !empty($aboutDataImg)) {
			
			$blnSucc = $this->dbModel()->addVolunteer($userId, $no, $applicantUnit, $contacts, $phone, $note, $aboutDataImg);
		}
		
		if ($blnSucc !== false) {
			JsonUtil::response(JsonUtil::RET_SUCC);
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);								
		}
		
	}
	
}
?>