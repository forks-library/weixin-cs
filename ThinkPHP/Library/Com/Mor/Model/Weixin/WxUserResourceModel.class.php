<?php
namespace Com\Mor\Model\Weixin;
use Com\Mor\Model\VersionModel;
use Com\Mor\Util\EncodeUtil;

class WxUserResourceModel extends VersionModel {
	
	public function isExistUserId($userId) {
		$isExist = false;
		
		if (!empty($userId)) {
			$where = " c.user_wx_id = '".$userId."' ";
			
			try {
				$count = $this->where($where)->count();
				
				if ($count > 0) {
					$isExist = true;
				}
			} catch (\Exception $e) {
				$isExist = false;
			}
		}
		
		return $isExist;
	}
	
	public function getUserDonationAmount($userId) {
		$amount = 0;
		
		if (!empty($userId)) {
			$where = " c.user_wx_id = '".$userId."' ";
			
			$field = array();
			$field[] = "ifnull(c.donation_amount, 0) as donation_amount";
			
			$data = $this->where($where)->field($field)->find();
			
			if (!empty($data) && is_array($data)) {
				$amount = $data["donation_amount"];
			}
		}
		
		return $amount;
	}
	
	public function updUserDonationAmount($userId, $alreadyMoney) {
		$blnSucc = false;
		
		if (!empty($userId) && !empty($alreadyMoney) && is_numeric($alreadyMoney)) {
			$where = " c.user_wx_id = '".$userId."' ";
			
			$field  = array();
			$field[]= "c.".$this->getPk();
			$field[]= "ifnull(c.donation_amount, 0) as donation_amount";
			
			$data = $this->where($where)->field($field)->find();
			
			if (!empty($data) && is_array($data)) {
				$id = $data[$this->getPk()];
				$am = floatval(sprintf("%.2f", $data["donation_amount"]));
				
				$data = array();
				$data["donation_amount"] = $am + floatval(sprintf("%.2f", $alreadyMoney));
				
				$this->where($this->getPk()." = '".$id."'")->field($this->getPk())->lock(true)->find();
				$r1 = $this->where($this->getPk()." = '".$id."'")->save($data);
				
				if ($r1 !== false) {
					$blnSucc = true;
				}
			}
		}
		
		return $blnSucc;
	}
	
//	public function getUserOpenId($userId) {
//		$openId = "";
//		
//		if (!empty($userId)) {
//			$where = " wx_identity = '".$userId."' ";
//			$data  = $this->where($where)->field("user_wx_id")->find();
//			
//			if (!empty($data)) {
//				$openId = $data["user_wx_id"];
//			}
//		}
//		
//		return $openId;
//	}
	
//	public function updResource($userWxId, $lang = "", $subTime = "") {
//		$blnSucc = false;
//		
//		if (!empty($userWxId)) {
//			$data = $this->where(" user_wx_id = '".$userWxId."' ")->field($this->getPk().", wx_identity, last_access_time")->find();
//			
//			if (!empty($data)) {
//				try {
//					$r1 = false;
//					$this->startTrans();
//					
//					$pk = $data[$this->getPk()];
//					
//					if (!empty($pk)) {
//						$dbData = array();
//						
//						if (!empty($lang)) {
//							$dbData["language"] = $lang;
//						}
//						if (!empty($subTime)) {
//							$dbData["subscribe_time"] = $subTime;
//						}
//						
//						$r1 = $this->where($this->getPk()." = '".$pk."' ")->save($dbData);
//					}
//						
//					if ($r1 !== false) {
//						$this->commit();
//						$blnSucc = true;
//					} else {
//						$this->rollback();
//					}
//				} catch (\Exception $e) {
//					$this->rollback();
//					$blnSucc = false;
//				}
//			}
//		}
//		
//		return $blnSucc;
//	}

