<?php
namespace Com\Mor\Model\Sys;
use Com\Mor\Model\VersionModel;
use Com\Mor\Model\Sys\MtHelpPicModel;
use Com\Mor\Util\EncodeUtil;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\StringUtil;

class WxVolunteerActiveModel extends VersionModel {
	
	public function getAllVolunteerNotes($page = 1) {
		$volunteerNotes = array();
		$where          = " 1 = 1 and c.status = 2 ";
		
		$field   = array();
		$field[] = "c.".$this->getPk();
		$field[] = "c.volunteer_active_no";
		$field[] = "c.display_pic";
		$field[] = "c.title";
		$field[] = "c.summary";
		
		$total     = $this->countAll($where);
		$totalPage = $this->countPage($total);
		
		$this->setLimit($page);
		$datas = $this->where($where)->order($this->getPk()." asc")->getField($field);
		
		if (!empty($datas) && is_array($datas)) {
			foreach ($datas as $k1 => $data) {
				$news = array();
				$news["code"]       = $data["volunteer_active_no"];
				$news["displayPic"] = urldecode($data["display_pic"]);
				$news["title"]      = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["title"]));
				$news["summary"]    = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["summary"]));
				
				$volunteerNotes[] = $news;
			}
		}
		
		return $volunteerNotes;
	}
	
	public function getVolunteerNotesByCode($id) {
		$news = array();
	
		if (!empty($id)) {
			$where   = " c.volunteer_active_no= '".$id."' ";
			
			$field   = array();
			$field[] = "c.".$this->getPk();
			$field[] = "c.volunteer_active_no";
			$field[] = "c.title";
			$field[] = "c.note";

			$data = $this->where($where)->field($field)->find();
			
			if (!empty($data) && is_array($data)) {
				$news["code"]  = $data["volunteer_active_no"];
				$news["title"] = !empty($data["title"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["title"])) : "";
				$news["note"]  = !empty($data["note"]) ? StringUtil::dbToHtml(EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["note"]))) : "";
			}
		
			return $news;
		}
	}	
	
}
?>