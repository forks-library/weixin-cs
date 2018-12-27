var model        = "";
var modelRender  = "";
var endingLocker = true;
var page         = 2;

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	model = et.template("volunteerType.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/volunteernotes/getVolunteerNotes"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.datas.length < 4) {
				endingLocker = false;
			}
			
			$(".want-help-list").html(modelRender(json));
			var paddingHeight = $(".article-twotitle").height() + $(".pages-header").height();
			$(".main-container").css("paddingTop",paddingHeight);
		}
		
		fnAClickBtn();
		
		if (et.loadingLayer && et.loadingLayer.initLoading) {
			et.loadingLayer.initLoading.stop();
		}
	});
	
	et.screen.scroll(function() {
		if (et.loadingLayer && et.loadingLayer.pagingLoading && et.isTrue(endingLocker)) {
			et.loadingLayer.pagingLoading.start(function() {
				et.json(et.url("act/volunteernotes/getVolunteerNotes"), function(json) {
					if (et.jsonDecode.hasErr(json)) {
						et.jsonDecode.showErr(json);
					} else {
						$(modelRender(json)).appendTo($(".want-help-list"));
					}
				}, {page : page});
			});
		}
	}, "", 1, "");
});