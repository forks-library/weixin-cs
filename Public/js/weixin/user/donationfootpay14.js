var model       = "";
var modelRender = "";
var faceValue   = "";

require(["template", "page", "lazyload", "validate"], function(templateObj) {
	
	model = et.template("donationfootpay2.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/nopublic/getNoPublic"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			$(modelRender(json)).appendTo($(".main-container"));
		}
		
		$(".face-value").off("tap").tap(function() {
			$(this).addClass("active");
	        $(this).siblings().removeClass("active");
			faceValue = $(this).find("span").html();
			
			if (!et.isNull($(".pay-amount").val())) {
				$(".pay-amount").val("");
			}
		});
		
		$(".pay-amount").on('focus', function() {
			if (et.isJQueryObject($(".face-value.active"))) {
				$(".face-value.active").removeClass("active");
			}
		});
		
		$(".confirm-pay").off("tap").tap(function() {
			var payAmount    = "";
			var payCompany   = "";
			var payContactor = "";
			var payHandy     = "";
			
			if (et.isJQueryObject($(".face-value.active"))) {
				payAmount = faceValue;
			} else {
				payAmount = $(".pay-amount").val() || '';
			}

			var ArrMen = payAmount.split(".");
			
			if (ArrMen.length == 2) {
				if (ArrMen[1].length > 2) {
	            	alert("请输入正确的数额");
	            	return;
	            }
	        }
			
			if (payAmount <= 0) {
				alert("请输入正确的数额");
				return;
			}
			
			if (et.isNull(payAmount)) {
				alert("请选择或输入数额");
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
		
		fnAClickBtn();
		
		if (et.loadingLayer && et.loadingLayer.initLoading) {
			et.loadingLayer.initLoading.stop();
		}
	}, {no: et.getQueryString("no")});
	
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
						if (res.err_msg == "get_brand_wcpay_request:ok" ) {
							alert("支付完成");
							et.redirect(et.url('share/footshare/index',{no: et.getQueryString("no")}));
						} else {
							alert("支付失败");
						}
					}
				);
			}
		});
	}
});