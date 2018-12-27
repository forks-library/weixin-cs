<?php
namespace Com\Mor\Model\Weixin;
use Com\Mor\Model\VersionModel;

class WxTicketModel extends VersionModel {
	
	public function getTicket($appid) {
		$ticket = "";
		
		if (!empty($appid)) {
			$data = $this->where("appid = '".$appid."'")->field("ticket, expiration")->find();
			
			if (!empty($data)) {
				$ticket = $data;
			}
		}
		
		return $ticket;
	}
	
	public function setTicket($appid, $ticket, $expiration) {
		$rtn = false;
		
		if (!empty($appid) && !empty($ticket) && !empty($expiration)) {
			$id = "";
			$data = $this->where("appid = '".$appid."'")->field($this->getPk())->find();
			
			if (!empty($data)) {
				$id = $data[$this->getPk()];
			}
			
			$this->startTrans();
			if (!empty($id)) {
				$data = array();
				$data["ticket"] = $ticket;
				$data["expiration"] = $expiration;
				$r1 = $this->where($this->getPk()." = '".$id."'")->save($data);
				
				if (!empty($r1)) {
					$rtn = true;
				}
			} else {
				$data = array();
				$data['appid'] = $appid;
				$data["ticket"] = $ticket;
				$data["expiration"] = $expiration;
				$data['wx_ticket_id'] = $this->data($data)->add();
				
				if (!empty($data['wx_ticket_id'])) {
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