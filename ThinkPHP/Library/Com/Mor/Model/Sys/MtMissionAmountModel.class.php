<?php
namespace Com\Mor\Model\Sys;
use Com\Mor\Model\VersionModel;

class MtMissionAmountModel extends VersionModel {
	
	public function getTotalAmount() {
		$tAmount = array();
		
		$where = " c.".$this->getPk()." = '1' ";
		
		$field = array();
		$field[] = "ifnull(c.total_fundraising, 0) as total_fundraising";
		$field[] = "ifnull(c.expenditure, 0) as expenditure";
		
		$data = $this->where($where)->field($field)->find();
		
		if (!empty($data) && is_array($data)) {
			$tAmount["tAmount"] = sprintf("%.2f", $data["total_fundraising"]);
			$tAmount["eAmount"] = sprintf("%.2f", $data["expenditure"]);
			$tAmount["lAmount"] = sprintf("%.2f", $tAmount["tAmount"] - $tAmount["eAmount"]);
		}
		
		return $tAmount;
	}
	
	public function updTotalMoney($alreadyMoney) {
		$blnSucc = false;
		
		if (!empty($alreadyMoney) && is_numeric($alreadyMoney)) {
			$where = " c.".$this->getPk()." = '1' ";
			
			$field  = array();
			$field[]= "c.".$this->getPk();
			$field[]= "ifnull(c.total_fundraising, 0) as total_fundraising";
			
			$data = $this->where($where)->field($field)->find();
			
			if (!empty($data) && is_array($data)) {
				$id = $data[$this->getPk()];
				$am = floatval(sprintf("%.2f", $data["total_fundraising"]));
				
				$data = array();
				$data["total_fundraising"] = $am + floatval(sprintf("%.2f", $alreadyMoney));
				
				$this->where($this->getPk()." = '".$id."'")->field($this->getPk())->lock(true)->find();
				$r1 = $this->where($this->getPk()." = '".$id."'")->save($data);
				
				if ($r1 !== false) {
					$blnSucc = true;
				}
			}
		}
		
		return $blnSucc;
	}
	
}
?>