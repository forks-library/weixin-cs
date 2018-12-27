<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
	<?php if (isset($handyType) && !empty($handyType)): ?>
	<?php if ($handyType === 'ios') { ?>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/cfm-new-ios.css" />
	<?php } else if ($handyType === 'and') { ?>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/cfm-new-and.css" />
	<?php } else { ?>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/cfm-new.css" />
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