<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/dgcs_wx/Public/css/base.css" />
	<?php if (isset($handyType) && !empty($handyType)): ?>
	<?php if ($handyType === 'ios') { ?>
	<link rel="stylesheet" type="text/css" href="/dgcs_wx/Public/css/cfm-new-ios.css" />
	<?php } else if ($handyType === 'and') { ?>
	<link rel="stylesheet" type="text/css" href="/dgcs_wx/Public/css/cfm-new-and.css" />
	<?php } else { ?>
	<link rel="stylesheet" type="text/css" href="/dgcs_wx/Public/css/cfm-new.css" />
	<?php } ?>
	<?php endif; ?>
</head>
<body>
<script type="text/javascript">
var timestamp = Date.parse(new Date()) / 100;
var html = '';
html += '<div class="init-page-loading masking-page" data-time="' + timestamp + '">';
html += '<div class="middle-loading">';
html += '<div class="loding-font size-s text-center">正在努力加载中，请稍后~</div>';
html += '<i class="icon-loading"></i>';
html += '</div>';
html += '</div>';
document.write(html);
</script>
<input type="hidden" class="optarget" value="<?php if (isset($html_target) && !empty($html_target)) : echo $html_target; endif; ?>" />
<input type="hidden" class="id" value="<?php if (isset($id) && !empty($id)) : echo $id; endif; ?>" />
<input type="hidden" class="token" value="<?php if (isset($token) && !empty($token)) : echo $token; endif; ?>" />
<input type="hidden" class="logined" value="<?php if (isset($logined) && !empty($logined)) : echo $logined; endif; ?>" />
<input type="hidden" class="backUrl" value="<?php if (isset($pageBack) && !empty($pageBack)) : echo $pageBack; endif; ?>" />
<input type="hidden" class="currUrl" value="<?php if (isset($currUrl) && !empty($currUrl)) : echo $currUrl; endif; ?>" />
<input type="hidden" class="fromUser" value="<?php if (isset($fromUser) && !empty($fromUser)) : echo $fromUser; endif; ?>" />
<input type="hidden" class="district" value="<?php if (isset($district) && !empty($district)) : echo $district; endif; ?>" />
<input type="hidden" class="isDebug" value="<?php if (isset($isDebug) && !empty($isDebug)) : echo $isDebug; endif; ?>" />
<!-- 没有数据时，隐藏封面 -->
<section class="main-container block" style="padding-top:3.5rem;padding-bottom:4rem; font-size:0px;">
	<!-- 头部 -->
	<div class="pages-header width100">
		<img class="cf-icon-logo" src="/dgcs_wx/Public/images/cf-icon-logo.png" alt="">
	</div>
	<!--标题-->
	<div class="article-title inline-block">
		<div class="article-title-txt">关于我们</div>
	</div>
	<!--列表内容-->
	<ul class="aboutme-list">
		<li class="aclick-btn ellipsis aboutme-bg-intro" data-url="et.redirect(et.url('info/aboutus/intro'));">机构简介</li>
		<li class="aclick-btn ellipsis aboutme-bg-statute" data-url="et.redirect(et.url('info/aboutus/statutelist'));">慈善法规</li>
		<li class="aclick-btn ellipsis aboutme-bg-project" data-url="et.redirect(et.url('info/aboutus/charitable'));">慈善项目</li>
		<li class="aclick-btn ellipsis aboutme-bg-dynamic" data-url="et.redirect(et.url('info/aboutus/dynamiclist'));">慈善动态</li>
		<!--li class="aclick-btn ellipsis aboutme-bg-news" data-url="et.redirect(et.url('info/aboutus/newslist'));">公益资讯</li-->
	</ul>
</section>
<!--等待加载-->