	public function getNewUserId() {
		$userId = "";
		
		try {
			$this->startTrans();
			
			$userIdNo = $this->userIdNo();
			$count = $this->where(" wx_identity = '".$userIdNo."' ")->count();
			
			if ($count > 0) {
				while(true) {
					$userIdNo = $this->userIdNo();
					$count = $this->where(" wx_identity = '".$userIdNo."' ")->count();
					
					if ($count <= 0) {
						break;
					}
				}
			}
			
			if (!empty($userIdNo)) {
				$dbData = array();
				$dbData["wx_identity"] = $userIdNo;
				
				$r1 = $this->data($dbData)->add();
				
				if ($r1 !== false) {
					$this->commit();
					$userId = $userIdNo;
				} else {
					$this->rollback();
				}
			} else {
				$this->rollback();
			}
		} catch (\Exception $e) {
			$this->rollback();
		}
		
		return $userId;
	}
	
	public function addResource($userWxId, $nickName = "", $headImgUrl = "", $sex = "", $province = "", $city = "", $country = "") {
		$rtnData = array();
		
		if (empty($userWxId)) {
			return "用户ID不能为空";
		}
		
		$data = $this->where(" user_wx_id = '".$userWxId."' ")->field($this->getPk().", user_wx_id, last_access_time")->find();
		
		if (empty($data)) {
			try {
				$r1 = false;
				$this->startTrans();
				
				$dbData = array();
				$dbData["user_wx_id"]       = $userWxId;
				$dbData["last_access_time"] = time();
				
				if (!empty($nickName)) {
					$dbData["nick_name"] = EncodeUtil::dbUnicodeEncode($nickName);
				}
				if (!empty($headImgUrl)) {
					$dbData["head_img_url"] = $headImgUrl;
				}
				if (!is_null($sex) && ($sex == "0" || $sex == "1" || $sex == "2")) {
					$dbData["sex"] = $sex;
				}
				if (!empty($province)) {
					$dbData["province"] = EncodeUtil::dbUnicodeEncode($province);
				}
				if (!empty($city)) {
					$dbData["city"] = EncodeUtil::dbUnicodeEncode($city);
				}
				if (!empty($country)) {
					$dbData["country"] = EncodeUtil::dbUnicodeEncode($country);
				}
				
				$r1 = $this->data($dbData)->add();
			
				if ($r1 !== false) {
					$this->commit();
					$rtnData["id"] = $userWxId;
					
					if (!empty($nickName)) {
						$rtnData["nick"] = json_decode(html_entity_decode($nickName));
					}
					if (!empty($headImgUrl)) {
						$rtnData["headimg"] = $headImgUrl;
					}
					if (!is_null($sex) && ($sex == "0" || $sex == "1" || $sex == "2")) {
						$rtnData["sex"] = $sex;
					}
					if (!empty($province)) {
						$rtnData["province"] = $province;
					}
					if (!empty($city)) {
						$rtnData["city"] = $city;
					}
					if (!empty($country)) {
						$rtnData["country"] = $country;
					}
				} else {
					$this->rollback();
				}
			} catch (\Exception $e) {
				$this->rollback();
				$rtnData = false;
			}
		} else {
			try {
				$r1 = false;
				$this->startTrans();
				
				$pk = $data[$this->getPk()];
				
				if (!empty($pk)) {
					$dbData = array();
					$dbData["last_access_time"] = time();
					
					if (!empty($nickName)) {
						$dbData["nick_name"] = EncodeUtil::dbUnicodeEncode($nickName);
					}
					if (!empty($headImgUrl)) {
						$dbData["head_img_url"] = $headImgUrl;
					}
					if (!is_null($sex) && ($sex == "0" || $sex == "1" || $sex == "2")) {
						$dbData["sex"] = $sex;
					}
					if (!empty($province)) {
						$dbData["province"] = EncodeUtil::dbUnicodeEncode($province);
					}
					if (!empty($city)) {
						$dbData["city"] = EncodeUtil::dbUnicodeEncode($city);
					}
					if (!empty($country)) {
						$dbData["country"] = EncodeUtil::dbUnicodeEncode($country);
					}
					
					$r1 = $this->where($this->getPk()." = '".$pk."' ")->save($dbData);
				}
					
				if ($r1 !== false) {
					$this->commit();
					$rtnData["id"] = $userWxId;
					
					if (!empty($nickName)) {
						$rtnData["nick"] = json_decode(html_entity_decode($nickName));
					}
					if (!empty($headImgUrl)) {
						$rtnData["headimg"] = $headImgUrl;
					}
					if (!is_null($sex) && ($sex == "0" || $sex == "1" || $sex == "2")) {
						$rtnData["sex"] = $sex;
					}
					if (!empty($province)) {
						$rtnData["province"] = $province;
					}
					if (!empty($city)) {
						$rtnData["city"] = $city;
					}
					if (!empty($country)) {
						$rtnData["country"] = $country;
					}
				} else {
					$this->rollback();
				}
			} catch (\Exception $e) {
				$this->rollback();
				$rtnData = false;
			}
		}
		
		return $rtnData;
	}
	
