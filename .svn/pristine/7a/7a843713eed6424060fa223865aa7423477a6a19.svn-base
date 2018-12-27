<?php
namespace Com\Mor\Manage;
use Com\Mor\Util\WebUtil;
use Com\Mor\Manage\EncryptionManage;

class WeiXinManage {
	
	public static $_URL_API_ROOT      = 'https://api.weixin.qq.com';
	
	public static $_URL_FILE_API_ROOT = 'http://file.api.weixin.qq.com';
	
	public static $_URL_MP_ROOT       = 'http://mp.weixin.qq.com';
	
	public static $_URL_OP_ROOT       = 'https://open.weixin.qq.com';
	
	public static $_QRCODE_TICKET_DEFAULT_ID = 1;
	
	public static $ERRCODE_MAP = array(
            '-1'   =>'系统繁忙',
            '0'    =>'请求成功',
            '40001'=>'获取access_token时AppSecret错误，或者access_token无效',
            '40002'=>'不合法的凭证类型',
            '40003'=>'不合法的UserID',
            '40004'=>'不合法的媒体文件类型',
            '40005'=>'不合法的文件类型',
            '40006'=>'不合法的文件大小',
            '40007'=>'不合法的媒体文件id',
            '40008'=>'不合法的消息类型',
            '40013'=>'不合法的corpid',
            '40014'=>'不合法的access_token',
            '40015'=>'不合法的菜单类型',
            '40016'=>'不合法的按钮个数',
            '40017'=>'不合法的按钮类型',
            '40018'=>'不合法的按钮名字长度',
            '40019'=>'不合法的按钮KEY长度',
            '40020'=>'不合法的按钮URL长度',
            '40021'=>'不合法的菜单版本号',
            '40022'=>'不合法的子菜单级数',
            '40023'=>'不合法的子菜单按钮个数',
            '40024'=>'不合法的子菜单按钮类型',
            '40025'=>'不合法的子菜单按钮名字长度',
            '40026'=>'不合法的子菜单按钮KEY长度',
            '40027'=>'不合法的子菜单按钮URL长度',
            '40028'=>'不合法的自定义菜单使用员工',
            '40029'=>'不合法的oauth_code',
            '40031'=>'不合法的UserID列表',
            '40032'=>'不合法的UserID列表长度',
            '40033'=>'不合法的请求字符，不能包含\uxxxx格式的字符',
            '40035'=>'不合法的参数',
            '40038'=>'不合法的请求格式',
            '40039'=>'不合法的URL长度',
            '40040'=>'不合法的插件token',
            '40041'=>'不合法的插件id',
            '40042'=>'不合法的插件会话',
            '40048'=>'url中包含不合法domain',
            '40054'=>'不合法的子菜单url域名',
            '40055'=>'不合法的按钮url域名',
            '40056'=>'不合法的agentid',
            '40057'=>'不合法的callbackurl',
            '40058'=>'不合法的红包参数',
            '40059'=>'不合法的上报地理位置标志位',
            '40060'=>'设置上报地理位置标志位时没有设置callbackurl',
            '40061'=>'设置应用头像失败',
            '40062'=>'不合法的应用模式',
            '40063'=>'红包参数为空',
            '40064'=>'管理组名字已存在',
            '40065'=>'不合法的管理组名字长度',
            '40066'=>'不合法的部门列表',
            '40067'=>'标题长度不合法',
            '40068'=>'不合法的标签ID',
            '40069'=>'不合法的标签ID列表',
            '40070'=>'列表中所有标签（用户）ID都不合法',
            '40071'=>'不合法的标签名字，标签名字已经存在',
            '40072'=>'不合法的标签名字长度',
            '40073'=>'不合法的openid',
            '40074'=>'news消息不支持指定为高保密消息',
            '41001'=>'缺少access_token参数',
            '41002'=>'缺少corpid参数',
            '41003'=>'缺少refresh_token参数',
            '41004'=>'缺少secret参数',
            '41005'=>'缺少多媒体文件数据',
            '41006'=>'缺少media_id参数',
            '41007'=>'缺少子菜单数据',
            '41008'=>'缺少oauth code',
            '41009'=>'缺少UserID',
            '41010'=>'缺少url',
            '41011'=>'缺少agentid',
            '41012'=>'缺少应用头像mediaid',
            '41013'=>'缺少应用名字',
            '41014'=>'缺少应用描述',
            '41015'=>'缺少Content',
            '41016'=>'缺少标题',
            '41017'=>'缺少标签ID',
            '41018'=>'缺少标签名字',
            '42001'=>'access_token超时',
            '42002'=>'refresh_token超时',
            '42003'=>'oauth_code超时',
            '42004'=>'插件token超时',
            '43001'=>'需要GET请求',
            '43002'=>'需要POST请求',
            '43003'=>'需要HTTPS',
            '43004'=>'需要接收者关注',
            '43005'=>'需要好友关系',
            '43006'=>'需要订阅',
            '43007'=>'需要授权',
            '43008'=>'需要支付授权',
            '43009'=>'需要员工已关注',
            '43010'=>'需要处于企业模式',
            '43011'=>'需要企业授权',
            '44001'=>'多媒体文件为空',
            '44002'=>'POST的数据包为空',
            '44003'=>'图文消息内容为空',
            '44004'=>'文本消息内容为空',
            '45001'=>'多媒体文件大小超过限制',
            '45002'=>'消息内容超过限制',
            '45003'=>'标题字段超过限制',
            '45004'=>'描述字段超过限制',
            '45005'=>'链接字段超过限制',
            '45006'=>'图片链接字段超过限制',
            '45007'=>'语音播放时间超过限制',
            '45008'=>'图文消息超过限制',
            '45009'=>'接口调用超过限制',
            '45010'=>'创建菜单个数超过限制',
            '45015'=>'回复时间超过限制',
            '45016'=>'系统分组，不允许修改',
            '45017'=>'分组名字过长',
            '45018'=>'分组数量超过上限',
            '45028'=>'群发次数达到日限制',
            '46001'=>'不存在媒体数据',
            '46002'=>'不存在的菜单版本',
            '46003'=>'不存在的菜单数据',
            '46004'=>'不存在的员工',
            '47001'=>'解析JSON/XML内容错误',
            '48002'=>'Api禁用',
            '50001'=>'redirect_uri未授权',
            '50002'=>'员工不在权限范围',
            '50003'=>'应用已停用',
            '50004'=>'员工状态不正确（未关注状态）',
            '50005'=>'企业已禁用',
            '60001'=>'部门长度不符合限制',
            '60002'=>'部门层级深度超过限制',
            '60003'=>'部门不存在',
            '60004'=>'父亲部门不存在',
            '60005'=>'不允许删除有成员的部门',
            '60006'=>'不允许删除有子部门的部门',
            '60007'=>'不允许删除根部门',
            '60008'=>'部门名称已存在',
            '60009'=>'部门名称含有非法字符',
            '60010'=>'部门存在循环关系',
            '60011'=>'管理员权限不足，（user/department/agent）无权限',
            '60012'=>'不允许删除默认应用',
            '60013'=>'不允许关闭应用',
            '60014'=>'不允许开启应用',
            '60015'=>'不允许修改默认应用可见范围',
            '60016'=>'不允许删除存在成员的标签',
            '60017'=>'不允许设置企业',
            '60102'=>'UserID已存在',
            '60103'=>'手机号码不合法',
            '60104'=>'手机号码已存在',
            '60105'=>'邮箱不合法',
            '60106'=>'邮箱已存在',
            '60107'=>'微信号不合法',
            '60108'=>'微信号已存在',
            '60109'=>'QQ号已存在',
            '60110'=>'部门个数超出限制',
            '60111'=>'UserID不存在',
            '60112'=>'成员姓名不合法',
            '60113'=>'身份认证信息（微信号/手机/邮箱）不能同时为空',
            '60114'=>'性别不合法',
            '60119'=>'用户已关注',
            '60120'=>'用户已禁用',
            '60121'=>'找不到该用户',
            '60023'=>'应用已授权予第三方，不允许通过分级管理员修改菜单',
            '80001'=>'可信域名没有IPC备案，后续将不能在该域名下正常使用jssdk'
    );
    
