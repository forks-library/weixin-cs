var model = "";
var modelRender = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	model = et.template("helpType.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/needhelp/helpTypeData"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			$(".want-help-list").html(modelRender(json));
			var paddingHeight = $(".article-twotitle").height() + $(".pages-header").height();
			$(".main-container").css("paddingTop",paddingHeight);
		}
		
		fnAClickBtn();
		
		if (et.loadingLayer && et.loadingLayer.initLoading) {
			et.loadingLayer.initLoading.stop();
		}
	});
});