	public function openAuthLogined($userId) {
		$blnLogined = false;
		
		if (!empty($userId)) {
			try {
				$this->startTrans();
				
				$where = " user_wx_id = '".$userId."' ";
				$count = $this->where($where)->count();
				
				$data = array();
				$data["is_open_auth"] = "1";
				$data["last_opauth_time"] = time();
				
				$r1 = false;
				
				if ($count > 0) {
					$r1 = $this->where($where)->save($data);
				} else {
					$data["user_wx_id"] = $userId;
					$r1 = $this->data($data)->add();
				}
				
				if ($r1 !== false) {
					$this->commit();
					$blnLogined = true;
				} else {
					$this->rollback();
				}
			} catch (\Exception $e) {
				$this->rollback();
			}
		}
		
		return $blnLogined;
	}
	
	public function silentAuthLogined($userId) {
		$blnLogined = false;
		
		if (!empty($userId)) {
			try {
				$this->startTrans();
				
				$where = " user_wx_id = '".$userId."' ";
				$count = $this->where($where)->count();
				
				$data = array();
				$data["last_siauth_time"] = time();
				
				$r1 = false;
				
				if ($count > 0) {
					$r1 = $this->where($where)->save($data);
				} else {
					$data["user_wx_id"] = $userId;
					$r1 = $this->data($data)->add();
				}
				
				if ($r1 !== false) {
					$this->commit();
					$blnLogined = true;
				} else {
					$this->rollback();
				}
			} catch (\Exception $e) {
				$this->rollback();
			}
		}
		
		return $blnLogined;
	}
	
	/**
	 * 订单编码的基本规则
	 */
	private function userIdNo() {
		return date("YmdHis", time()).rand(100000, 999999);
	}
	
	/**
	 * 获取用户名和捐款总额。
	 */
//	public function getUserNameAndMoeny($userId) {
//	 	$userData = array();
//	 		
//	 	if (!empty($userId)) {
//	 		$where   = " 1 = 1 and c.user_wx_id = '".$userId."' and mho.order_status = 2 ";
//	 		
//	 		$field = array();
//	 		$field[] = "ifnull(c.nick_name, '') as nick_name";
//	 		$field[] = "sum(mho.pay_amount) as all_pay";
//	 	
//	 		$join = " left join mt_help_order mho on mho.wx_user_id = c.user_wx_id";
//	 		$this->join($join);
//	 		$data = $this->where($where)->field($field)->find();
//	 		
//	 		$userData["nickName"] = EncodeUtil::unicodeDecode(EncodeUtil::dbUnicodeDecode($data["nick_name"]));
//	 		$userData["allPay"]   = !empty($data["all_pay"]) ? $data["all_pay"] : "0.00";
//	 		
//	 	}
//	 	
//	 	return $userData;
//	}
	
}
?>