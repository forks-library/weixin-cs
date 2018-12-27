<?php
namespace Com\Mor\Model\Sys;
use Com\Mor\Model\VersionModel;
use Com\Mor\Util\EncodeUtil;
use Com\Mor\Util\JsonUtil;

class MtSalvorModel extends VersionModel {
	
	public function getResultData($idNo) {
		$salvor = array();
		$saldata= array();
		
		if (!empty($idNo)) {
			$where = " c.id_card = '".$idNo."' ";
			
			$field = array();
			$field[] = "msd.help_money";
			$field[] = "msd.relief_time";
			$field[] = "ifnull(msd.project, '') as project";
			
			$join = " inner join mt_salvor_detail msd on msd.salvor_no = c.salvor_no ";
			
			$datas = $this->where($where)->join($join)->getField($field);
			
			if (!empty($datas) && is_array($datas)) {
				foreach ($datas as $k1 => $data) {
					$sal = array();
					$sal["helpMoney"] = $data["help_money"];
					$sal["reliefTime"]= date("Y/m/d", $data["relief_time"]);
					$sal["project"]   = !empty($data["project"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["project"])) : "-";
					
					$saldata[] = $sal;
				}
			}
			
			$field = array();
			$field[] = "c.name";
			$field[] = "ifnull(c.salvage_reason, '') as salvage_reason";
			
			$data = $this->where($where)->field($field)->find();
			
			if (!empty($data) && is_array($data)) {
				$salvor["name"] = !empty($data["name"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["name"])) : "-";
				$salvor["reason"] = !empty($data["salvage_reason"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["salvage_reason"])) : "-";
			}
			
			if (!empty($saldata)) {
				$salvor["datas"] = $saldata;
			}
		}
		
		return $salvor;
	}
	
}
?>