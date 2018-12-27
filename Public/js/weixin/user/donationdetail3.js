var model = "";
var modelRender = "";
var no = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	no = et.getQueryString("no");
	
	model = et.template("donationDetail.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/donation/donationDetail"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.data.length == 0) {
				alert("此项目已下架");
				window.history.go(-1);
				return;
			} else if (json.data) {
				if (json.data.topFive) {
					$.each(json.data.topFive, function(index, obj) {
						if (et.isNull(obj.imgUrl)) {
							obj.imgUrl = et.imgUrl("images/cfm-icon-nopic.png");
						}
					});
				}
				
				if (json.data.runStatus == "0") {
					$(".main-container").css("padding-bottom", "3.5rem");
				}
			}
			
			$(modelRender(json)).appendTo($(".main-container"));
		}
		
		fnAClickBtn();
		
		//邀请好友一起捐
		$(".call-friend-donor").on("tap", function() {
			$(this).animate({opacity: 0.5}, 200, "ease-out", function() {
				$(this).animate({opacity: 1}, 200, "ease-out", function() {
					$(".masking-sharepage").removeClass("display-none");
					$(".masking-sharepage").on("tap", function() {
						$(this).addClass("display-none");
					});
				});
			});
		});
		
		if (et.loadingLayer && et.loadingLayer.initLoading) {
			et.loadingLayer.initLoading.stop();
		}
	}, {no: no});
});