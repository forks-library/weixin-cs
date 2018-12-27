<?php
namespace Com\Mor\Model\Sys;
use Com\Mor\Model\VersionModel;
use Com\Mor\Util\EncodeUtil;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\StringUtil;
//use Com\Mor\Util\ImgUtil;

class MtHelpShowConfModel extends VersionModel {
	
	/**
	 * 获取配置
	 */
	public function getShowConfig($no) {
		$showConfig = array();
		
		$where      = " 1 = 1 and c.help_type_code = '".$no."' ";
		
		$field   = array();
		$field[] = "c.".$this->getPk();
		$field[] = "user_name";
		$field[] = "id_card";
		$field[] = "mobile";
		$field[] = "town_street";
		$field[] = "domicile_address";
		$field[] = "id_card_pic";
		$field[] = "help_reason";
		$field[] = "display_pic";
		$field[] = "amount_paid";
		$field[] = "reimburse_amount";
		$field[] = "funds_use";
		$field[] = "raise_money";
		$field[] = "already_money";
		$field[] = "recipient_status";
		$field[] = "situation_explain";
		$field[] = "related_data";
		$field[] = "c.content";
		
		$datas = $this->where($where)->getField($field);
		
		if (!empty($datas) && is_array($datas)) {
			$data = $datas[0];
			
			$showConfig 					= array();
			$showConfig['name']				= $data["user_name"];
			$showConfig['idCard']			= $data["id_card"];
			$showConfig['phone']	        = $data["mobile"];
			$showConfig['townStreet']		= $data["town_street"];
			$showConfig['domicileAddress']	= $data["domicile_address"];
			$showConfig['idCardPic']		= $data["id_card_pic"];
			$showConfig['helpReason']		= $data["help_reason"];
			$showConfig['displayPic']		= $data["display_pic"];
			$showConfig['amountPaid']		= $data["amount_paid"];
			$showConfig['reimburseAmount']	= $data["reimburse_amount"];
			$showConfig['fundsUse']			= $data["funds_use"];
			$showConfig['raiseMoney']		= $data["raise_money"];
			$showConfig['alreadyMoney']		= $data["already_money"];
			$showConfig['recipientStatus']	= $data["recipient_status"];
			$showConfig['situationExplain'] = $data["situation_explain"];
			$showConfig['relatedData']		= $data["related_data"];
			$showConfig["content"]          = !empty($data["content"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["content"])) : "";
		}	
		
		return $showConfig;
	}
	
}
?>