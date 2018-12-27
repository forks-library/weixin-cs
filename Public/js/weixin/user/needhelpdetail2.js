var model = "";
var modelRender = "";
var no = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	no = et.getQueryString("no");
	
	model = et.template("helpDetail.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/needhelp/detailData"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.data) {
				if (json.data.useStatus == "0") {
					$(".main-container").css("padding-bottom", "3.5rem");
				}
			}
			
			$(modelRender(json)).appendTo($(".main-container"));
			var paddingHeight = $(".article-twotitle").height() + $(".pages-header").height();
			$(".main-container").css("paddingTop",paddingHeight);
			var btnHeight = $(".article-twotitle").height();
			$(".needhelp-details-btn").css("height",btnHeight);
			$(".needhelp-details-btn").css("lineHeight",btnHeight + "px");
		}
		
		fnAClickBtn();
		
		if (et.loadingLayer && et.loadingLayer.initLoading) {
			et.loadingLayer.initLoading.stop();
		}
	}, {no: no});
});