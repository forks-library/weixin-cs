<?php
namespace Com\Mor\Model;
use Think\Model;
use Com\Mor\Util\ModeUtil;
//use Com\Mor\Manage\CacheManage;
//use Com\Mor\Model\App\AppCacheModel;

class VersionModel extends Model {
	
	protected $versionName   = "version";
	protected $deletedName   = "deleted";
	protected $createBy      = "create_by";
	protected $createDate    = "create_date"; 
	protected $updateBy      = "update_by";
	protected $updateDate    = "update_date";
	protected $deleteBy      = "deleted_by";
	protected $deleteDate    = "deleted_date";
	protected $_cache        = array();
	protected $lockDeleted   = true;
    protected $_pageSize     = 40;
	
	// 是否进行数据缓存
    private   $_blnDataCache = false;
    private   $_appid        = "";
    private   $_cacheModel   = "";
    private   $_cacheManage  = "";
    private   $_nextKey      = "";
    private   $_totalSize    = 0;
    // 倍数
    private   $_times        = 10;
    private   $_cacheDb      = "";
    private   $_cacheKey     = "";
    
    public function countAll($where = "") {
    	$count = 0;
    	
    	if (!empty($where)) {
    		$where .= " and c.deleted = '0'";
    		$count = $this->where($where)->count();
    	} else {
    		$where = " c.deleted = '0'";
    		$count = $this->where($where)->count();
    	}
    	
    	return intval($count);
    }
    
    public function countPage($total = 0, $pageSize = 0) {
    	$page = 0;
    	if (empty($total)) {
//    		$total = $this->countAll();
    	} else {
    		$total = intval($total);
    	}
    	
    	if (intval($pageSize) <= 0) {
    		$pageSize = $this->_pageSize;
    	}
    	
    	$page  = floor($total / $pageSize);
    	
    	if ($total - ($page * $pageSize) > 0) {
    		$page++;
    	}
    	
    	return $page;
    }
    
    protected function setLimit($page, $pageSize = 0) {
    	if (intval($pageSize) <= 0) {
    		$pageSize = $this->_pageSize;
    	}
    	
    	if (!empty($page) && is_numeric($page) && intval($page) > 0) {
    		$page  = intval($page);
    		$start = ($page - 1) * $pageSize;
    		$this->limit($start, $pageSize);
    	} else {
    		$this->limit(0, $pageSize);
    	}
    }
    
    protected function distantSql($lat1, $lng1, $lat2, $lng2, $alias) {
    	$sql = "";
    	
    	if (!empty($lat1) && !empty($lng1) && !empty($lat2) && !empty($lng2)) {
    		$sql = " round(6378.137*2*asin(sqrt(pow(sin((".$lat1."*pi()/180-".$lat2."*pi()/180)/2),2)+cos(".$lat1."*pi()/180)*cos(".$lat2."*pi()/180)*pow(sin((".$lng1."*pi()/180-".$lng2."*pi()/180)/2),2)))*1000) ";
    		if (!empty($alias)) {
    			$sql .= " as ".$alias." ";
    		}
    	}
    	
    	return $sql;
    }
    
    /**
     * 匹配unicode查询
     * @param string $value 数值
     * @return string $sql  SQL条件
     */
    protected function fetchUnicodeSql($value) {
    	$sql = "";
    	
    	if (!empty($value)) {
    		$sql = " REGEXP '^([#]|[\|]|[0-9a-z]|_u[a-z0-9]{4})*".$value."([#]|[\|]|[0-9a-z]|_u[a-z0-9]{4})*$' ";
    	}
    	
    	return $sql;
    }
    
    protected function setDataCache($appId, $nextKey = "", $pageSize = "", $blnDataCache = true) {
    	$this->_appid        = strtolower(CACHE_KEY_HEADER."-".$appId);
//    	if (!empty($totalSize) && is_numeric($totalSize) && intval($totalSize) > 0) {
//    		$this->_totalSize = intval($totalSize);
//    	}
    	$this->_nextKey      = $nextKey;
    	if (!empty($pageSize) && is_numeric($pageSize) && intval($pageSize) > 0) {
    		$this->_pageSize = intval($pageSize);
    	}
    	$this->_blnDataCache = $blnDataCache;
    	$this->_cacheModel   = new AppCacheModel();
    	$this->_cacheManage  = new CacheManage();
    	
    	$this->_cacheDb = $this->_cacheModel->findDb($this->_appid);
    	$this->_cacheManage->select($this->_cacheDb);
    	
    	$this->_cacheKey = $this->getCacheKey($this->_appid);
    }
    
