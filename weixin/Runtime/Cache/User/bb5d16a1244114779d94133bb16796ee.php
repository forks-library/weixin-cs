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
<section class="main-container block" style="padding-top:6.5rem;padding-bottom:7rem; font-size:0px;">
	<!-- 头部 -->
	<div class="pages-header width100">
		<img class="cf-icon-logo" src="/dgcs_wx/Public/images/cf-icon-logo.png" alt="">
	</div>
	<!--标题-->
	<div class="article-onetitle">
		<div class="article-onetitle-txt ellipsis">我要求助</div>
	</div>
	
	<div class="article-cont inline-block">
		<?php if ($showConf['name'] == 1){ ?>
		<div class="help-submit-msginput">
			<label class="help-submit-label">
				<span>姓名</span>
			</label>
			<input class="help-people-name input bg-white help-submit-input" type="text" placeholder="请输入您的真实姓名">
		</div>
		<?php } ?>
		
		<?php if ($showConf['idCard'] == 1){ ?>
		<div class="help-submit-msginput">
			<label class="help-submit-label">
				<span>身份证号</span>
			</label>
			<input class="help-people-cardnum input bg-white help-submit-input" type="number" placeholder="请输入您的有效身份证号码">
		</div>
		<?php } ?>
		
		<?php if ($showConf['townStreet'] == 1){ ?>
		<div class="help-submit-msginput">
			<label class="help-submit-label">
				<span>所属镇街</span>
			</label>
			<select class="input help-submit-msgselect" class="" name="" id="">
		       	<option value="0">请选择</option>
		       	<?php if (isset($dgTown) && is_array($dgTown)): ?>
		       	<?php foreach($dgTown as $k1 => $town): ?>
		       	<option value="<?php echo $town['key']; ?>"><?php echo $town['val']; ?></option>
		       	<?php endforeach; ?>
		       	<?php endif; ?>
		    </select>
		</div>
		<?php } ?>
		
		<?php if ($showConf['domicileAddress'] == 1){ ?>
		<div id="domicile-address" class="help-submit-msginput">
			<label class="help-submit-label">
				<span>户籍地址</span>
			</label>
			<input class="permanent-address input bg-white help-register-input" type="text" placeholder="请输入您的户籍地址">
			<div class="help-register-example">(如:广东东莞)</div>
		</div>
		<?php } ?>
		
		<!--身份证上传-->
		<?php if ($showConf['idCardPic'] == 1){ ?>
		<div id="id-card-pic" class="activity-file-upload">
			<div class="file-upload-head relative">
				<div class="file-upload-title">请上传身份证正反照片</div>
				<i class="file-upload-line"></i>
			</div>
			<div class="activity-uploadfile-cont id-card-imgs">
				<div class="no-img-comp activity-uploadfile-btn" id="btnImgUpload">
					<img class="width100 height100" src="/dgcs_wx/Public/images/cf-activity-fileupload.jpg" alt="" />
				</div>
			</div>
		</div>
		<?php } ?>
		 
		<?php if ($showConf['phone'] == 1){ ?>
		<div id="phone" class="help-submit-msginput">
			<label class="help-submit-label">
				<span>联系电话</span>
			</label>
			<input class="contact-number input bg-white help-submit-input" type="number" placeholder="请输入您的座机或手机">
		</div>
		<?php } ?>
		
		<?php if ($showConf['helpReason'] == 1){ ?>
		<div id="" class="help-submit-msginput">
			<label class="help-submit-label">
				<span>救助原因</span>
			</label>
			<input class="salvage-reason input bg-white help-submit-input" type="text" placeholder="请输入您的救助原因">
		</div>
		<?php } ?>
		
		<?php if ($showConf['amountPaid'] == 1){ ?>
		<div class="help-submit-msginput">
			<label class="help-cost-label">
				<span>已支付医疗费用(元)</span>
			</label>
			<input class="medical-expense input bg-white help-cost-input" type="number" placeholder="请输入金额">
		</div>
		<?php } ?>
		
		<?php if ($showConf['reimburseAmount'] == 1){ ?>
		<div class="help-submit-msginput">
			<label class="help-cost-label">
				<span>社保报销金额(元)</span>
			</label>
			<input class="social-security input bg-white help-cost-input" type="number" placeholder="请输入金额">
		</div>
		<?php } ?>
		<!-- 其他受助情况 -->
		<?php if ($showConf['recipientStatus'] == 1){ ?>
		<div class="other-help-msginput">
			<div class="other-help-situation relative">
				<div class="other-help-txt">其他受助情况</div>
				<i class="other-help-line"></i>
			</div>
			<textarea class="other-recipients input bg-white other-help-textarea right" placeholder="请输入受助情况"></textarea>
		</div>
		<?php } ?>
		
		<?php if ($showConf['situationExplain'] == 1){ ?>
		<div class="other-help-msginput">
			<div class="other-help-situation relative">
				<div class="other-help-txt">情况说明</div>
				<i class="other-help-line"></i>
			</div>
			<textarea class="status-statement input bg-white other-help-textarea right" placeholder="请输入相关说明"></textarea>
		</div>
		<?php } ?>
		
		<?php if ($showConf['relatedData'] == 1){ ?>
		<!--相关资料上传-->
		<div class="activity-file-upload">
			<div class="file-upload-head relative">
				<div class="file-upload-title">相关资料上传</div>
				<i class="file-upload-line"></i>
			</div>
			<div class="activity-uploadfile-cont other-info-imgs">
				<div class="upload-dataimg-btn activity-uploadfile-btn" id="btnDataImgUpload">
					<img class="width100 height100" src="/dgcs_wx/Public/images/cf-activity-fileupload.jpg" alt="" />
				</div>
			</div>
		</div>
		<?php } ?>
		
		<?php if (isset($showConf["content"]) && !empty($showConf["content"])) :?>
		<div class="activity-uploadremarks"><?php echo $showConf["content"]; ?></div>
		<?php endif; ?>
	</div>
	<div class="want-help-page-btn">
		<div class="want-help-page-button color-white text-center">提交</div>
	</div>
</section>
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
			<div class="cf-foot-midnav cf-footother display-none" style="z-index: 9999;">
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('info/helpdata/index'));">求助数据查询</div>
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('info/paybill/index'));">晒账单</div>
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('user/volunteer/index'));">志愿者服务</div>
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('home/activity/index'));">慈善活动申请</div>
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('user/needhelp/index'));">我要求助</div>
				<div class="aclick-btn cf-footother-son text-center" data-url="et.redirect(et.url('user/donation/index'));">我要捐</div>
				<!--<div class="aclick-btn cf-footother-son text-center">广东扶贫济困日</div>-->
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
	window._wxAuthUrl = "<?php echo urlencode(base64_encode(U('/dgcs_wx/weixin.php/user/needhelp/helpAction?id=ot7VhxPwYRRkgGu3CUiXASCYo4k0&no=20170705114250982'))); ?>";
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