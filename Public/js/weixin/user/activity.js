var model = "";
var modelRender = "";
var no = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	no = et.getQueryString("no");
	
	model = et.template("activity.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	 
	et.json(et.url("act/myprojectdetail/applyActivityDetail"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			$(modelRender(json)).appendTo($(".main-container"));
			var paddingHeight = $(".article-twotitle").height() + $(".pages-header").height();
			$(".main-container").css("paddingTop",paddingHeight);
		}		
		fnAClickBtn();
		
		if (et.loadingLayer && et.loadingLayer.initLoading) {
			et.loadingLayer.initLoading.stop();
		}
	}, {no : no});
});