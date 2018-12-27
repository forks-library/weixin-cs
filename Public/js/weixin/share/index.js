require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});