<?php
namespace Info\Controller;
use Com\Mor\Controller\WeixinController;

class HelpdataController extends WeixinController {
	
	public function __construct() {
		$this->_pageJs = "helpdata3";
		parent::__construct();
	}
	
	public function index() {
		$this->display();
	}
	
	public function result() {
		$this->_pageJs = "helpdataresult";
		$this->_js_loader();
		$this->display();
	}
	
	public function details() {
		$this->_pageJs = "helpdatadetails";
		$this->_js_loader();
		$this->display();
	}
}
?>