    public static $_USERINFO_LANG = 'zh_CN';
    
    public static $_TOKEN_MODEL = "TOKEN_MODEL";
    
    public static $_TICKET_MODEL = "TICKET_MODEL";
    
    private $_appid;

    private $_appsecret;
    
    private $_tableModel = array();

    private static $_accessTokenCache = array();

    private static $_jsapiTicketCache = array();

    private static $ERROR_LOGS = array();

    private static $ERROR_NO = 0;
    
    /**
     * 构造函数 设置appid、appsecret
     *
     * @param string $appid
     * @param string $appsecret
     * @param object $tableModel
     */
    public function __construct($appid, $appsecret, $tokenModel = "", $ticketModel = "") {
        $this->_appid      = $appid;
        $this->_appsecret  = $appsecret;
        
        if (!empty($tokenModel)) {
        	$this->_tableModel[self::$_TOKEN_MODEL] = $tokenModel;
        }
        
        if (!empty($ticketModel)) {
        	$this->_tableModel[self::$_TICKET_MODEL] = $ticketModel;
        }
    }
    
    /**
     * 处理错误信息
     *
     * @return int
     */
    public static function error() {
        return isset(self::$ERRCODE_MAP[self::$ERROR_NO]) ? self::$ERRCODE_MAP[self::$ERROR_NO] : self::$ERROR_NO;
    }
    
