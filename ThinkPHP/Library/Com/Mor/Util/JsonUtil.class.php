<?php
namespace Com\Mor\Util;
use Com\Mor\Util\ModeUtil;

/**
 * Copyright (C), 2015-2016, Lesky tech. Co., Ltd.
 * FileName: JsonUtil.class.php
 * Summary:  Json工具
 * @author   Yan Zheng
 * @Date     2016/6/5
 * @version  1.0.0
 */
class JsonUtil {
	/** 全局返回常量定义 */
	const RET_JUMP_TO_START         = 'return array("-99" => "跳转到初始界面");';    // 跳转到初始界面
	const RET_SYSTEM_BUSY           = 'return array("-1" => "系统繁忙，请重新再试");';     // 系统繁忙，请重新再试
	const RET_SUCC                  = 'return array("1" => "请求成功");';      // 请求成功
	const RET_APPID_NOTEXIST        = 10001;  // appid为空，请初始化
	const RET_PARSE_RTNERR          = 10002;  // 解析返回出错
	const RET_FILE_UPLOAD_ERR       = 10003;  // 上传文件出错
	const RET_FILE_UPLOAD_FAIL      = 10004;  // 文件上传失败
	const RET_FILE_MAX_10M          = 10005;  // 文件大小超过10M
	const RET_UPFILE_NOTEXIST       = 10006;  // 上传文件不存在
	const RET_PARAM_NOTNULL         = 'return array("10007" => "参数 : %s 不能为空");';  // 参数不能为空
	const RET_FORMAT_NOTCORRECT     = 'return array("10008" => "参数 : %s 格式不正确, 应符合 : %s");';  // 格式不正确
	const RET_REGIST_FAILURE        = 10009;  // 注册失败，请重新再注册
	const RET_ACCESS_TOKEN_INVALID  = 10010;  // access token无效
	const RET_PARAM_ERR             = 'return array("10011" => "参数 : %s 错误");';  // 参数错误
	const RET_USER_NOT_CERTIFIED    = 10012;  // 该用户未认证
	const RET_MESSAGE_SENDED        = 'return array("10013" => "短信已发送至手机");';  // 验证短信已发送至手机
	const RET_VALIDATE_FAILURE      = 10014;  // 验证失败
	const RET_MESSAGE_EXPIRED       = 'return array("10015" => "验证短信已过期");';  // 验证短信已过期
	const RET_ALLOW_CODE_INVALID    = 'return array("10016" => "验证码已失效");'; // allow code失效
	const RET_ALLOW_CODE_SENDED     = 10017;  // allow code已发送
	const RET_USER_REGISTED         = 'return array("10018" => "该用户 : %s 已经注册");';  // 该用户已经注册
	const RET_USER_NOT_EXIST        = 'return array("10019" => "该用户 : %s 不存在");';  // 该用户不存在
	const RET_INCORRECT_DATA        = 10020;  // 资料不正确
	const RET_USER_NOT_ACCREDIT     = 10021;  // 用户未授权
	const RET_NO_DATA               = 10022;  // 没有任何数据
	const RET_CONCERNED             = 10023;  // 已关注
	const RET_UNCONCERNED           = 10024;  // 已取消关注
	const RET_BLACKED               = 10025;  // 已拉黑
	const RET_UNBLACKED             = 10026;  // 已取消拉黑
	const RET_COLLECTED             = 10027;  // 已收藏
	const RET_UNCOLLECTED           = 10028;  // 已取消收藏
	const RET_DYNAMICDEL            = 10029;  // 动态已关闭
	const RET_PICFILLED             = 10030;  // 相册已满
	const RET_BALANCE_NOT_ENOUGH    = 10031;  // 余额不足
	const RET_ORDER_NOT_FOUNDED     = 10032;  // 找不到对应的订单
	const RET_VIOL_MIN_RULES        = 10033;  // 违反最少规则
	const RET_VIOL_GAMES_RULES      = 'return array("10034" => "违反游戏规则 : %s");';  // 违反游戏规则
	const RET_OVERTIME              = 10035;  // 已超时
	const RET_NOT_ENOUGH_TO_PAY     = 10036;  // 不足以支付
	const RET_ORDER_CREATIE_FAILED  = 10037;  // 订单创建失败
	const RET_OPERATION_FAILED      = 'return array("10038" => "操作失败");';  // 操作失败
	const RET_PRAISED               = 10039;  // 已点赞
	const RET_UNPRAISED             = 10040;  // 已取消点赞
	const RET_TREADED               = 10041;  // 已踩
	const RET_UNTREADED             = 10042;  // 已取消踩
	const RET_NOT_CONCERN_SELF      = 10043;  // 不能关注自己
	const RET_NOT_REWARD_SELF       = 10044;  // 不能打赏自己
	const RET_REWARDED              = 10045;  // 已打赏
	const RET_NOT_IN_LIST           = 10046;  // 用户不在当前列表中
	const RET_NOT_BLACK_SELF        = 10047;  // 不能拉黑自己
	const RET_USER_HAS_CERTIFIED    = 10048;  // 用户已认证
	const RET_USER_IN_CERTIFIED     = 10049;  // 用户认证中
	const RET_PARAMS_NOT_ALLNULL    = 10050;  // 参数不能全部为空
	const RET_LABEL_TOO_LONG        = 10051;  // 标签字数过多
	const RET_NOT_SYSTEM_LABEL      = 10052;  // 非系统标签
	const RET_LABEL_NUM_OVER        = 10053;  // 标签数量超过5个
	const RET_DYNAMIC_NOTCORRECT    = 10054;  // 动态类型不正确
	const RET_NOT_ENOUGH_TO_DOUBLE  = 10055;  // 不足以支付双倍
	const RET_EXCEEDED_OUTOF_PARTY  = 10056;  // 聚会确定人数已满
	const RET_RECORD_NOT_EXIST      = 10057;  // 记录不存在
	const RET_RECORD_NOT_MATCH      = 10058;  // 记录不匹配
	const RET_REWARD_NUM_NOT_MATCH  = 10059;  // 打赏金额少于设定值
	const RET_NOT_COMMENT 		    = 10060;  // 不能参与评论
	const RET_EXCEEDED_RATED_NUM    = 10061;  // 已超过额定人数
	const RET_CONFIRMED_CANT_CANCEL = 10062;  // 已确认聚会人员，该聚会不能取消
	const RET_CONFIRMED_DEAD_OVER   = 10063;  // 已超过聚会确认名单时间
	const RET_PARTY_UNDER_WAY       = 10064;  // 聚会进行中
	const RET_MESSAGE_IS_READ       = 10065;  // 消息已读
	const RET_DYNAMIC_PAST_TOP      = 10066;  // 动态已经置顶
	const RET_DYNAMIC_CANCEL_TOP    = 10067;  // 动态已经取消置顶
	const RET_NOT_REPORT_OWN        = 10068;  // 不能举报自己
	const RET_NOT_REPORT_DYNAMIC    = 10069;  // 不能举报自己的动态
	const RET_NOT_CHART_SELF        = 10070;  // 目标用户与自己不能相同
	const RET_PARAM_NOT_NEED        = 10071;  // 参数不需要
	const RET_NOT_CHOOSE_LABEL      = 10072;  // 包含未选择的标签
	const RET_BELONG_TO_SYS_LABEL   = 10073;  // 自定义中包含系统标签
	const RET_PARTY_HAS_CANCEL      = 10074;  // 聚会已取消
	const RET_PARTY_HAS_END         = 10075;  // 聚会已结束
	const RET_PARTY_THREE_SIGN_UP   = 10076;  // 同一次聚会报名不得超过3次
	const RET_JOINNOT_SELF_PARTY    = 10077;  // 不能参加自己聚会的报名
	const RET_ALREADY_JOIN_PARTY    = 10078;  // 已经报名了聚会
	const RET_CANNOT_CANCEL_PARTY   = 10079;  // 已经不能取消聚会了
	const RET_WDINFO_NOT_MATCH      = 10080;  // 提现资料匹配不正确
	const RET_HAS_BEEN_BLACKED      = 10081;  // 已被拉黑
	const RET_CONTAIN_ERROR_WORDS   = 10082;  // 包含敏感词汇
	const RET_FILE_UPLOAD_ERROR     = 'return array("10083" => "文件上传失败");';  // 文件上传失败
	const RET_USER_NOT_TYPE    		= 'return array("10084" => "用户未激活");';  // 用户未激活
	const RET_USER_OK_TYPE    		= 'return array("10085" => "用户已激活");';  // 用户已激活
	const RET_SAME_RECORD           = 'return array("10086" => "存在相同的记录");'; // 存在相同的记录
	const RET_MESSAGE_SENDED_TIMES  = 'return array("10087" => "您一个小时内只能接收三次短信");'; // 您一个小时内只能接收三次短信
	// 后台用异常
	const RET_PASS_NOT_CORRECT      = 'return array("10101" => "用户 : %s 密码不正确");';  // 密码不正确
	const RET_CANOT_FIND_ID         = 'return array("10102" => "找不到对应的ID : %s");';  // 找不到对应的ID
	const RET_VALUE_EXISTS          = 'return array("10103" => "已存在对应的值 : %s");';  // 已存在对应的值
	const RET_ACCOUNT_VALIDATING    = 10104;  // 账户已在验证中
	const RET_BATCH_NO_NOT_FOUND    = 10105;  // 批量订单号找不到，没法执行下去
	const RET_AD_INFO_REPEAT        = 10106;  // 广告数据重复
	const RET_CONTAIN_ILLEGAL_IMAGE = 10107;  // 包含敏感图片
	const RET_OBJECT_CREATE_ERROR   = 'return array("10108" => "对象 : %s 创建失败");';  // 对象创建失败
	const RET_VERSION_NOT_MATCH     = 'return array("10109" => "数据已过期");';  // 数据已过期
	const RET_ADMIN_VALUE_EXISTS    = 'return array("10110" => "已经存在管理员账户");';  // 已经存在管理员账户
	
