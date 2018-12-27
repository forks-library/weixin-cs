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
<section class="main-container" style="padding-top:3.5rem; padding-bottom:7.5rem; font-size:0px;">
	<!-- 头部 -->
	<div class="pages-header width100">
		<img class="cf-icon-logo" src="/dgcs_wx/Public/images/cf-icon-logo.png" alt="">
	</div>
	<!-- banner图 -->
	<div class="index-banner relative swipe">
		<div class="index-banner-list swipe-wrap"></div>
		<div class="detail-banner-num"></div>
	</div>
	<!-- 善款处理状况 -->
	<ul class="donation-fund">
		<li>
			<div class="text-center color-white size-s charity-fund-son"><span class="color-white"><?php if (isset($amounts) && isset($amounts["tAmount"]) && !empty($amounts["tAmount"])) { echo $amounts["tAmount"]; } else { echo "-"; } ?></span>元</div>
			<div class="text-center color-white size-l charity-fund-son">善款收入</div>
		</li>
		<li>
			<div class="text-center color-white size-s charity-fund-son"><span class="color-white"><?php if (isset($amounts) && isset($amounts["eAmount"]) && !empty($amounts["eAmount"])) { echo $amounts["eAmount"]; } else { echo "-"; } ?></span>元</div>
			<div class="text-center color-white size-l charity-fund-son">善款支出</div>
		</li>
		<li>
			<div class="text-center color-white size-s charity-fund-son"><span class="color-white"><?php if (isset($amounts) && isset($amounts["lAmount"]) && !empty($amounts["lAmount"])) { echo $amounts["lAmount"]; } else { echo "-"; } ?></span>元</div>
			<div class="text-center color-white size-l charity-fund-son">善款结余</div>
		</li>
	</ul>
	<!-- 其他导航 -->
	<ul class="other-nav">
		<li class="aclick-btn width25" data-url="et.redirect(et.url('info/aboutus/index'));">
			<div class="other-nav-img width100">
				<img src="/dgcs_wx/Public/images/cf-icon-aboutme.png" alt="">
			</div>
			<div class="other-nav-txt text-center">关于我们</div>
		</li>
		<?php if (isset($topHelpType) && is_array($topHelpType)): ?>
		<li class="aclick-btn width25 other-nav-special" data-url="et.redirect(et.url('user/donation/detail', {no: '<?php echo $topHelpType['code']; ?>'}));">
			<div class="other-nav-img width100">
				<img src="/dgcs_wx/Public/images/cf-icon-hpd.png" alt="">
			</div>
			<div class="other-nav-txt text-center ellipsis_two"><?php echo $topHelpType['title']; ?></div>
		</li>
		<?php endif; ?>
		<li class="aclick-btn width25" data-url="et.redirect(et.url('user/donation/index'));">
			<div class="other-nav-img width100">
				<img src="/dgcs_wx/Public/images/cf-icon-iwd.png" alt="">
			</div>
			<div class="other-nav-txt text-center">我要捐</div>
		</li>
		<li class="aclick-btn width25" data-url="et.redirect(et.url('user/needhelp/index'));">
			<div class="other-nav-img width100">
				<img src="/dgcs_wx/Public/images/cf-icon-inh.png" alt="">
			</div>
			<div class="other-nav-txt text-center">我要求助</div>
		</li>
		<li class="aclick-btn width25" data-url="et.redirect(et.url('home/activity/index'));">
			<div class="other-nav-img width100">
				<img src="/dgcs_wx/Public/images/cf-icon-caa.png" alt="">
			</div>
			<div class="other-nav-txt text-center">慈善活动申请</div>
		</li>
		<li class="width25 aclick-btn" data-url="et.redirect(et.url('user/volunteer/index'));">
			<div class="other-nav-img width100">
				<img src="/dgcs_wx/Public/images/cf-icon-volunteer.png" alt="">
			</div>
			<div class="other-nav-txt text-center">志愿者服务</div>
		</li>
		<li class="aclick-btn width25" data-url="et.redirect(et.url('info/paybill/index'));">
			<div class="other-nav-img width100">
				<img src="/dgcs_wx/Public/images/cf-icon-ptb.png" alt="">
			</div>
			<div class="other-nav-txt text-center">晒账单</div>
		</li>
		<li class="aclick-btn width25" data-url="et.redirect(et.url('info/helpdata/index'));">
			<div class="other-nav-img width100">
				<img src="/dgcs_wx/Public/images/cf-icon-helpdata.png" alt="">
			</div>
			<div class="other-nav-txt text-center">求助数据查询</div>
		</li>
	</ul>
	<!-- 底部广告图 -->
	<div class="footer-banner width100">
	</div>
</section>
<!-- 底部按钮 -->
<?php if(isset($menu)): ?>
<div class="nav-footer">
	<ul>
		<li class="text-center float-left width50">
			<div class="aclick-btn footer-item inline-block <?php if($menu === 'homepage'): ?>active<?php endif; ?>" data-url="et.redirect(et.url('home/index/index'));">
				<i class="cf-icon-home"></i>
				<div class="footer-item-text">首页</div>
			</div>
		</li>
		<li class="text-center float-left width50">
			<div class="aclick-btn footer-item inline-block <?php if($menu === 'mepage'): ?>active<?php endif; ?>" data-url="et.redirect(et.url('user/me/index'));">
				<i class="cf-icon-me"></i>
				<div class="footer-item-text">我的</div>
			</div>
		</li>
	</ul>
</div>
<?php endif; ?>
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
	window._wxAuthUrl = "<?php echo urlencode(base64_encode(U('/dgcs_wx/weixin.php/home/index/index?id=ot7VhxPwYRRkgGu3CUiXASCYo4k0'))); ?>";
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