    protected function getCacheKey($appId) {
    	return !empty($appId) ? $appId."-select" : "";
    }
    
    public function getField($field, $sepa = null, $isSuper = false, $indexKeys = "") {
    	$resultSet    = array();
    	$blnExtend    = false;
    	$blnLoadCache = false;
    	
    	if (!empty($field) && is_string($field)) {
    		if ($this->_blnDataCache === false) {
    			$blnExtend = true;
    		} else if (strpos($field, ") AS tp_") !== false) {
    			$blnExtend = true;
    		}
    	} else if (!empty($field) && is_array($field) && $this->_blnDataCache === false) {
    		$blnExtend = true;
    	}
    	
    	if ($blnExtend === false && !empty($this->_cacheModel) && !empty($this->_appid) && $this->_blnDataCache === true && $this->name !== "AppCache") {
    		$compareSql = $this->_cacheModel->findSqlRecord($this->_appid);
    		
    		if (!empty($compareSql) && !empty($this->_nextKey) && !empty($indexKeys)) {
    			$this->db->setDataCache();
    			$this->db->setCompareSql($compareSql);
    			$resultSet = parent::getField($field, $sepa, $isSuper, $indexKeys);
    			$this->_totalSize = $this->_cacheModel->findTotalSize($this->_appid);
    			
    			if (!empty($resultSet) && is_string($resultSet)) {
    				$sql       = $resultSet;
    				$nextIndex = $this->_cacheManage->mIndexK($this->_cacheKey, $this->_nextKey);
    				
    				if ($nextIndex === false) {
    					$nextIndex = -1;
    				}
    				
    				$resultSet = $this->_cacheManage->mgetMaps($this->_cacheKey, $nextIndex + 1, $nextIndex + $this->_pageSize, true);
    				
    				if (empty($resultSet)) {
    					if (($this->_totalSize - $nextIndex - 1) > $this->_pageSize * $this->_times) {
    						$sql .= " limit ".($nextIndex + 1).",".($this->_pageSize * $this->_times);
    					} else {
    						$sql .= " limit ".($nextIndex + 1).",".($this->_totalSize - $nextIndex - 1);
    					}
    					
    					$resultSet = $this->query($sql);
    					
    					if (!empty($resultSet) && is_array($resultSet) && sizeof($resultSet) > 0 && isset($resultSet[0][$indexKeys])) {
    						$newResultSet = array();
    						
    						for ($i = 0; $i < sizeof($resultSet); $i++) {
    							$result = $resultSet[$i];
    							$newResultSet[$result[$indexKeys]] = $result;
    						}
    						
    						$firstIndex = $this->_cacheManage->mIndexK($this->_cacheKey, $resultSet[0][$indexKeys]);
    						$resultSet  = $newResultSet;
    						
    						if ($firstIndex === false) {
    							$this->_cacheManage->mset($this->_cacheKey, $resultSet, true, true);
    						} else {
    							$this->_cacheManage->mset($this->_cacheKey, $resultSet, true, true, $firstIndex);
    						}
    						
    						$resultSet = array_slice($resultSet, 0, $this->_pageSize);
    						$this->_cacheModel->addSqlRecord($this->_appid, $this->_cacheDb, $this->_cacheKey, $sql, $nextIndex + 1 + sizeof($newResultSet), $this->_totalSize);
    					}
    				}
    			} else {
    				$this->_cacheManage->mset($this->_cacheKey, $resultSet, false, true);
	    			$resultSet = array_slice($resultSet, 0, $this->_pageSize);
	    			$this->_cacheModel->addSqlRecord($this->_appid, $this->_cacheDb, $this->_cacheKey, $this->db->getLastSql($this->name), $this->_pageSize * $this->_times, $this->_totalSize);
    			}
    			
				$blnLoadCache = true;
    		}
    	}
    	
    	if ($blnLoadCache === false) {
    		if ($blnExtend === false) {
    			$this->limit(0, $this->_pageSize * $this->_times);
	    		$resultSet = parent::getField($field, $sepa, $isSuper, $indexKeys);
	    		
	    		$this->_cacheManage->mset($this->_cacheKey, $resultSet, false, true);
	    		if (!empty($resultSet)) {
	    			$resultSet = array_slice($resultSet, 0, $this->_pageSize);
	    		}
	    		
	    		$sql   = strtolower($this->db->getLastSql($this->name));
	    		$cSql  = substr($sql, 0, strpos($sql, "limit"));
	    		$cSql  = "select count(*) as count from (".$cSql.") z";
	    		$count = $this->query($cSql);
	    		
	    		if (!empty($count) && is_array($count)) {
	    			$count = $count[0];
	    			$count = $count["count"];
	    		}
	    		
	    		$this->_cacheModel->addSqlRecord($this->_appid, $this->_cacheDb, $this->_cacheKey, $sql, $this->_pageSize * $this->_times, $count);
	    	} else if ($blnExtend === true) {
	    		$resultSet = parent::getField($field, $sepa, $isSuper, $indexKeys);
	    	}
    	}
    	
    	if (!empty($resultSet) && is_array($resultSet)) {
    		$newResultSet = array();
    		
    		foreach ($resultSet as $key => $data) {
    			if (isset($data[$this->versionName])) {
    				unset($data[$this->versionName]);
    			}
    			$newResultSet[] = $data;
    		}
    		
    		$resultSet = $newResultSet;
    	}
    	
    	return $resultSet;
    }
	
