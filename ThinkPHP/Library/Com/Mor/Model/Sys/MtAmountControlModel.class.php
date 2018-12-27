<?php
namespace Com\Mor\Model\Sys;
use Com\Mor\Model\VersionModel;
use Com\Mor\Model\Sys\MtHelpPicModel;
use Com\Mor\Util\EncodeUtil;
use Com\Mor\Util\JsonUtil;

class MtAmountControlModel extends VersionModel {
	
	public function getAmountList() {
		$amountList = array();
		$where      = " 1 = 1 ";
		
		$field  = array();
		$field[]= " c.".$this->getPk();
		$field[]= " c.amount ";
		
		$datas = $this->where($where)->order(" amount asc ")->getField($field);
		if (!empty($datas) && is_array($datas)) {
			foreach($datas as $key => $val) {
				$amount = array();
				$amount["amount"] = substr($val["amount"], 0, strpos($val["amount"], "."));
				
				$amountList[] = $amount;
			}
		}
		
		return $amountList;
	}
}
?>