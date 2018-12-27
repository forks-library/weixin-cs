<?php
namespace Home\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtNewsDynamicModel;

class ActivityController extends WeixinController {
	
	public function __construct() {
		$this->_pageJs = "activity2";
		parent::__construct();
	}
	
	public function index() {
		$mtNewsDynamicModel = new MtNewsDynamicModel();
		$data = $mtNewsDynamicModel->getActivityNote();
		$this->assign('data',$data);
		$this->display();
	}
}
?>