    /**
     * 判断结果状态
     *
     * @param $res
     * @return bool
     */
    public static function checkIsSuc($res) {
        $result = TRUE;

        if (is_string($res)) {
            $res = json_decode($res, TRUE);
        }

        if (isset($res['errcode']) && (0 !== (int) $res['errcode'])) {
			array_push(self::$ERROR_LOGS, $res);
            $result         = FALSE;
            self::$ERROR_NO = $res['errcode'];
        }

        return $result;
    }
    
    public function getToken($appid) {
    	$myTokenInfo = array();
    	
    	if (!empty($this->_tableModel) && isset($this->_tableModel[self::$_TOKEN_MODEL])) {
    		$myTokenInfo = $this->_tableModel[self::$_TOKEN_MODEL]->getToken($appid);
    	}
    	
        return $myTokenInfo;
    }
    
    public function setToken($appid, $token, $expiration) {
    	$retCount = 0;
    	
    	if (!empty($this->_tableModel) && isset($this->_tableModel[self::$_TOKEN_MODEL])) {
    		$retCount = $this->_tableModel[self::$_TOKEN_MODEL]->setToken($appid, $token, $expiration);
    	}
    	
        return $retCount;
    }
    
    public function getTicket($appid) {
    	$myTicketInfo = array();
    	
    	if (!empty($this->_tableModel) && isset($this->_tableModel[self::$_TICKET_MODEL])) {
    		$myTicketInfo = $this->_tableModel[self::$_TICKET_MODEL]->getTicket($appid);
    	}
    	
    	return $myTicketInfo;
    }
    
    public function setTicket($appid, $ticket, $expiration) {
    	$retCount = 0;
    	
    	if (!empty($this->_tableModel) && isset($this->_tableModel[self::$_TICKET_MODEL])) {
    		$retCount = $this->_tableModel[self::$_TICKET_MODEL]->setTicket($appid, $ticket, $expiration);
    	}
    	
    	return $retCount;
    }
    