	public function add($data='',$options=array(),$replace=false) {
		if (isset($this->data[$this->getPk()])) {
			unset($this->data[$this->getPk()]);
		}
		
		if (!isset($this->data[$this->versionName])) {
        	$this->data[$this->versionName] = 0;
        }
		
		$loginUser = session(R_SYS_NAME.SESSION_LOGIN_USER_NAME);
        if (empty($loginUser)) {
        	$loginUser = session(R_SYS_NAME.SESSION_LOGIN_USER);
        }
        if (empty($loginUser)) {
        	$loginUser = "SYSTEM-AUTO";
        }
        
        $this->data[$this->createBy] = $loginUser;
        $this->data[$this->createDate] = time();
        $this->data[$this->deletedName] = "0";
        
        if (isset($this->data[$this->updateBy])) {
        	unset($this->data[$this->updateBy]);
        }
        if (isset($this->data[$this->updateDate])) {
        	unset($this->data[$this->updateDate]);
        }
        if (isset($this->data[$this->deleteBy])) {
        	unset($this->data[$this->deleteBy]);
        }
        if (isset($this->data[$this->deleteDate])) {
        	unset($this->data[$this->deleteDate]);
        }
		
		return parent::add($data, $options, $replace);
	}
	
	protected function _before_update(&$data, $options) {
		$tableName = $this->getTableName();
		if (isset($data[$this->getPk()])) {
        	unset($data[$this->getPk()]);
        }
		
		if (isset($data[$this->versionName])) {
        	$sql = "select ".$this->versionName." from ".$tableName;
        	$where = '';
        	if (isset($options["where"]) && is_array($options["where"])) {
        		$where .= isset($options["where"]["_string"]) && !empty($options["where"]["_string"]) ? $options["where"]["_string"] : '';
        	}
        	if (!empty($where)) {
        		$sql .= ' where '.$where;
        	}
        	$arrData = $this->query($sql);
        	
        	if (!empty($arrData) && is_array($arrData) && sizeof($arrData) == 1) {
        		$dbData = $arrData[0];
        		$dbVersion = "";
        		$version = $data[$this->versionName];
        		
        		if (isset($dbData[$this->versionName])) {
        			$dbVersion = $dbData[$this->versionName];
        		}
        		
        		if (intval($version) != intval($dbVersion)) {
        			\Think\Log::write("版本不正确，请检查版本：".$version, "ERR");
        			return false;
        		} else {
        			unset($data[$this->versionName]);
        		}
        	} else {
        		\Think\Log::write("返回的结果不正确，请检查where条件：".$where, "ERR");
        		return false;
        	}
        }
        
        if (!isset($data[$this->versionName])) {
        	$data[$this->versionName] = $this->versionName." + 1";
        }
        
        $loginUser = session(R_SYS_NAME.SESSION_LOGIN_USER_NAME);
        if (empty($loginUser)) {
        	$loginUser = session(R_SYS_NAME.SESSION_LOGIN_USER);
        }
        if (empty($loginUser)) {
        	$loginUser = "SYSTEM-AUTO";
        }
        
        unset($data[$this->createBy]);
        unset($data[$this->createDate]);
        $data[$this->updateBy] = $loginUser;
        $data[$this->updateDate] = time();
        unset($data[$this->deleteBy]);
        unset($data[$this->deleteDate]);
        
        if (isset($data[$this->deletedName]) 
        	&& ("1" === $data[$this->deletedName] || 1 === $data[$this->deletedName] 
        		|| true === $data[$this->deletedName] || "true" === $data[$this->deletedName])) {
        	unset($data[$this->versionName]);
        	unset($data[$this->updateBy]);
        	unset($data[$this->updateDate]);
        	
        	$data[$this->deletedName] = "1";
        	$data[$this->deleteBy] = $loginUser;
        	$data[$this->deleteDate] = time();
        } else if ($this->lockDeleted === true) {
        	unset($data[$this->deletedName]);
        }
        
        return true;
	}
	
