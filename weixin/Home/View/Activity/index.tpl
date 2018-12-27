<include file="../../Tpl/header" />
<!-- 没有数据时，隐藏封面 -->
<section class="main-container block" style="padding-top:7rem;padding-bottom:7rem; font-size:0px;">
	<!-- 头部 -->
	<div class="pages-header width100">
		<img class="cf-icon-logo" src="__PUBLIC__/images/cf-icon-logo.png" alt="">
	</div>
	<!--标题-->
	<div class="article-twotitle">
		<div class="article-twotitle-txt ellipsis" style="width:100%;">慈善公益活动申请</div>
		<div class="" style="float: left; color: #323232; width: 100%; min-height: 1.5rem; line-height: 1.5rem; font-size: 1rem;text-indent: 2rem;"><?php echo $data?></div>
	</div>
	<div class="article-cont inline-block">
		<div class="activity-cont-input">
			<label class="activity-cont-label"><span>申请单位</span></label>
			<input class="company-name input bg-white" placeholder="请输入单位全称" type="text" />
		</div>
		<div class="activity-cont-input">
			<label class="activity-cont-label"><span>联系人</span></label>
			<input class="contacts-name input bg-white" placeholder="请输入联系人姓名" type="text" />
		</div>
		<div class="activity-cont-input">
			<label class="activity-cont-label"><span>联系电话</span></label>
			<input class="contact-num input bg-white" placeholder="请输入联系人电话" type="text" />
		</div>
		<div class="other-help-msginput">
			<div class="other-help-situation relative">
				<label class="other-help-txt"><span>活动描述</span></label>
				<i class="other-help-line"></i>
			</div>
			<textarea class="describe input bg-white other-help-textarea right" name="" id="" placeholder="请输入活动具体描述"></textarea>
			
		</div>
		
		<!--相关文件上传-->
		<div class="activity-file-upload">
			<div class="file-upload-head relative">
				<div class="file-upload-title">相关文件上传</div>
				<i class="file-upload-line"></i>
			</div>
			<div class="activity-uploadfile-cont">
				<!--div class="activity-uploadfile-btn">
					<img class="width100 height100" src="__PUBLIC__/images/cf-certificates01.jpg" alt="" />
				</div-->
				<div class="upload-fileimg-btn activity-uploadfile-btn" id="btnFileImgUpload">
					<img class="width100 height100" src="__PUBLIC__/images/cf-activity-fileupload.jpg" alt="" />
				</div>
			</div>
		</div>
		<div class="activity-uploadremarks">（资料要求：个人需提供身份证正反照，单位需提供营业执照。活动具体方案。）</div>
		<div class="activity-submit text-center color-white">
			<div class="want-help-page-button color-white text-center">提交</div>
		</div>
	</div>
</section>
<!--等待加载-->
<include file="../../Tpl/load" />
<!-- 底部按钮 -->
<include file="../../Tpl/footOther" />
<include file="../../Tpl/js" />
<include file="../../Tpl/footer" />