    /**
     * 获取 AccessToken
     *
     * @param int $tokenOnly
     * @param int $nocache
     *
     * @return array|null
     */
    public function getAccessToken($tokenOnly = true, $nocache = false) {
        $myTokenInfo = NULL;
        $appid       = $this->_appid;
        $appsecret   = $this->_appsecret;

        if ($nocache || empty(self::$_accessTokenCache[$appid])) {
            self::$_accessTokenCache[$appid] = $this->getToken($appid);
        }
		
        if (!empty(self::$_accessTokenCache[$appid])) {
            $myTokenInfo = self::$_accessTokenCache[$appid];
			
            if (isset($myTokenInfo['expiration']) && time() < $myTokenInfo['expiration']) {
                return $tokenOnly ? $myTokenInfo['token'] : $myTokenInfo;
            }
        }
        
        $url  = self::$_URL_API_ROOT."/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        $json = WebUtil::get($url);
        $res  = json_decode($json, TRUE);

        if (self::checkIsSuc($res)) {
            $expire  = time() + (int) $res['expires_in'] - 3600;
            self::$_accessTokenCache[$appid] = $myTokenInfo = array(
                'token'       => $res['access_token']
                // avoid clock miss to up one hour 
                ,'expiration' => $expire
            );
            $this->setToken($appid, $res['access_token'], intval($expire));
        }

        return $tokenOnly ? $myTokenInfo['token'] : $myTokenInfo;
    }
    
    public function getJsApiTicket($ticketOnly = true) {
    	$myTicketInfo = NULL;
        $appid       = $this->_appid;
        $appsecret   = $this->_appsecret;
        
        if (empty(self::$_jsapiTicketCache[$appid])) {
            self::$_jsapiTicketCache[$appid] = $this->getTicket($appid);
        }
        
        if (!empty(self::$_jsapiTicketCache[$appid])) {
            $myTicketInfo = self::$_jsapiTicketCache[$appid];

            if (time() < $myTicketInfo['expiration']) {
                return $ticketOnly ? $myTicketInfo['ticket'] : $myTicketInfo;
            }
        }
        
        $access_token = $this->getAccessToken();
        $url          = self::$_URL_API_ROOT."/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi";
        
        $json = WebUtil::get($url);
        $res  = json_decode($json, TRUE);
        
        if (self::checkIsSuc($res)) {
            $expire  = time() + (int)$res['expires_in'] - 3600;
            self::$_jsapiTicketCache[$appid] = $myTicketInfo = array(
                'ticket'      => $res['ticket']
                // avoid clock miss to up one hour 
                ,'expiration' => $expire
            );
            $this->setTicket($appid, $res['ticket'], intval($expire));
        }

        return $ticketOnly ? $myTicketInfo['ticket'] : $myTicketInfo;
    }
    
    /**
     * 1、用户同意授权，获取code。
     *
     * @param        $redirect_uri
     * @param string $state
     * @param string $scope
     *
     * @return string
     */
    public function getOAuthConnectUri($redirect_uri, $state = '', $scope = 'snsapi_base') {
        $redirect_uri = urlencode($redirect_uri);
        
		$url  = self::$_URL_OP_ROOT.'/connect/oauth2/authorize?';
		$url .= 'appid='.$this->_appid;
		$url .= '&redirect_uri='.$redirect_uri;
		$url .= '&response_type=code';
		$url .= '&scope='.$scope;
		$url .= '&state='.$state.'#wechat_redirect';
		
        return $url;
    }
    
    /**
     * 2、通过code换取网页授权access_token
     *
     * @param $code
     *
     * @return mixed
     */
    public function getAccessTokenByCode($code) {
        $url  = self::$_URL_API_ROOT."/sns/oauth2/access_token?";
        $url .= 'appid='.$this->_appid;
        $url .= '&secret='.$this->_appsecret;
        $url .= '&code='.$code;
        $url .= '&grant_type=authorization_code';
        
        $rtn = WebUtil::get($url);
        $res = json_decode($rtn, TRUE);
        return $res;
    }
    