	private static function _response($body) {
		if (!empty($body)) {
			$body = json_encode($body);
			
			if (isset($_GET["callback"])) {
				$body = $_GET['callback']."(".$body.")";
			}
			
			echo $body;
//			\Think\Log::write("json: ".$body, "ERR");
			exit();
		}
	}
	
	private static function fetch($data) {
		$arrData = array();
		
		if (!empty($data) && is_array($data)) {
			foreach ($data as $k => $d) {
				$arrData[] = $d;
			}
		}
		
		return $arrData;
	}
	
	public static function rewrite($retCode) {
		if (!empty($retCode)) {
			$args    = func_get_args();
			$retCode = eval($retCode);
			
			if (is_array($retCode)) {
				unset($args[0]);
				$key = array_keys($retCode)[0];
				
				if (sizeof($args) === 1) {
					$retCode = sprintf($retCode[$key], $args[1]);
				} else if (sizeof($args) === 2) {
					$retCode = sprintf($retCode[$key], $args[1], $args[2]);
				}
			}
		}
		
		return $retCode;
	}
	
	public static function response($retCode, $data = array()) {
		if (!empty($retCode)) {
			$arr     = array();
			$args    = func_get_args();
			$blnOld  = false;
			$retCode = eval($retCode);
			
			if (is_array($retCode)) {
				unset($args[0]);
				unset($args[1]);
				$key = array_keys($retCode)[0];
				$arr[JSON_RETCODE] = $key;
				
				if (sizeof($args) === 0) {
					$arr[JSON_MSG] = $retCode[$key];
				} else if (sizeof($args) === 1) {
					$arr[JSON_MSG] = sprintf($retCode[$key], $args[2]);
				} else if (sizeof($args) === 2) {
					$arr[JSON_MSG] = sprintf($retCode[$key], $args[2], $args[3]);
				}
			} else if (is_string($retCode)) {
				$arr[JSON_RETCODE] = $retCode;
				$blnOld = true;
			}
			
			if (ModeUtil::isDebug() === true && $blnOld === true) {
				$message = "";
				
				switch($retCode) {
					case self::RET_SYSTEM_BUSY:
						$message = "The system is busy, please try again";
						break;
					case self::RET_SUCC:
						$message = "Request success";
						break;
					case self::RET_PARAM_NOTNULL:
						$message = "Parameters ".$fieldName." cannot be empty";
						break;
					case self::RET_FORMAT_NOTCORRECT:
						$message = "The Parameters ".$fieldName." format is not correct, please refer to : ".$format;
						break;
					case self::RET_ACCESS_TOKEN_INVALID:
						$message = "Access token invalid";
						break;
					case self::RET_PARAM_ERR:
						$message = "Parameter ".$fieldName." error";
						break;
					case self::RET_USER_NOT_CERTIFIED:
						$message = "This user has not been authenticated";
						break;
					case self::RET_USER_NOT_EXIST:
						$message = "The user ".$fieldName." does not exist";
						break;
					case self::RET_INCORRECT_DATA:
						$message = "Incorrect data : ".$fieldName;
						break;
					case self::RET_USER_NOT_ACCREDIT:
						$message = "User not authorized";
						break;
					case self::RET_NO_DATA:
						$message = "No data";
						break;
					case self::RET_CONCERNED:
						$message = "Already concerned";
						break;
					case self::RET_UNCONCERNED:
						$message = "Has been canceled attention";
						break;
					case self::RET_BLACKED:
						$message = "Has been pulled black";
						break;
					case self::RET_UNBLACKED:
						$message = "Has been canceled pull black";
						break;
					case self::RET_COLLECTED:
						$message = "Already collect";
						break;
					case self::RET_UNCOLLECTED:
						$message = "Has been canceled collection";
						break;
					case self::RET_DYNAMICDEL:
						$message = "Dynamic shutdown";
						break;
					case self::RET_PICFILLED:
						$message = "The photo album is full";
						break;
					case self::RET_BALANCE_NOT_ENOUGH:
						$message = "Sorry, your balance ".$fieldName." is running low";
						break;
					case self::RET_ORDER_NOT_FOUNDED:
						$message = "Could not find the corresponding order : ".$fieldName;
						break;
					case self::RET_VIOL_MIN_RULES:
						$message = "Parameter ".$fieldName." violation of minimum rules : ".$format;
						break;
					case self::RET_VIOL_GAMES_RULES:
						$message = "Violate the rules of the game : ".$fieldName;
						break;
					case self::RET_OVERTIME:
						$message = $fieldName." has timed out";
						break;
					case self::RET_NOT_ENOUGH_TO_PAY:
						$message = "Not enough to pay";
						break;
					case self::RET_ORDER_CREATIE_FAILED:
						$message = "Order create failed";
						break;
					case self::RET_OPERATION_FAILED:
						$message = "Operation failed";
						break;
					case self::RET_PRAISED:
						$message = "Has been praised";
						break;
					case self::RET_UNPRAISED:
						$message = "Has been cancel praised";
						break;
					case self::RET_TREADED:
						$message = "Has been treaded";
						break;
					case self::RET_UNTREADED:
						$message = "Has been cancel treaded";
						break;
					case self::RET_NOT_CONCERN_SELF:
						$message = "Can not concern yourself";
						break;
					case self::RET_NOT_REWARD_SELF:
						$message = "Can not reward yourself";
						break;
					case self::RET_REWARDED:
						$message = "Has been rewarded";
						break;
					case self::RET_NOT_IN_LIST:
						$message = "Data not in list";
						break;
					case self::RET_NOT_BLACK_SELF:
						$message = "Can not blacked yourself";
						break;
					case self::RET_USER_HAS_CERTIFIED:
						$message = "User has been certificated";
						break;
					case self::RET_USER_IN_CERTIFIED:
						$message = "User is in certificating";
						break;
					case self::RET_PARAMS_NOT_ALLNULL:
						$message = "Parameters ".$fieldName." cannot be all empty";
						break;
					case self::RET_LABEL_TOO_LONG:
						$message = "Single label has been allowed at more five words";
						break;
					case self::RET_NOT_SYSTEM_LABEL:
						$message = "The ".$fieldName." is not belong to system label";
						break;
					case self::RET_LABEL_NUM_OVER:
						$message = "Label num is no more than five";
						break;
					case self::RET_DYNAMIC_NOTCORRECT:
						$message = "Dynamic type is not correct";
						break;
					case self::RET_NOT_ENOUGH_TO_DOUBLE:
						$message = "Your's balance ".$fieldName." is not enough to pay the order : ".$format;
						break;
					case self::RET_EXCEEDED_OUTOF_PARTY:
						$message = "The party is sure that the number is full";
						break;
					case self::RET_RECORD_NOT_EXIST:
						$message = "The record is not exist";
						break;
					case self::RET_RECORD_NOT_MATCH:
						$message = "The record is not match";
						break;
					case self::RET_REWARD_NUM_NOT_MATCH:
						$message = "The reward num is less than default value";
						break;
					case self::RET_NOT_COMMENT:
						$message = "Can not participate in the comments : ".$format;
						break;
					case self::RET_EXCEEDED_RATED_NUM:
						$message = "Has exceeded the rated number";
						break;
					case self::RET_CONFIRMED_CANT_CANCEL:
						$message = "Has confirmed the party, the party can not be canceled";
						break;
					case self::RET_CONFIRMED_DEAD_OVER:
						$message = "Has been more than the party to confirm the list of time";
						break;
					case self::RET_PARTY_UNDER_WAY:
						$message = "The party is in progress";
						break;
					case self::RET_MESSAGE_IS_READ:
						$message = "The message is has read";
						break;
					case self::RET_DYNAMIC_PAST_TOP:
						$message = "The dynamic is in Top";
						break;
					case self::RET_DYNAMIC_CANCEL_TOP:
						$message = "Dynamic top has been canceled";
						break;
					case self::RET_NOT_REPORT_OWN:
						$message = "Can not report their own";
						break;
					case self::RET_NOT_REPORT_DYNAMIC:
						$message = "Can not report their own dynamics";
						break;
					case self::RET_NOT_CHART_SELF:
						$message = "Targetuser can not equal to self";
						break;
					case self::RET_PARAM_NOT_NEED:
						$message = "Parameter ".$fieldName." does not need";
						break;
					case self::RET_NOT_CHOOSE_LABEL:
						$message = "Contains not choose label";
						break;
					case self::RET_BELONG_TO_SYS_LABEL:
						$message = "Self definition can not contains system label";
						break;
					case self::RET_PARTY_HAS_CANCEL:
						$message = "Party has cancel";
						break;
					case self::RET_PARTY_HAS_END:
						$message = "Party has end";
						break;
					case self::RET_PARTY_THREE_SIGN_UP:
						$message = "The same party can not sign up more than 3 times";
						break;
					case self::RET_JOINNOT_SELF_PARTY:
						$message = "Own can not participate in the party order";
						break;
					case self::RET_ALREADY_JOIN_PARTY:
						$message = "Has been reported to the name";
						break;
					case self::RET_CANNOT_CANCEL_PARTY:
						$message = $fieldName." hours before the party can't be canceled";
						break;
					case self::RET_WDINFO_NOT_MATCH:
						$message = "The withdraw info ".$fieldName." is not correct";
						break;
					case self::RET_HAS_BEEN_BLACKED:
						$message = "Has been blacked by targetuser";
						break;
					case self::RET_CONTAIN_ERROR_WORDS:
						$message = "text contain sensitive words";
						break;
					// 后台用异常
					case self::RET_PASS_NOT_CORRECT:
						$message = "Incorrect ".$fieldName."'s password";
						break;
					case self::RET_CANOT_FIND_ID:
						$message = "Can not find the corresponding ID : ".$fieldName;
						break;
					case self::RET_VALUE_EXISTS:
						$message = "Corresponding value already exists : ".$fieldName;
						break;
					case self::RET_ACCOUNT_VALIDATING:
						$message = "User ".$fieldName." 's account has been verified";
						break;
					case self::RET_BATCH_NO_NOT_FOUND:
						$message = "The order : ".$fieldName." 's batch order number can not find, can not be carried out";
						break;
					case self::RET_AD_INFO_REPEAT:
						$message = "advertisement data id repeat";
						break;
					case self::RET_CONTAIN_ILLEGAL_IMAGE:
						$message = "contain illegal image";
						break;
					default :
						break;
				}
				
				if (!empty($message)) {
					$arr[JSON_MSG] = $message;
				}
			}
			
			if (!empty($data)) {
				if (is_array($data)) {
					foreach ($data as $k => $d) {
						$arr[$k] = $d;
					}
				} else if (is_string($data)) {
					$arr[JSON_DATA] = $data;
				}
			}
			
			self::_response($arr);
		}
	}
	
