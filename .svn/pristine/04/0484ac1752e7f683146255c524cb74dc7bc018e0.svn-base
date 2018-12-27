<?php
namespace Com\Mor\Model\Sys;
use Com\Mor\Model\VersionModel;
use Com\Mor\Model\Sys\MtHelpPicModel;
use Com\Mor\Util\EncodeUtil;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\StringUtil;
use Com\Mor\Util\ImgUtil;

class MtKingKidsModel extends VersionModel {
	
	public function getlist() {
		$Kingkids    = array();
		$where       = " 1 = 1 and c.status = 3 and c.deleted = 0";
		
		$field   = array();
		$field[] = "c.king_kids_title";
		$field[] = "c.king_kids_no";
		$field[] = "c.king_kids_note";
		$field[] = "c.release_time";
		$field[] = "c.display_pic";
			
		$datas = $this->where($where)->order("seq desc,release_time asc")->getField($field);
		
		if (!empty($datas) && is_array($datas)) {
			foreach ($datas as $k1 => $data) {
				$news = array();
				$news["code"]     = $data["king_kids_no"];
				$news["first"]    = !empty($data["display_pic"]) ? ImgUtil::imgHandy(urldecode($data["display_pic"])) : "";
				$news["title"]    = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["king_kids_title"]));
				$news["note"]     = StringUtil::dbToHtml(EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["king_kids_note"])));
				$news["time"]     = date("Y-m-d h:i:s",$data["release_time"]);
			
				$Kingkids[] = $news;
			}
		}
		
		return $Kingkids;
	}
	
	public function getone($no) {
		$Kingkids    = array();
		$where       = " 1 = 1 and c.king_kids_no = '".$no."'";
		
		$field   = array();
		$field[] = "c.king_kids_title";
		$field[] = "c.king_kids_note";
		$field[] = "c.release_time";
			
		$data = $this->where($where)->field($field)->find();
		
		if (!empty($data) && is_array($data)) {
			$Kingkids["title"]    = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["king_kids_title"]));
			$Kingkids["note"]     = StringUtil::dbToHtml(EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["king_kids_note"])));
			$Kingkids["time"]     = date("Y-m-d h:i:s",$data["release_time"]);			
		}
		
		return $Kingkids;
	}

}
?>