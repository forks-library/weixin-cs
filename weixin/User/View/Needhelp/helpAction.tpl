<include file="../../Tpl/header" />
<!-- 没有数据时，隐藏封面 -->
<section class="main-container block" style="padding-top:6.5rem;padding-bottom:7rem; font-size:0px;">
	<!-- 头部 -->
	<div class="pages-header width100">
		<img class="cf-icon-logo" src="__PUBLIC__/images/cf-icon-logo.png" alt="">
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
					<img class="width100 height100" src="__PUBLIC__/images/cf-activity-fileupload.jpg" alt="" />
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
					<img class="width100 height100" src="__PUBLIC__/images/cf-activity-fileupload.jpg" alt="" />
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
<include file="../../Tpl/footOther" />
<include file="../../Tpl/js" />
<include file="../../Tpl/footer" />