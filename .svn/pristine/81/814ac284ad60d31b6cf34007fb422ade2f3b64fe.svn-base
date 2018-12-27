var model = "";
var modelRender = "";
var no = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	no = et.getQueryString("no");

	model = et.template("newsPage.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/aboutus/newsPage"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.news) {
				$(modelRender(json)).appendTo($(".main-container"));
				var paddingHeight = $(".article-twotitle").height() + $(".pages-header").height();
				$(".main-container").css("paddingTop",paddingHeight);
			}
		}
	}, {no: no});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});