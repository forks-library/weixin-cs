var model = "";
var modelRender = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	et.json(et.url("act/aboutus/introPage"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.data.note) {
				$(".article-cont").html(json.data.note);
			}
		}
	});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});