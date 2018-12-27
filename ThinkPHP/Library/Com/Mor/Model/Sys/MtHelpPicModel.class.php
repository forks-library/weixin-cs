<?php
namespace Com\Mor\Model\Sys;
use Com\Mor\Model\VersionModel;
use Com\Mor\Util\EncodeUtil;
use Com\Mor\Util\JsonUtil;

/**
 * Copyright (C), 2015-2016, Lesky tech. Co., Ltd.
 * FileName: MtGoodPicModel.class.php
 * Summary:  商品图片信息记录
 * @author   Chen Mao
 * @Date     2016/9/29
 * @version  1.0.0
 * @author   Yan
 * @Date     2017/04/06
 * @version  1.1.0
 * 
 * type: 1   banner
 * type: 2   detail
 * type: 3   车辆外观
 * type: 4   中控台
 * type: 5   车辆内饰
 * type: 6   车辆其它
 */
class MtHelpPicModel extends VersionModel {
	
	/**
	 * 查询商品图片信息
	 * @param string $compCode  公司编码
	 * @param string $goodNo    商品编码
	 * @return array $picData   图片数据
	 */
	public function findHelpPicList($helpCode, $compCode = "") {
		$picDetailData = array();
		$picIdCardData = array();
		
		if (!empty($helpCode)) {
			$field   = array();
			$field[] = "c.".$this->getPk();
			$field[] = "c.pic_url";
			$field[] = "c.pic_type";
			
			$where = " help_code = '".$helpCode."' and pic_type in (1, 2) ";
		
			$datas = $this->where($where)->getField($field);
			
			if (!empty($datas) && is_array($datas)) {
				foreach ($datas as $key => $val) {
					if (intval($val["pic_type"]) === 1) {
						$picIdCardData[] = urldecode($val["pic_url"]);
					} else if (intval($val["pic_type"]) === 2) {
						$picDetailData[] = urldecode($val["pic_url"]);
					}
				}
			}
		}
		
		return array($picDetailData, $picIdCardData);
	}
	
	public function findDetailPicList($helpCode) {
		$picDetailData = array();
		
		if (!empty($helpCode)) {
			$field   = array();
			$field[] = "c.".$this->getPk();
			$field[] = "c.pic_url";
			$field[] = "c.pic_type";
			
			$where = " help_code = '".$helpCode."' and pic_type = '3' ";
		
			$datas = $this->where($where)->getField($field);
			
			if (!empty($datas) && is_array($datas)) {
				foreach ($datas as $key => $val) {
					$picDetailData[] = urldecode($val["pic_url"]);
				}
			}
		}
		
		return $picDetailData;
	}
	
	public function getFirstHelpPic($helpCode) {
		$firstHelpPic = "";
		
		if (!empty($helpCode)) {
			$field   = array();
			$field[] = "c.".$this->getPk();
			$field[] = "c.pic_url";
			$field[] = "c.pic_type";
			
			$where = " help_code = '".$helpCode."' and pic_type in (1, 2) ";
			
			$data = $this->where($where)->order("c.".$this->getPk()." asc")->field($field)->find();
			
			if (!empty($data)) {
				$firstHelpPic = urldecode($data["pic_url"]);
			}
		}
		
		return $firstHelpPic;
	}
	
	public function findCarparkPicList($goodNo) {
		$picAutoExterior = array();
		$picAutoConsole  = array();
		$picAutoInterior = array();
		$picAutoOthers   = array();
		
		if (!empty($goodNo)) {
			$field   = array();
			$field[] = "c.".$this->getPk();
			$field[] = "c.pic_url";
			$field[] = "c.pic_type";
			
			$where = " good_no = '".$goodNo."' and pic_type in (3, 4, 5, 6) ";
			$datas = $this->where($where)->getField($field);
			
			if (!empty($datas) && is_array($datas)) {
				foreach ($datas as $key => $val) {
					if (intval($val["pic_type"]) === 3) {
						$picAutoExterior[] = urldecode($val["pic_url"]);
					} else if (intval($val["pic_type"]) === 4) {
						$picAutoConsole[] = urldecode($val["pic_url"]);
					} else if (intval($val["pic_type"]) === 5) {
						$picAutoInterior[] = urldecode($val["pic_url"]);
					} else if (intval($val["pic_type"]) === 6) {
						$picAutoOthers[] = urldecode($val["pic_url"]);
					}
				}
			}
		}
		
		return array($picAutoExterior, $picAutoConsole, $picAutoInterior, $picAutoOthers);
	}
	
