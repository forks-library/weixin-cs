<?php
namespace Com\Mor\Model\Weixin;
use Com\Mor\Model\VersionModel;

class WxTokenModel extends VersionModel {
	
	public function getToken($appid) {
		$token = "";
		
		if (!empty($appid)) {
			$data = $this->where("appid = '".$appid."'")->field("token, expiration")->find();
			
			if (!empty($data)) {
				$token = $data;
			}
		}
		
		return $token;
	}
	
	public function setToken($appid, $token, $expiration) {
		$rtn = false;
		
		if (!empty($appid) && !empty($token) && !empty($expiration)) {
			$id = "";
			$data = $this->where("appid = '".$appid."'")->field($this->getPk())->find();
			
			if (!empty($data)) {
				$id = $data[$this->getPk()];
			}
			
			$this->startTrans();
			if (!empty($id)) {
				$data = array();
				$data["token"] = $token;
				$data["expiration"] = $expiration;
				$r1 = $this->where($this->getPk()." = '".$id."'")->save($data);
				
				if (!empty($r1)) {
					$rtn = true;
				}
			} else {
				$data = array();
				$data['appid'] = $appid;
				$data["token"] = $token;
				$data["expiration"] = $expiration;
				$data['wx_token_id'] = $this->data($data)->add();
				
				if (!empty($data['wx_token_id'])) {
					$rtn = true;
				}
			}
			
			if ($rtn === true) {
				$this->commit();
			} else {
				$this->rollback();
			}
		}
		
		return $rtn;
	}
	
}
?>