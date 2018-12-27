<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtNewsDynamicModel;
use Com\Mor\Model\Sys\MtHelpInformationModel;
use Com\Mor\Model\Sys\MtHelpTypeModel;
use Com\Mor\Util\JsonUtil;

class AboutusController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	public function introPage() {
		$mtNewsDynamicModel = new MtNewsDynamicModel();
		$introData = $mtNewsDynamicModel->getIntroDetail();
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("data" => $introData));
	}
	
	public function statueList() {
		$mtNewsDynamicModel = new MtNewsDynamicModel();
		$arrStatue = $mtNewsDynamicModel->getAllNews("", 1, array("3"), array("4"));
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $arrStatue));
	}
	
	public function statuePage() {
		$no     = I("post.no");
		$statue = array();
		
		if (!empty($no)) {
			$mtNewsDynamicModel = new MtNewsDynamicModel();
			$statue = $mtNewsDynamicModel->getNewsDetail($no);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("statue" => $statue));
	}
	
	public function dynamicList() {
		$mtNewsDynamicModel = new MtNewsDynamicModel();
		$arrStatue = $mtNewsDynamicModel->getAllNews("", 1, array("3"), array("1", "2"));
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $arrStatue));
	}
	
	public function dynamicPage() {
		$no     = I("post.no");
		$statue = array();
		
		if (!empty($no)) {
			$mtNewsDynamicModel = new MtNewsDynamicModel();
			$statue = $mtNewsDynamicModel->getNewsDetail($no);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("dynamic" => $statue));
	}
	
	public function newsList() {
		$mtNewsDynamicModel = new MtNewsDynamicModel();
		$arrStatue = $mtNewsDynamicModel->getAllNews("", 1, array("3"), array("1"));
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("datas" => $arrStatue));
	}
	
	public function newsPage() {
		$no     = I("post.no");
		$statue = array();
		
		if (!empty($no)) {
			$mtNewsDynamicModel = new MtNewsDynamicModel();
			$statue = $mtNewsDynamicModel->getNewsDetail($no);
		}
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("news" => $statue));
	}
	
	public function projectList() {
		$mtHelpInformationModel = new MtHelpInformationModel();
		$infos = $mtHelpInformationModel->getAllHelpInformation("1");
		
		$mtHelpTypeModel = new MtHelpTypeModel();
		$helps = $mtHelpTypeModel->getAllHelpType();
		
		JsonUtil::response(JsonUtil::RET_SUCC, array("donations" => $infos, "helps" => $helps));
	}
	
}
?>