	/**
	 * 查询商品图片数据Id
	 */
	public function getPicIdListByGoodNo($goodNo) {
		$dataId  = array();
		
		if (!empty($goodNo)) {
			$where = "good_no = '".$goodNo."'";
			$datas = $this->where($where)->getField($this->getPk());
			
			if (!empty($datas) && is_array($datas)) {
				foreach ($datas as $key => $val) {
					$dataId[]  = $val[$this->getPk()];
				}
			}
		}
		
		return $dataId;
	}
	
	/**
	 * 查询商品活动图片信息
	 * @param  string $compCode   公司编码
	 * @param  string $activityNo 活动编号
	 * @return array  $picData    图片数据
	 */
	public function findGoodsActivityPicList($compCode, $activityNo) {
		$picData = array();
		
		if (!empty($compCode) && !empty($activityNo)) {
			$field   = array();
			$field[] = "c.".$this->getPk();
			$field[] = "c.pic_url";
			
			$where = " comp_code = '".$compCode."' and activity_no = '".$activityNo."' and pic_type = '3' ";
			$datas = $this->where($where)->getField($field);
			
			if (!empty($datas) && is_array($datas)) {
				foreach ($datas as $key => $val) {
					$picData[] = urldecode($val["pic_url"]);
				}
			}
		}
		
		return $picData;
	}
	
	/**
	 * 添加pic
	 */
	public function addPic($compCode, $goodNo, $picType, $picUrl) {
		$blnSucc = false;
		
		if (!empty($compCode) && !empty($goodNo) && !empty($picType) && !empty($picUrl)) {
			$newArr = array();
			$newArr["comp_code"] = $compCode;
			$newArr["good_no"]   = $goodNo;
			$newArr["pic_type"]  = $picType;
			$newArr["pic_url"]   = urlencode($picUrl);
			
			try {
				$id = $this->data($newArr)->add();
				
				if ($id !== false) {
					$blnSucc = true;
				}
			} catch (\Exception $e) {
			}
		}
		
		return $blnSucc;
	}
	
	public function addIdCardPic($helpCode, $picUrls) {
		$blnSucc = false;
		
		if (!empty($helpCode) && !empty($picUrls) && is_array($picUrls)) {
			$blnSucc = $this->addPicForOtherModel("1", $helpCode, $picUrls);
		}
		
		return $blnSucc;
	}
	
	public function addDetailPic($helpCode, $picUrls) {
		$blnSucc = false;
		
		if (!empty($helpCode) && !empty($picUrls) && is_array($picUrls)) {
			$blnSucc = $this->addPicForOtherModel("2", $helpCode, $picUrls);
		}
		
		return $blnSucc;
	}
	
