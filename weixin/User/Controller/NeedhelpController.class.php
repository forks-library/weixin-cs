<?php
namespace User\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpTypeModel;
use Com\Mor\Model\Sys\MtHelpShowConfModel;
use Com\Mor\Model\Sys\MtNewsDynamicModel;
use Com\Mor\Util\JsonUtil;

class NeedhelpController extends WeixinController {
	
	private $_mtHelpShowConfModel = "";
	
	public function __construct() {
		$this->_pageJs = "needhelp2";
		parent::__construct();
	}
	
	public function index() {
		$mtNewsDynamicModel = new MtNewsDynamicModel();
		$rescue = $mtNewsDynamicModel->getRescueData();
		
		$this->assign("rescue", $rescue);
		$this->display();
	}
	
	public function detail() {
		$this->_pageJs = "needhelpdetail2";
		$this->_js_loader();
		$this->display();
	}
	
	public function detailMainCon() {
		$this->_pageJs = "detailmaincon2";
		$this->_js_loader();
		$this->display();
	}
	
	/**
	 * 配置数据表对象
	 */
	protected function dbModel() {
		if (empty($this->_mtHelpShowConfModel)) {
			$this->_mtHelpShowConfModel = new MtHelpShowConfModel();
		}
		
		return $this->_mtHelpShowConfModel;
	}
	
	public function helpAction() {
		$this->_pageJs = "needhelpaction7";
		$this->_js_loader();
		
		$no = I("get.no");
		$showConf = $this->dbModel()->getShowConfig($no);
		
		$this->assign("showConf", $showConf);
		$this->dgTownData();
		$this->display();
	}
	
	public function getConfig() {
		$no 	  = I("get.no");
		$showConf = $this->dbModel()->getShowConfig($no);
		
		if (!empty($showConf) && is_array($showConf)) {
			JsonUtil::response(JsonUtil::RET_SUCC, array("showConf" => $showConf));
		}
	}
	
}
?>