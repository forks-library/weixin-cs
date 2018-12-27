<?php
namespace Share\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpOrderModel;

class FootshareController extends WeixinController {
	
	public function __construct() {
		$this->_pageJs = "index";
//		$this->slientWxAuth = false;
		parent::__construct();
		$this->assign("menu", "mepage");
	}
	
	public function index() {
		$no = I("get.no");
		
		$mtHelpOrderModel = new MtHelpOrderModel();
		$amount = $mtHelpOrderModel->getHelpDonation($no, $this->wxUserId);
		
		$this->assign("amount", $amount);
		$this->display();
		
	}
}
?>