    /**
     * 4、拉取用户信息(需scope为 snsapi_userinfo)
     *
     * @param        $access_token
     * @param        $openid
     * @param string $lang
     *
     * @return mixed
     */
    public function getUserInfoByAuth($access_token, $openid, $lang = 'zh_CN') {
        $url = self::$_URL_API_ROOT."/sns/userinfo?";
        $url .= 'access_token='.$access_token;
        $url .= '&openid='.$openid;
        $url .= '&lang='.$lang;
        
        $rtn = WebUtil::get($url);
//        \Think\Log::write($rtn);
        $res = json_decode($rtn, TRUE);
        return $res;
    }
    
    public function getUserInfo($openid, $lang = 'zh_CN') {
    	$url = self::$_URL_API_ROOT."/cgi-bin/user/info?";
        $url .= 'access_token='.$this->getAccessToken();
        $url .= '&openid='.$openid;
        $url .= '&lang='.$lang;
        
        $res = json_decode(WebUtil::get($url), TRUE);
        return $this->fetchData($res);
    }
    
    public function getJsApiSign($url) {
    	$noncestr = EncryptionManage::randomPass(12);
        $jsapi_ticket = $this->getJsApiTicket();
        $timestamp = time();

        $string1 = sprintf('jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s', $jsapi_ticket, $noncestr, $timestamp, $url);
        $signature = sha1($string1);

        return array($noncestr, $timestamp, $signature);
    }
    
    public function addMenu($menuData) {
    	$rtnData = array();
    	
    	if (!empty($menuData) && is_string($menuData)) {
    		$access_token = $this->getAccessToken();
        	$url          = self::$_URL_API_ROOT."/cgi-bin/menu/create?access_token=".$access_token;
        	
        	$rtnData = json_decode(WebUtil::post($url, $menuData), TRUE);
    	}
        
        return $this->fetchData($rtnData);
    }
    
    public function getIndustry() {
    	$url = self::$_URL_API_ROOT."/cgi-bin/template/get_industry?";
        $url .= 'access_token='.$this->getAccessToken();
        
        $res = json_decode(WebUtil::get($url), TRUE);
        return $this->fetchData($res);
    }
    
    public function setIndustry($id1, $id2) {
    	$rtnData = array();
    	
    	if (!empty($id1) && !empty($id2)) {
    		$access_token = $this->getAccessToken();
        	$url          = self::$_URL_API_ROOT."/cgi-bin/template/api_set_industry?access_token=".$access_token;
        	$idData  = "{";
        	$idData .= '"industry_id1":"'.$id1.'"';
        	$idData .= ',"industry_id2":"'.$id2.'"';
        	$idData .= "}";
        	
        	$rtnData = json_decode(WebUtil::post($url, $idData), TRUE);
    	}
        
        return $this->fetchData($rtnData);
    }
    
    public function getAllTemplate() {
    	$url = self::$_URL_API_ROOT."/cgi-bin/template/get_all_private_template?";
        $url .= 'access_token='.$this->getAccessToken();
        
        $res = json_decode(WebUtil::get($url), TRUE);
        return $this->fetchData($res);
    }
    
    public function sendTemplate($temp) {
    	$rtnData = array();
    	
    	if (!empty($temp) && is_string($temp)) {
    		$access_token = $this->getAccessToken();
        	$url          = self::$_URL_API_ROOT."/cgi-bin/message/template/send?access_token=".$access_token;
        	$rtn          = WebUtil::post($url, $temp);
        	
        	$rtnData = json_decode($rtn, TRUE);
    	}
        
        return $this->fetchData($rtnData);
    }
    
    private function fetchData($rtnData) {
    	if (!empty($rtnData) && is_array($rtnData)) {
    		if (isset($rtnData["errcode"])) {
	    		$rtnData["errmsg"] = isset(self::$ERRCODE_MAP[$rtnData["errcode"]]) ? self::$ERRCODE_MAP[$rtnData["errcode"]] : $rtnData["errmsg"];
	    	}
    	}
    	
    	return $rtnData;
    }
	
}
?>