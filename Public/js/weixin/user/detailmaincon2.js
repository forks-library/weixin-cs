var model       = "";
var modelRender = "";
var no          = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	no          = et.getQueryString("no");
	model       = et.template("detailmaincon.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);	
	
	et.json(et.url("act/helpdetail/detailData"), function(json) {
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
		}
		
		fnAClickBtn();
		
		if (et.loadingLayer && et.loadingLayer.initLoading) {
			et.loadingLayer.initLoading.stop();
		}
	}, {no: no});	
});