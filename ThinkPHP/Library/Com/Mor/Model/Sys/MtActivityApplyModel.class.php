<?php
namespace Com\Mor\Model\Sys;
use Com\Mor\Model\VersionModel;
use Com\Mor\Util\EncodeUtil;
use Com\Mor\Util\JsonUtil;
use Com\Mor\Util\ImgUtil;
use Com\Mor\Model\Sys\MtHelpPicModel;
use Com\Mor\Model\Weixin\WxUserResourceModel;

class MtActivityApplyModel extends VersionModel {
	
	public function addActivity($userId, $applicantUnit, $contacts, $phone, $note, $aboutDataImg) {
		$blnSucc  = false;
		$version  = "";
		$picModel = new MtHelpPicModel();
		
		$dbData = array();
		$dbData["user_wx_id"]       = $userId;
		$dbData["applicant_unit"]   = EncodeUtil::dbUnicodeEncode(EncodeUtil::unicodeEncode($applicantUnit));
		$dbData["contacts"]         = EncodeUtil::dbUnicodeEncode(EncodeUtil::unicodeEncode($contacts));
		$dbData["phone"]            = $phone;
		$dbData["note"]             = EncodeUtil::dbUnicodeEncode(EncodeUtil::unicodeEncode($note));
		$dbData["activity_no"]      = $this->generateActivityNo();
		$dbData["activity_status"]  = "1";
		$dbData["is_message"]       = "1";
	
		if (!empty($aboutDataImg)) {
			// 包含多张图片
			if (strpos($aboutDataImg, "|") !== false) {
				$activityPic   = explode("|", $aboutDataImg);
			} else {
				$activityPic[] = $aboutDataImg;
			}
		}
	
		try {
			$bln = false;
			$this->startTrans();
			
			if (!empty($activityPic) && is_array($activityPic)) {
				$bln = $picModel->addActivityPic($dbData["activity_no"], $activityPic);
			} else {
				$bln = false;
			}
				
			if ($bln !== false) {
				$id = $this->data($dbData)->add();
			} else {
				$id = false;
			}
			
			if ($id !== false) {
				$this->commit();
				$blnSucc = true;
				$version = $this->getVersion($id);
			} else {
				$this->rollback();
			}
		} catch (\Exception $e) {
			$this->rollback();
			JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
		}
		
		return $blnSucc;
	}
	
	protected function generateActivityNo() {
		$code = "130".$this->generateRandomTime(true, 10);
		
		if (!empty($code)) {
			try {
				$where = " c.activity_no = '".$code."' ";
				$count = $this->where($where)->count();
				
				if (intval($count) > 0) {
					$code = $this->generateActivityNo();
				}
			} catch (\Exception $e) {
				$code = "";
			}
		}
		
		return $code;
	}
	
	public function getApplyActivity($userId, $page = 1) {
		$projects = array();
		
		if (!empty($userId)) {
			$where   = " 1 = 1 and c.user_wx_id = '".$userId."' ";
			
			$field   = array();
			$field[] = "c.".$this->getPk();
			$field[] = "ifnull(c.applicant_unit, '') as applicant_unit ";
			$field[] = "ifnull(c.mission_feedback, '') as mission_feedback ";
			$field[] = "c.activity_status";
			$field[] = "c.activity_no";
			$field[] = "c.note";
			$field[] = "c.is_message";
			
			$total     = $this->countAll($where);
	    	$totalPage = $this->countPage($total);

	    	$this->setLimit($page);
			$datas = $this->where($where)->order($this->getPk()." asc")->getField($field);
			
			$whereSql = " c.user_wx_id = '".$userId."' and c.is_message = '1'";
			$count = $this->where($whereSql)->count();
			
			if (!empty($datas) && is_array($datas)) {
				foreach ($datas as $k1 => $data) {
					$project = array();
					$project["status"]    = $data["activity_status"];
					$project["activityNo"]= $data["activity_no"];
					$project["isMessage"] = $data["is_message"];
					$project["unit"]      = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["applicant_unit"]));
					$project["note"]      = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["note"]));
					$project["feedBack"]  = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["mission_feedback"]));
					$projects[] = $project;
				}
			}
		}
		
		return array("list" => $projects, "hasMessage" => $count > 0 ? "true" : "false");
	}
	
	public function updMessageStatus($activityNo, $userId) {
		$blnSucc = false;
		
		if (!empty($activityNo) && !empty($userId)) {
			$where = " c.activity_no = '".$activityNo."' and c.user_wx_id = '".$userId."' ";
			
			$field = array();
			$field[] = "c.".$this->getPk();
			$field[] = "ifnull(c.is_message, 0) as is_message";
			
			$data = $this->where($where)->field($field)->find();
			
			if (!empty($data) && !empty($data["is_message"]) && intval($data["is_message"]) === 1) {
				try {
					$this->startTrans();
					
					$id   = $data[$this->getPk()];
					
					$data = array();
					$data["is_message"] = 0;
					
					$r1 = $this->where($this->getPk()." = '".$id."'")->save($data);
					
					if ($r1 !== false) {
						$this->commit();
						$blnSucc = true;
					} else {
						$this->rollback();
					}
				} catch (\Exception $e) {
					$this->rollback();
					JsonUtil::response(JsonUtil::RET_SYSTEM_BUSY);
				}
			}
		}
		
		return $blnSucc;
	}
	
	public function getActivityDetail($activityNo) {
		$activity = array();
		
		if (!empty($activityNo)) {
			$where   = " c.activity_no = '".$activityNo."' ";
			
			$field   = array();
			$field[] = "c.activity_no";
			$field[] = "c.phone";
			$field[] = "c.activity_status";
			$field[] = "ifnull(c.applicant_unit, 0) as applicant_unit";
			$field[] = "ifnull(c.contacts, '') as contacts";
			$field[] = "ifnull(c.note, '') as note";
			$field[] = "c.audit_time";
			$field[] = "ifnull(c.mission_feedback, 0) as mission_feedback";
	
			$data = $this->where($where)->field($field)->find();
			
			if (!empty($data) && is_array($data)) {
				$picModel = new MtHelpPicModel();
				
				$activity["code"]             = $data["activity_no"];
				$activity["mobile"]           = $data["phone"];
				$activity["status"]           = $data["activity_status"];
				$activity["unit"]             = !empty($data["applicant_unit"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["applicant_unit"])) : "-";
				$activity["contacts"]         = !empty($data["contacts"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["contacts"])) : "-";
				$activity["auditTime"]        = !empty($data["audit_time"]) ? date("Y-m-d",$data["audit_time"]) : "";
				$activity["note"]             = !empty($data["note"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["note"])) : "";
				$activity["feedBack"]         = !empty($data["mission_feedback"]) ? EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["mission_feedback"])) : "";
	
				$activityPic = $picModel->findDetailPicList($data["activity_no"]);
				if (!empty($activityPic) && is_array($activityPic)) {
					$mationPic =array();
					foreach($activityPic as $key => $val) {
						$mationPic[] = ImgUtil::imgHandy($val, "320");
					}
					$activity["detailPic"] = $mationPic;
				}
			}
		}
		
		return $activity;
	}
}
?>