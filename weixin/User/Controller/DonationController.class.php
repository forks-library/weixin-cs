<?php
namespace User\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpInformationModel;
use Com\Mor\Model\Sys\MtNewsDynamicModel;
use Com\Mor\Util\JsonUtil;

class DonationController extends WeixinController {
	
	public function __construct() {
		$this->_pageJs = "donation2";
		parent::__construct();
	}
	
	public function index() {
		$mtNewsDynamicModel = new MtNewsDynamicModel();
		$rescue = $mtNewsDynamicModel->getDonationNote();
		
		$this->assign("rescue", $rescue);
		$this->display();
	}
	
	public function detail() {
		$this->_pageJs = "donationdetail3";
		$this->_js_loader();
		$this->display();
	}
	
	public function guestbook() {
		$this->_pageJs = "guestbook";
		$this->_js_loader();
		$this->display();
	}
	
	public function guestlist() {
		$this->_pageJs = "guestlist";
		$this->_js_loader();
		$this->display();
	}
	
	public function payAction() {
		$this->_pageJs = "donationpay6";
		$this->_js_loader();
		
		$no = I("get.no");
		
		if (!empty($no)) {
			$mtHelpInformationModel = new MtHelpInformationModel();
			$title = $mtHelpInformationModel->getHelpInformationTitle($no);
			
			$this->assign("title", $title);
		}
		
		$this->display();
	}
	
	public function footPayAction() {
		$this->_pageJs = "donationfootpay14";
		$this->_js_loader();
		
		$infoNo = I("get.no");
//		
//		if (!empty($infoNo)) {
//			$mtHelpInformationModel = new MtHelpInformationModel();
//			$data = $mtHelpInformationModel->getProjectDetail($infoNo);
//			if (!empty($data)) {
//				$this->assign("data", $data);
//				$this->display();
//			}
//		}
		$this->display();
	}
	
	public function donorList() {
		$this->_pageJs = "donorlist";
		$this->_js_loader();
		$this->display();
	}
	
}
?>