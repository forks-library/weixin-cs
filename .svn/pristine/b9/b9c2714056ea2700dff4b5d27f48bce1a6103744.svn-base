var model       = "";
var modelRender = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	model = et.template("charitable.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/kingkids/listdata"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			$(modelRender(json)).appendTo($(".want-help-list"));
		}
		
		fnAClickBtn();
	});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});