	public static function hasError($json) {
		$bln = false;
		
		if (!empty($json)) {
			if (is_string($json)) {
				$json = json_decode($json, true);
			}
			if (is_array($json) && isset($json[JSON_RETCODE])) {
				$bln = intval($json[JSON_RETCODE]) != self::RET_SUCC;
			}
		}
		
		return $bln;
	}
	
	public static function getMsg($json) {
		$msg = "";
		
		if (!empty($json)) {
			if (is_string($json)) {
				$json = json_decode($json, true);
			}
			if (is_array($json) && isset($json[JSON_MSG])) {
				$msg = $json[JSON_MSG];
			}
		}
		
		return $msg;
	}
	
	public static function getData($json) {
		$data = "";
		
		if (!empty($json)) {
			if (is_string($json)) {
				$json = json_decode($json, true);
			}
			if (is_array($json) && isset($json[JSON_DATA])) {
				$data = $json[JSON_DATA];
			}
		}
		
		return $data;
	}
	
	public static function decode($json) {
		if (!empty($json)) {
			if (is_string($json)) {
				$json = json_decode($json, true);
			}
		}
		
		return $json;
	}
	
	// 解析错误code
	public static function retErrCode($json) {
		$code = self::RET_SYSTEM_BUSY;
		
		if (!empty($json) && self::hasError($json)) {
			if (ModeUtil::isDebug() === true) {
				$transJson = self::decode($json);
				
				if (intval($transJson[JSON_RETCODE]) === self::RET_NO_DATA) {
					self::response(self::RET_SUCC);
				} else {
					echo $json;
				}
				
				exit();
			} else {
				$json = self::decode($json);
			
				if (!empty($json) && is_array($json)) {
					$reCode = intval($json[JSON_RETCODE]);
					
					if ($reCode === self::RET_PARAM_NOTNULL) {
						$code = self::RET_PARAM_NOTNULL;
					} else if ($reCode === self::RET_FORMAT_NOTCORRECT) {
						$code = self::RET_FORMAT_NOTCORRECT;
					} else if ($reCode === self::RET_VIOL_MIN_RULES) {
						$code = self::RET_VIOL_MIN_RULES;
					} else if ($reCode === self::RET_OVERTIME) {
						$code = self::RET_OVERTIME;
					}
				}
			}
		}
		
		self::response($code);
	}
	
}
?>