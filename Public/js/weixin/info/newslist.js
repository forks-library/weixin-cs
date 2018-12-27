var model = "";
var modelRender = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	model = et.template("newsList.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/aboutus/newsList"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.datas) {
				$(modelRender(json)).appendTo($(".news-list"));
			}
		}
		
		fnAClickBtn();
	});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});