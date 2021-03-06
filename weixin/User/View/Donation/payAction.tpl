<include file="../../Tpl/header" />
<input type="hidden" class="appId" value="" />
<input type="hidden" class="nonceStr" value="" />
<input type="hidden" class="package" value="" />
<input type="hidden" class="sign" value="" />
<input type="hidden" class="signType" value="" />
<input type="hidden" class="timeStamp" value="" />
<!-- 没有数据时，隐藏封面 -->
<section class="main-container block" style="padding-top:6.5rem;padding-bottom:7.5rem; font-size:0px;">
	<!-- 头部 -->
	<div class="pages-header width100">
		<img class="cf-icon-logo" src="__PUBLIC__/images/cf-icon-logo.png" alt="">
	</div>
	<!--标题-->
	<div class="article-onetitle">
		<div class="article-onetitle-txt ellipsis">我要捐款</div>
	</div>
	<div class="article-cont inline-block">
		<div class="payment-project-name"><?php if (isset($title) && !empty($title)): echo $title; endif;?></div>
		<div class="help-submit-msginput">
			<label class="help-submit-label">
				<span>支付金额</span>
			</label>
			<input class="input bg-white help-submit-input pay-amount" type="number" placeholder="请输入金额">
		</div>
		<!--选择金额-->
		<div class="chiose-money" style="width: 100%;overflow: hidden;"></div>
		<div class="isname-radio">
			<label class="isname-radio-label">
				<input name="isname[]" id="isname1" class="radio-isname" type="radio" value="1" checked="checked" />匿名捐赠 
			</label> 
			<label class="isname-radio-label">
				<input name="isname[]" id="isname2" class="radio-isname" type="radio" value="2" />实名捐赠
			</label> 
		</div>
		<!-- 捐赠收据 -->
		<div class="donation-receipt display-none">
			<div class="donation-receipt-title relative">
				<i class="donation-receipt-line"></i>
				<div class="donation-receipt-txt">开具捐赠收据信息</div>
			</div>

			<div class="donation-receipt-msginput">
				<label class="donation-receipt-label">
					<span>捐赠人/单位</span>
				</label>
				<input class="input bg-white donation-receipt-input pay-company" type="text" placeholder="请输入您的姓名/单位全称">
			</div>
			<div class="donation-receipt-msginput">
				<label class="donation-receipt-label">
					<span>联系人</span>
				</label>
				<input class="input bg-white donation-receipt-input pay-conactor" type="text" placeholder="请输入联系人姓名">
			</div>
			<div class="donation-receipt-msginput">
				<label class="donation-receipt-label">
					<span>电话</span>
				</label>
				<input class="input bg-white donation-receipt-input pay-handy" type="text" placeholder="请输入联系人电话">
			</div>
		</div>
		<!-- 慈善账户信息-->
		<div class="account-msg">
			<div class="donation-receipt-title relative">
				<i class="donation-receipt-line"></i>
				<div class="donation-receipt-txt">慈善账户信息</div>
			</div>
			<div class="donation-receipt-msginput">
				<div class=" donation-receipt-input">可以通过银联捐赠到慈善会账户：</div>
			</div>
			<div class="donation-receipt-msginput" style="padding-left: 1rem;width: calc(100% - 1rem);">
				<label class="donation-receipt-label">
					<span>开户名称：</span>
				</label>
				<div class=" donation-receipt-input">东莞市慈善会</div>
			</div>
			<div class="donation-receipt-msginput" style="padding-left: 1rem;width: calc(100% - 1rem);">
				<label class="donation-receipt-label">
					<span>开户银行：</span>
				</label>
				<div class=" donation-receipt-input">东莞银行东城支行</div>
			</div>
			<div class="donation-receipt-msginput" style="padding-left: 1rem;width: calc(100% - 1rem);">
				<label class="donation-receipt-label">
					<span>开户账号：</span>
				</label>
				<div class=" donation-receipt-input">540000609111111</div>
			</div>
		</div>
	</div>
	<div class="want-help-page-btn">
		<div class="confirm-pay want-help-page-button color-white text-center">确认支付</div>
	</div>
</section>
<include file="../../Tpl/footOther" />
<include file="../../Tpl/js" />
<include file="../../Tpl/footer" />