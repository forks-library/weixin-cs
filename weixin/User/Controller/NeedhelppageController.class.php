<?php
namespace User\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpInformationModel;
use Com\Mor\Util\JsonUtil;

class NeedhelppageController extends WeixinController {
	
	public function __construct() {
		$this->_pageJs = "needhelppage1";
		parent::__construct();
	}
	
	public function index() {
		$mtHelpInformationModel = new MtHelpInformationModel();
		$mtHelpInformationModel->updMessageStatus(I("get.no"), $this->wxUserId);
		
		$this->display();
	}
}
?>