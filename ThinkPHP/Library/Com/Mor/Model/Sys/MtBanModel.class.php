<?php
namespace Com\Mor\Model\Sys;
use Com\Mor\Model\VersionModel;
use Com\Mor\Model\Sys\MtYhtPicModel;
use Com\Mor\Util\EncodeUtil;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\ImgUtil;

class MtBanModel extends VersionModel {
	
	public function getBanList($type) {
    	$bans       = array();
		$where      = " 1 = 1 and type = '".$type."'";
		
		$field   = array();
		$field[] = "c.".$this->getPk();
		$field[] = "c.ban_name";
		$field[] = "c.type";
		$field[] = " ifnull(c.display_pic, '') as display_pic";
		
		$datas = $this->where($where)->order(" ban_name asc ")->getField($field);
		
		if (!empty($datas) && is_array($datas)) {
			foreach ($datas as $k1 => $data) {
				$ban = array();
				$ban["id"]            = $data[$this->getPk()];
				$ban["type"]          = $data["type"];
				$ban["name"]          = !empty($data["ban_name"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["ban_name"])) : "-";
				$ban["display_pic"]   = ImgUtil::imgHandy(urldecode($data["display_pic"]));
				
				$bans[] = $ban;
			}
		}
		
		return $bans;
	}
	
}
?>