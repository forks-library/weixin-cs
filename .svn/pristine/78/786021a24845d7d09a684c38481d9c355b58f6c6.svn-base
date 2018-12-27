<?php
namespace Act\Controller;
use Com\Mor\Controller\WeixinController;
use Com\Mor\Model\Sys\MtHelpInformationModel;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\WebUtil;
use Com\Mor\Util\ValidateUtil;

class HelpController extends WeixinController {
	
	private $_mtHelpInformationModel = "";
	
	public function __construct() {
		$this->isNeedAuth = false;
		parent::__construct();
	}
	
	protected function dbModel() {
		if (empty($this->_mtHelpInformationModel)) {
			$this->_mtHelpInformationModel = new MtHelpInformationModel();
		}
		
		return $this->_mtHelpInformationModel;
	}
	
	public function addHelpInfor() {
		$userId          = I("post.id");
		$helpType        = I("post.type");
		$helpNm          = I("post.helpNm");
		$helpId          = I("post.helpId");
		$helpAddr        = I("post.helpAddr");
		$handy           = I("post.handy");
		$reason          = I("post.reason");
		$medicalExpense  = I("post.medicalExpense");
		$socialSecurity  = I("post.socialSecurity");
		$otherRecipients = I("post.otherRecipients");
		$statusStatement = I("post.statusStatement");
		$town            = I("post.town");
		$idcardImg       = I("post.idcardImg");
		$aboutDataImg	 = I("post.aboutDataImg");
		$blnSucc         = false;
		
		$addArr = array();
		if (!empty($userId)) {
			$addArr["userId"] = $userId;
		}
		
		if (!empty($helpType)) {
			$addArr["helpType"] = $helpType;
		}
		
		if (!empty($helpNm)) {
			$addArr["helpNm"] = $helpNm;
		}
		
		if (!empty($helpId)) {
			$addArr["helpId"] = $helpId;
		}
		
		if (!empty($helpAddr)) {
			$addArr["helpAddr"] = $helpAddr;
		}
		
		if (!empty($handy)) {
			$addArr["handy"] = $handy;
		}
		
		if (!empty($reason)) {
			$addArr["reason"] = $reason;
		}
		
		if (!empty($medicalExpense)) {
			$addArr["medicalExpense"] = $medicalExpense;
		}
		
		if (!empty($socialSecurity)) {
			$addArr["socialSecurity"] = $socialSecurity;
		}
		
		if (!empty($otherRecipients)) {
			$addArr["otherRecipients"] = $otherRecipients;
		}
		
		if (!empty($statusStatement)) {
			$addArr["statusStatement"] = $statusStatement;
		}
		
		if (!empty($town)) {
			$addArr["town"] = $town;
		}
		
		if (!empty($idcardImg)) {
			$addArr["idcardImg"] = $idcardImg;
		}
		
		if (!empty($aboutDataImg)) {
			$addArr["aboutDataImg"] = $aboutDataImg;
		}
		
		$blnSucc = $this->dbModel()->addInformation($addArr);
		
//		if (!empty($userId) && !empty($helpType) && !empty($helpNm)
//			&& !empty($helpId) && !empty($helpAddr) && !empty($handy)
//			&& !empty($reason) && !is_null($medicalExpense) && !is_null($socialSecurity)
//			&& !empty($statusStatement) && !empty($town) && !empty($idcardImg) && !empty($aboutDataImg)) {
//			$blnSucc = $this->dbModel()->addInformation($userId, $helpType, $helpNm, $helpId, $helpAddr, $handy, $reason, $medicalExpense, $socialSecurity, $otherRecipients, $statusStatement, $town, $idcardImg, $aboutDataImg);
//		}
		
		if ($blnSucc !== false) {
			JsonUtil::response(JsonUtil::RET_SUCC);
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);								
		}
	}
	
	public function updHelpInfor() {
		$infoNo          = I("post.no");
		$helpNm          = I("post.helpNm");
		$helpId          = I("post.helpId");
		$helpAddr        = I("post.helpAddr");
		$handy           = I("post.handy");
		$reason          = I("post.reason");
		$medicalExpense  = I("post.medicalExpense");
		$socialSecurity  = I("post.socialSecurity");
		$otherRecipients = I("post.otherRecipients");
		$statusStatement = I("post.statusStatement");
		$town            = I("post.town");
		$idcardImg       = I("post.idcardImg");
		$aboutDataImg	 = I("post.aboutDataImg");
		$blnSucc         = false;
		
		if (!empty($infoNo) && !empty($helpNm)
			&& !empty($helpId) && !empty($helpAddr) && !empty($handy)
			&& !empty($reason) && !empty($medicalExpense) && !empty($socialSecurity)
			&& !empty($statusStatement) && !empty($town) && !empty($idcardImg) && !empty($aboutDataImg)) {
			$blnSucc = $this->dbModel()->updInformation($infoNo, $helpNm, $helpId, $helpAddr, $handy, $reason, $medicalExpense, $socialSecurity, $otherRecipients, $statusStatement, $town, $idcardImg, $aboutDataImg);
		}
		
		if ($blnSucc !== false) {
			JsonUtil::response(JsonUtil::RET_SUCC);
		} else {
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);								
		}
	}
	
}
?>