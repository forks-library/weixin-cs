<?php
namespace User\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpTypeModel;
use Com\Mor\Model\Sys\MtHelpShowConfModel;
use Com\Mor\Model\Sys\MtNewsDynamicModel;
use Com\Mor\Util\JsonUtil;

class VolunteerController extends WeixinController {
	
	public function __construct() {
		$this->_pageJs = "volunteer";
		parent::__construct();
	}
	
	public function index() {
		$mtNewsDynamicModel = new MtNewsDynamicModel();
		$rescue = $mtNewsDynamicModel->getPostulantNote();
		
		$this->assign("rescue", $rescue);		
		$this->display();
	}
	
	public function detail() {
		$this->_pageJs = "volunteerDetail";
		$this->_js_loader();
		$this->display();
	}
	
	public function volunteerAction() {
		$this->_pageJs = "volunteeraction";
		$this->_js_loader();
//		$mtNewsDynamicModel = new MtNewsDynamicModel();
//		$data = $mtNewsDynamicModel->getActivityNote();
//		$this->assign('data',$data);
		$this->display();
	}
}
?>