	public function delData($id) {
		if (!empty($id)) {
			$pk = $this->getPk();
			
			if (!empty($pk)) {
				try {
					$arrData = array();
					$arrData[$this->deletedName] = true;
					$result = $this->where($pk." = '".$id."'")->save($arrData);
					
					if ($result > 0) {
						return true;
					}
				} catch (\Exception $e) {
					return false;
				}
			}
		}
		
		return false;
	}
	
	public function startTrans() {
		parent::startTrans();
		$this->_cache = array();
	}
	
	protected function _memcache($k, $v = '') {
		$r = false;
		
		if (!empty($k)) {
			if (empty($v)) {
				if (isset($this->_cache[$k]) && !empty($this->_cache[$k])) {
					$r = $this->_cache[$k];
				}
			} else {
				$this->_cache[$k] = $v;
				$r = true;
			}
		}
		
		return $r;
	}
	
	public function getVersion($id) {
		if (!empty($id)) {
			$pk = $this->getPk();
			
			if (!empty($pk)) {
				if ($this->_hasVersion($this->fields)) {
					$arrData = $this->where($pk." = '".$id."'")->field($this->versionName)->find();
					
					if (!empty($arrData)) {
						return intval($arrData[$this->versionName]);
					} else {
						return false;
					}
				}
			}
		}
		
		return false;
	}
	
	protected function _hasVersion($arrData) {
		return $this->_check($arrData, $this->versionName);
	}
	
	protected function _check($arrData, $check) {
		if (!empty($arrData) && is_array($arrData) && !empty($check)) {
			foreach ($arrData as $data) {
				if (is_string($data) && $data === $check) {
					return true;
				}
			}
		}
		
		return false;
	}
	
	protected function debug() {
		return ModeUtil::isDebug();
	}
	
	/**
	 * 生成指定长度的随机数字
	 * @param  int $len   随机数字最大长度
	 * @return int $code  商家唯一编号
	 */
	protected function generateRandomNum($len = 5) {
		$code = 0;
		
		if (!empty($len) && is_numeric($len) && intval($len) >= 1) {
			$start = intval(str_pad("1", $len, "0", STR_PAD_RIGHT));
			$end   = intval(str_pad("9", $len, "9", STR_PAD_RIGHT));
			$code  = mt_rand($start, $end);
		}
		
		return $code;
	}
	
	protected function generateRandomTime($onlyTime = false, $len = 3) {
		if ($onlyTime === true) {
			if (!empty($len) && intval($len) > 0) {
				return date("YmdHis", time()).rand($len * 100, $len * 1000 - 1);
			}
			
			return date("YmdHis", time());
		}
		
		return date("YmdHis", time()).rand(100000, 999999);
	}
	
}
?>
