<?php
namespace User\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Weixin\WxUserResourceModel;

class MeController extends WeixinController {
	
	public function __construct() {
		$this->_pageJs = "index";
		$this->slientWxAuth = false;
		parent::__construct();
		$this->assign("menu", "mepage");
	}
	
	public function index() {
		$this->_pageJs = "me3";
		$this->_js_loader();
		
		$wxUserResourceModel = new WxUserResourceModel();
		$donationAmount = $wxUserResourceModel->getUserDonationAmount($this->wxUserId);
		
		$this->assign("donationAmount", $donationAmount);
		$this->display();
	}
	
}
?>