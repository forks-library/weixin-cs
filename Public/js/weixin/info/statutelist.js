var model = "";
var modelRender = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	model = et.template("statueList.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/aboutus/statueList"), function(json) {
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