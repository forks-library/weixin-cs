<?php
namespace Info\Controller;
use Com\Mor\Controller\WeixinController;

class PaybillController extends WeixinController {
	
	public function __construct() {
		$this->_pageJs = "paybill";
		parent::__construct();
	}
	
	public function index() {
		$this->display();
	}
	
	public function paybillList() {
		$this->_pageJs = "paybillList";
		$this->_js_loader();
		$this->display();
	}
	
	public function paybilldetails() {
		$this->_pageJs = "paybilldetails";
		$this->_js_loader();
		$this->display();
	}
}
?>