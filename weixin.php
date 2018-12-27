<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG', true);

// 定义应用目录
define('APP_NAME', 'weixin');
define('APP_PATH','./weixin/');
define('SERVER_NAME', $_SERVER["SERVER_NAME"]);

/**
 * 系统默认资源
 */
//define('SERVER_RESOURCE', 'http://'.$_SERVER['HTTP_HOST']); // 120.25.165.160
define('SERVER_RESOURCE', '');
//define('SERVER_RESOURCE', 'http://admin2.test.leskymob.com');  // 120.24.57.190

define('ON_LINE', true);
if (defined('SERVER_RESOURCE')) {
	define('SERVER_PARTNAME', '');
} else {
	define('SERVER_PARTNAME', APP_NAME.'.php/');
}

define("SYS_NAME", "后台管理系统");
/**
 * 设置系统操作模式
 * 整体刷新: 1
 * 局部刷新: 2
 * 默认: 整体刷新
 */
define('SYS_OPT_MODE', '2');
define('LOCAL_REFRESH_HOMEPAGE', 'Home/Menu/index');

define("COM_NAME", "乐天互动");
define("COM_FULL_NAME", "深圳乐天互动科技有限公司");

define("R_SYS_NAME", "mor_weixin_");
define("R_SYS_MENU_START", "后台管理");

// 引入ThinkPHP入口文件
require dirname(__FILE__).'/ThinkPHP/ThinkPHP.php';
// 亲^_^ 后面不需要任何代码了 就是如此简单