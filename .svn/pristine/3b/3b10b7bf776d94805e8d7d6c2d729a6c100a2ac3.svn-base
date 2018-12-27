var model       = "";
var modelRender = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	model = et.template("indexbanner.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/banner/getBan"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			$(modelRender(json)).appendTo($(".index-banner-list"));
			
			if (json.datas.down.length != 0) {
				 $(".footer-banner").append('<img class="width100 height100" src="' + json.datas.down[0].display_pic + '" alt="">');
			}
		}
		// 图片划动
		$(".index-banner").Swipe({auto: 3000});
		
		fnAClickBtn();
	});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});