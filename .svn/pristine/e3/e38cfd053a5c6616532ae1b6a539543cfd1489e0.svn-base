<script type="text/javascript">
	// 重新配置
    window.isDebug    = <?php if (isset($isDebug)) { echo $isDebug; } ?>;
    window._jsrc      = "<?php if (isset($jsSrc)) { echo $jsSrc; } ?>";
    window._http      = "#{$Think.SERVER_NAME}";
    window._root      = "__ROOT__";
    // window._root      = "";
    window._appName   = "#{$Think.SERVER_PARTNAME}";
    window._home      = "/home";
    window._servUrl   = window._appName ? window._root + "/" + window._appName : '';
    window._publicUrl = window._appName ? "__PUBLIC__" : "/Public";
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
	window._wxAuthUrl = "<?php echo urlencode(base64_encode(U('__SELF__'))); ?>";
	window._wxShareUrl= "<?php if (isset($wxShareUrl)) { echo $wxShareUrl; } ?>";
	window._wxShrTitle= "<?php if (isset($wxShrTitle)) { echo $wxShrTitle; } ?>";
	window._wxShrDesc = "<?php if (isset($wxShrDesc)) { echo $wxShrDesc; } ?>";
	// 系统配置
	window._compCode = '<?php if(isset($compCode)): echo $compCode; endif; ?>';
</script>
<script type="text/javascript" src="<?php if (isset($jsSrc)) { echo $jsSrc; } ?>/require/2.1.14.min.js"></script>
<script type="text/javascript" src="<?php if (isset($jsSrc)) { echo $jsSrc; } ?>/config/require.config.wx-2.0.1.js"></script>
<include file="../../Tpl/pageJs" />
<script type="text/javascript" src="__PUBLIC__/js/wxauth04.js"></script>