<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\WxVolunteerActiveModel;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Util\ValidateUtil;

class VolunteernotesController extends WeixinController {
	
	private $_mtVolunteerActiveModel = "";
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	protected function dbModel() {
		if (empty($this->_mtVolunteerActiveModel)) {
			$this->_mtVolunteerActiveModel = new WxVolunteerActiveModel();
		}
		
		return $this->_mtVolunteerActiveModel;
	}
	
	public function getVolunteerNotes() {
		$pages = I("post.page");
		$olunteerNotes = array();
	
		$olunteerNotes = $this->dbModel()->getAllVolunteerNotes($pages);
		
		if ($blnSucc !== false) {
			JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $olunteerNotes));
		}
	}
	
	public function getVolunteerNotesDetail() {
		$no = I("post.no");
		$olunteerNotes = array();
	
		$olunteerNotes = $this->dbModel()->getVolunteerNotesByCode($no);
		
		if ($blnSucc !== false) {
			JsonUtil::response(JsonUtil::RET_SUCC, array("data" => $olunteerNotes));
		}
	}
	
}
?>