	public function addActivityPic($goodNo, $picUrls) {
		$blnSucc = false;
		
		if (!empty($goodNo) && !empty($picUrls) && is_array($picUrls)) {
			$blnSucc = $this->addPicForOtherModel("3", $goodNo, $picUrls);
		}
		
		return $blnSucc;
	}
	public function addVolunteerPic($goodNo, $picUrls) {
		$blnSucc = false;
		
		if (!empty($goodNo) && !empty($picUrls) && is_array($picUrls)) {
			$blnSucc = $this->addPicForOtherModel("4", $goodNo, $picUrls);
		}
		
		return $blnSucc;
	}
//	
//	public function addAutoConsole($goodNo, $picUrls) {
//		$blnSucc = false;
//		
//		if (!empty($goodNo) && !empty($picUrls) && is_array($picUrls)) {
//			$blnSucc = $this->addPicForOtherModel("4", $goodNo, $picUrls);
//		}
//		
//		return $blnSucc;
//	}
//	
//	public function addAutoInterior($goodNo, $picUrls) {
//		$blnSucc = false;
//		
//		if (!empty($goodNo) && !empty($picUrls) && is_array($picUrls)) {
//			$blnSucc = $this->addPicForOtherModel("5", $goodNo, $picUrls);
//		}
//		
//		return $blnSucc;
//	}
//	
//	public function addAutoOthers($goodNo, $picUrls) {
//		$blnSucc = false;
//		
//		if (!empty($goodNo) && !empty($picUrls) && is_array($picUrls)) {
//			$blnSucc = $this->addPicForOtherModel("6", $goodNo, $picUrls);
//		}
//		
//		return $blnSucc;
//	}
	
	public function releaseOldPic($goodNo) {
		$blnSucc = false;
		
		if (!empty($goodNo)) {
			$picDataIds = $this->getPicIdListByGoodNo($goodNo);
			
			if (!empty($picDataIds) && is_array($picDataIds)) {
				foreach ($picDataIds as $key => $picDataId) {
					$bln = $this->delData($picDataId);
					
					if ($bln === false) {
						$blnSucc = false;
						break;
					} else {
						$blnSucc = true;
					}
				}
			} else {
				$blnSucc = true;
			}
		}
		
		return $blnSucc;
	}
	
	protected function addPicForOtherModel($type, $helpCode, $picUrls) {
		$blnSucc = false;

		if (!empty($type) && is_numeric($type) && !empty($helpCode) && !empty($picUrls) && is_array($picUrls)) {
			$r1 = false;
			
			$dbData = array();
			
			$sql  = " select ";
			$sql .= " c.".$this->getPk()." as id, c.pic_url ";
			$sql .= " from mt_help_pic c ";
			$sql .= " where c.pic_type = '".$type."' and c.help_code = '".$helpCode."' and (c.pic_url is not null or c.pic_url <> '') ";
			
			$dbDatas = $this->query($sql);
			
			if (!empty($dbDatas) && is_array($dbDatas)) {
				foreach ($dbDatas as $k1 => $data) {
					$dbData[$data["pic_url"]] = $data["id"];
					// 先将所有旧数据进行逻辑删除
					$this->delData($data["id"]);
				}
			}
			
			foreach ($picUrls as $k1 => $picUrl) {
				$encodeUrl = urlencode($picUrl);
			    
				if (!empty($dbData) && is_array($dbData)) {
					if (isset($dbData[$encodeUrl]) && !empty($dbData[$encodeUrl])) {
						$id = $dbData[$encodeUrl];
						
						// 切换lockDeleted模式
						$this->lockDeleted = false;
						
						// 更新
						$saveData = array();
						$saveData[$this->deletedName] = false;

						$id = $this->where($this->getPk()." = '".$id."'")->save($saveData);
						
						if ($id === false) {
							$r1 = false;
							break;
						} else {
							$r1 = true;
						}
						
						// 切换lockDeleted模式
						$this->lockDeleted = true;
					} else {
						// 新增
						$saveData = array();
						$saveData["help_code"] = $helpCode;
						$saveData["pic_type"]  = $type;
						$saveData["pic_url"]   = $encodeUrl;
						
						$id = $this->data($saveData)->add();
				
						if ($id === false) {
							$r1 = false;
							break;
						} else {
							$r1 = true;
						}
					}
				} else {
					// 新增
					$saveData = array();
					$saveData["help_code"] = $helpCode;
					$saveData["pic_type"]  = $type;
					$saveData["pic_url"]   = $encodeUrl;
					
					$id = $this->data($saveData)->add();
			
					if ($id === false) {
						$r1 = false;
						break;
					} else {
						$r1 = true;
					}
				}
			}
			
			if ($r1 === true) {
				$blnSucc = true;
			}
		}
		
		return $blnSucc;
	}
	
}
?>