<?php
namespace Com\Mor\Model\Sys;
use Com\Mor\Model\VersionModel;
use Com\Mor\Util\EncodeUtil;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\StringUtil;
use Com\Mor\Util\ImgUtil;

class MtHelpTypeModel extends VersionModel {
	
	public function getAllHelpType($searchText = "", $page = 1) {
		$helpTypes = array();
		
		$where = " ifnull(c.end_time, ".strtotime(date("Y-m-d")).") >= ".strtotime(date("Y-m-d"))." and c.status = '2'";
		
		$field   = array();
		$field[] = "c.help_type_code";
		$field[] = "c.help_title";
		$field[] = "ifnull(c.help_condition, '') as help_condition";
		$field[] = "ifnull(c.help_scope, '') as help_scope";//适用范围
		$field[] = "ifnull(c.display_pic, '') as display_pic";
		$field[] = "ifnull(c.help_explain, '') as help_explain";
		
//		if (!empty($searchText)) {
//			$name   = $this->fetchUnicodeSql(EncodeUtil::dbUnicodeEncode(EncodeUtil::unicodeEncode($searchText)));
//			$where .= " and c.help_title ='".$name."' ";
//		}
		
		$total     = $this->countAll($where);
		$totalPage = $this->countPage($total);
		
		$this->setLimit($page);
		$datas = $this->where($where)->order("c.seq desc")->getField($field);
		
		if (!empty($datas) && is_array($datas)) {
			foreach ($datas as $k1 => $data) {
				$helpType = array();
				$helpType["code"]      = $data["help_type_code"];
				$helpType["title"]     = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_title"]));
				$helpType["condition"] = !empty($data["help_condition"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_condition"])) : "-";
				$helpType["helpScope"] = !empty($data["help_scope"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_scope"])) : "-";
				$helpType["detail"]    = !empty($data["help_explain"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_explain"])) : "";
				$helpType["displayPic"]= !empty($data["display_pic"]) ? ImgUtil::imgHandy(urldecode($data["display_pic"]), "320") : "";
				
				if (!empty($helpType["displayPic"])) {
					$helpTypes[] = $helpType;
				}
			}
		}
		
		return $helpTypes;
	}
	
	public function getHelpTypeDetail($id) {
		$helpType = array();
		
		if (!empty($id)) {
			$where   = " c.help_type_code = '".$id."' ";
			
			$field   = array();
			$field[] = "c.help_type_code";
			$field[] = "c.help_title";
			$field[] = "ifnull(c.help_condition, '') as help_condition";
			$field[] = "ifnull(c.end_time, '') as end_time";
			$field[] = "ifnull(c.start_time, '') as start_time";
			$field[] = "ifnull(c.help_detail, '') as help_detail";
			$field[] = "ifnull(c.display_pic, '') as display_pic";
			
			$data = $this->where($where)->field($field)->find();
			
			if (!empty($data) && is_array($data)) {
				$helpType["code"]      = $data["help_type_code"];
				$helpType["title"]     = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_title"]));
				$helpType["condition"] = !empty($data["help_condition"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_condition"])) : "-";
				$helpType["endTime"]   = !empty($data["end_time"]) ? date('Y-m-d', $data["end_time"]) : "";
				$helpType["startTime"] = !empty($data["start_time"]) ? date('Y-m-d', $data["start_time"]) : "";
				$helpType["detail"]    = !empty($data["help_detail"]) ? StringUtil::dbToHtml(EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_detail"]))) : "";
				$helpType["displayPic"]= !empty($data["display_pic"]) ? urldecode($data["display_pic"]) : "";
				
				if (!empty($data["end_time"])) {
					if (strtotime(date("Y-m-d", $data["end_time"])) < strtotime(date("Y-m-d"))) {
						$helpType["useStatus"] = "0";
					} else {
						$helpType["useStatus"] = "1";
					}
				} else {
					$helpType["useStatus"] = "1";
				}
			}
		}
		
		return $helpType;
	}

	public function getHelpDetail($id) {
		$helpType = array();
		
		if (!empty($id)) {
			$where   = " c.help_type_code = '".$id."' ";
			
			$field   = array();
//			$field[] = "c.help_type_code";
			$field[] = "c.help_title";
//			$field[] = "ifnull(c.help_condition, '') as help_condition";
//			$field[] = "ifnull(c.end_time, '') as end_time";
//			$field[] = "ifnull(c.start_time, '') as start_time";
//			$field[] = "ifnull(c.help_detail, '') as help_detail";
//			$field[] = "ifnull(c.display_pic, '') as display_pic";
			$field[] = "ifnull(c.help_summary, '') as help_summary";
			
			$data = $this->where($where)->field($field)->find();
			
			if (!empty($data) && is_array($data)) {
//				$helpType["code"]      = $data["help_type_code"];
				$helpType["title"]     = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_title"]));
//				$helpType["condition"] = !empty($data["help_condition"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_condition"])) : "-";
//				$helpType["endTime"]   = !empty($data["end_time"]) ? date('Y-m-d', $data["end_time"]) : "";
//				$helpType["startTime"] = !empty($data["start_time"]) ? date('Y-m-d', $data["start_time"]) : "";
//				$helpType["displayPic"]= !empty($data["display_pic"]) ? urldecode($data["display_pic"]) : "";
//				$helpType["detail"]    = !empty($data["help_detail"]) ? StringUtil::dbToHtml(EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_detail"]))) : "";
				$helpType["summary"]   = !empty($data["help_summary"]) ? htmlspecialchars_decode($data["help_summary"]) : "";
				
//				if (!empty($data["end_time"])) {
//					if (strtotime(date("Y-m-d", $data["end_time"])) < strtotime(date("Y-m-d"))) {
//						$helpType["useStatus"] = "0";
//					} else {
//						$helpType["useStatus"] = "1";
//					}
//				} else {
//					$helpType["useStatus"] = "1";
//				}
			}
		}
		
		return $helpType;
	}

	public function getTopHelpType() {
		$topHelpType = array();
		
		$where = " c.is_top = '1' ";
		
		$field   = array();
		$field[] = "c.help_type_code";
		$field[] = "c.help_title";
		
		$data = $this->where($where)->field($field)->find();
		
		if (!empty($data) && is_array($data)) {
			$topHelpType["code"]  = $data["help_type_code"];
			$topHelpType["title"] = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["help_title"]));
		}
		
		return $topHelpType;
	}
	
}
?>