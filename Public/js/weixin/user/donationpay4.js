var model = "";
var modelRender = "";

require(["template", "page", "lazyload", "validate"], function(templateObj) {
	if (window.et) {
		et.extend(et, {
			callpay: function() {
				if (typeof WeixinJSBridge == "undefined") {
					if (document.addEventListener) {
						document.addEventListener('WeixinJSBridgeReady', et.jsApiCall, false);
					} else if (document.attachEvent) {
						document.attachEvent('WeixinJSBridgeReady', et.jsApiCall); 
						document.attachEvent('onWeixinJSBridgeReady', et.jsApiCall);
					}
				} else {
					et.jsApiCall();
				}
			}
			,jsApiCall: function() {
				if (et.isNull($(".appId").val())
						|| et.isNull($(".timeStamp").val())
						|| et.isNull($(".nonceStr").val())
						|| et.isNull($(".package").val())
						|| et.isNull($(".signType").val())
						|| et.isNull($(".sign").val())) {
					et.alarm("参数不全，请稍后再试");
					return;
				}
				
				WeixinJSBridge.invoke(
					'getBrandWCPayRequest'
					,{
						"appId"     : $(".appId").val()
						,"timeStamp": $(".timeStamp").val()
						,"nonceStr" : $(".nonceStr").val()
						,"package"  : $(".package").val()
						,"signType" : $(".signType").val()
						,"paySign"  : $(".sign").val()
					}
					,function(res) {
						// 发送参数
//						alert("pay_param: "+json.appId+"|"+json.timeStamp+"|"+json.nonceStr+"|"+json.packagestr+"|"+json.sign);
						// 返回参数
//						alert("pay_result_code: "+res.err_code);
//						alert("pay_result_msg: " + res.err_msg);
//						alert("pay_result_desc: "+res.err_desc);
						 // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
						if (res.err_msg == "get_brand_wcpay_request:ok" ) {
							// 完成订单
							alert("支付完成");
							et.redirect(et.url('user/me/index'),{id: $(".id").val()});
						} else {
							alert("支付失败");
						}
					}
				);
			}
		});
	}
	
	$(".radio-isname").each(function() {
		var radioBoxId = $(this).attr("id");
		document.getElementById(radioBoxId).onchange = function() {
			var target = $("#" + this.id);
			
			if (target.prop("checked")) {
				if (parseInt(target.val()) === 1) {
					if ($(".donation-receipt").css('display') != 'none') {
						$(".donation-receipt").fadeOut(300);
					}
				} else if (parseInt(target.val()) === 2) {
					if ($(".donation-receipt").css('display') == 'none') {
						$(".donation-receipt").fadeIn(300);
					}
				}
			}
		};
	});

	et.json(et.url("act/donation/getDonationIsYuan"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if(json.data.isYuan != null) {
				$(".pay-amount").val(json.data.isYuan);
				$(".pay-amount").attr("disabled",true); 
				$(".pay-amount").css("background", "rgba(0,0,0,0.1)")
				var payAmount    = json.data.isYuan;
				var payCompany   = $(".pay-company").val() || '';
				var payContactor = $(".pay-conactor").val() || '';
				var payHandy     = $(".pay-handy").val() || '';

				// alert(payAmount);
				
				et.json(et.url("pay/payorder/payoffDonation"), function(json) {
					if (et.jsonDecode.hasErr(json)) {
						et.jsonDecode.showErr(json);
					} else {
						if (json.signCode) {
							$(".appId").val(json.signCode.appId);
							$(".timeStamp").val(json.signCode.timeStamp);
							$(".nonceStr").val(json.signCode.nonceStr);
							$(".package").val(json.signCode["package"]);
							$(".signType").val(json.signCode.signType);
							$(".sign").val(json.signCode.sign);
							
							et.callpay();
						}
					}
				}, {id: $(".id").val() || '', no: et.getQueryString("no"), donation: payAmount, comp: payCompany, name: payContactor, handy: payHandy});
			}
		}
	}, {no: et.getQueryString("no")});

	
	$(".confirm-pay").off("tap").tap(function() {
		var payAmount    = $(".pay-amount").val() || '';
		var payCompany   = $(".pay-company").val() || '';
		var payContactor = $(".pay-conactor").val() || '';
		var payHandy     = $(".pay-handy").val() || '';
		
		if (et.isNull(payAmount)) {
			alert("请输入数额");
			return;
		}
		
		et.json(et.url("pay/payorder/payoffDonation"), function(json) {
			if (et.jsonDecode.hasErr(json)) {
				et.jsonDecode.showErr(json);
			} else {
				if (json.signCode) {
					$(".appId").val(json.signCode.appId);
					$(".timeStamp").val(json.signCode.timeStamp);
					$(".nonceStr").val(json.signCode.nonceStr);
					$(".package").val(json.signCode["package"]);
					$(".signType").val(json.signCode.signType);
					$(".sign").val(json.signCode.sign);
					
					et.callpay();
				}
			}
		}, {id: $(".id").val() || '', no: et.getQueryString("no"), donation: payAmount, comp: payCompany, name: payContactor, handy: payHandy});
	});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});