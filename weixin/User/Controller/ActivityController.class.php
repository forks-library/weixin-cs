<?php
namespace User\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtActivityApplyModel;
use Com\Mor\Util\JsonUtil;

class ActivityController extends WeixinController {
	
	public function __construct() {
		$this->_pageJs = "activity";
		parent::__construct();
	}
	
	public function index() {
		$mtActivityApplyModel = new MtActivityApplyModel();
		$mtActivityApplyModel->updMessageStatus(I("get.no"),$this->wxUserId);
		$this->display();
	}	
}
?>