<!-- 底部按钮 -->
<!-- 底部按钮 -->
<div class="nav-footer">
	<ul>
		<li class="text-center float-left width33">
			<div class="aclick-btn footer-item inline-block" data-url="et.redirect(et.url('home/index/index'));">
				<i class="cf-icon-home"></i>
				<div class="footer-item-text">首页</div>
			</div>
		</li>
		<li class="text-center float-left width33">
			<!--弹出前-->
			<i class="cf-icon-select"></i>
			<!--点击弹出后-->
			<i class="cf-icon-select-click display-none"></i>
			<!--弹出的导航-->
			<div class="cf-foot-midnav cf-footother display-none">
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('info/helpdata/index'));">求助数据查询</div>
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('info/paybill/index'));">晒账单</div>
				<div class="aclick-btn cf-footother-son text-center">志愿者服务</div>
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('home/activity/index'));">慈善活动申请</div>
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('user/needhelp/index'));">我要求助</div>
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('user/donation/index'));">我要捐</div>
				<div class="aclick-btn cf-footother-son text-center">广东扶贫济困日</div>
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('info/aboutus/index'));">关于我们</div>
			</div>
		</li>
		<li class="text-center float-left width33">
			<div class="aclick-btn footer-item inline-block" data-url="et.redirect(et.url('user/me/index'));">
				<i class="cf-icon-me"></i>
				<div class="footer-item-text">我的</div>
			</div>
		</li>
	</ul>
</div>
<script type="text/javascript">
	// 重新配置
    window.isDebug    = <?php if (isset($isDebug)) { echo $isDebug; } ?>;
    window._jsrc      = "<?php if (isset($jsSrc)) { echo $jsSrc; } ?>";
    window._http      = "<?php echo (SERVER_NAME); ?>";
    window._root      = "/dgcs_wx";
    // window._root      = "";
    window._appName   = "<?php echo (SERVER_PARTNAME); ?>";
    window._home      = "/home";
    window._servUrl   = window._appName ? window._root + "/" + window._appName : '';
    window._publicUrl = window._appName ? "/dgcs_wx/Public" : "/Public";
    // 这两个配置可以写成默认值
    window._tempPath  = "template";
    window._tempBase  = "dgcswx";
    // 文件服务器地址
    window._fileServer      = "<?php echo GLOBAL_FILE_SERVER; ?>";
    window._imgvServer      = "<?php echo GLOBAL_IMGV_SERVER; ?>";
    window._imgServer       = "<?php echo GLOBAL_IMG_SERVER; ?>";
    window._imgRemoveServer = "<?php echo GLOBAL_IMG_DELETE; ?>";
    window._imgBindServer   = "<?php echo GLOBAL_IMG_BIND; ?>";
    window._imgInfoServer   = "<?php echo GLOBAL_IMG_INFO; ?>";
    window._imgServPath     = "<?php echo GLOBAL_IMG_PATH; ?>";
    // 微信授权
	window._wxAuthUrl = "<?php echo urlencode(base64_encode(U('/dgcs_wx/weixin.php/info/aboutus/index?id=ot7VhxPwYRRkgGu3CUiXASCYo4k0'))); ?>";
	window._wxShareUrl= "<?php if (isset($wxShareUrl)) { echo $wxShareUrl; } ?>";
	window._wxShrTitle= "<?php if (isset($wxShrTitle)) { echo $wxShrTitle; } ?>";
	window._wxShrDesc = "<?php if (isset($wxShrDesc)) { echo $wxShrDesc; } ?>";
	// 系统配置
	window._compCode = '<?php if(isset($compCode)): echo $compCode; endif; ?>';
</script>
<script type="text/javascript" src="<?php if (isset($jsSrc)) { echo $jsSrc; } ?>/require/2.1.14.min.js"></script>
<script type="text/javascript" src="<?php if (isset($jsSrc)) { echo $jsSrc; } ?>/config/require.config.wx-2.0.1.js"></script>
<?php if (isset($loadCommonJs) && $loadCommonJs === '1'): ?>
<script type="text/javascript" src="/dgcs_wx/Public/js/cs.js"></script>
<?php endif; ?>
<?php if (isset($pageJs) && !empty($pageJs)): ?>
<script type="text/javascript" src="/dgcs_wx/Public/js/<?php echo strtolower($pageJs); ?>.js"></script>
<?php endif; ?>
<script type="text/javascript" src="/dgcs_wx/Public/js/wxauth04.js"></script>
</body>
</html>