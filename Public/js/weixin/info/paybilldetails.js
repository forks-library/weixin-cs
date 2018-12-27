var model = "";
var modelRender = "";
var no = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	no = et.getQueryString("no");
	
	model = et.template("paybillPage.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/paybill/paybillPage"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.paybill) {
				$(modelRender(json)).appendTo($(".main-container"));
				var contHeight =  et.screenHeight - $(".pages-header").height() - $(".article-twotitle").height() - $(".nav-footer").height() - parseInt($("html").css("font-size"));
				$(".paybill-cont").css("height",contHeight);
			}
		}
	}, {no: no});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});