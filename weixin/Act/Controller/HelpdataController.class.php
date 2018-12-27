<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtSalvorModel;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Util\ValidateUtil;

class HelpdataController extends WeixinController {
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	public function dataResult() {
		$idNo   = I("post.idno");
		$result = array();
		
		if (!empty($idNo)) {
			$mtSalvorModel = new MtSalvorModel();
			$salvor = $mtSalvorModel->getResultData($idNo);
			
			if (!empty($salvor) && is_array($salvor)) {
				$result = array("salvors" => $salvor);
			}
		}
		if (!empty($result)) {
			JsonUtil::response(JsonUtil::RET_SUCC, $result);
		} else {
			JsonUtil::response(JsonUtil::RET_SUCC,array('isdata'=>'false'));
		}
		
	}
	
}
?>