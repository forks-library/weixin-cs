var model = "";
var modelRender = "";

var fnSearch = function() {
	et.json(et.url("act/donation/donationList"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.moneyTop) {
				$(".follows-list").html(modelRender({datas: json.moneyTop}));
			}
			if (json.newTop) {
				$(".newest-list").html(modelRender({datas: json.newTop}));
			}
		}
		
		fnAClickBtn();
	}, {search: $(".search_input").val() || ''});
};

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	model = et.template("donationList.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	/**
	 * tab控制
	 */
	et.tab.show({
		tab: ".tabs"
		,base: ".tab-info"
	});
	
	et.json(et.url("act/donation/donationList"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.moneyTop) {
				$(modelRender({datas: json.moneyTop})).appendTo($(".follows-list"));
			}
			if (json.newTop) {
				$(modelRender({datas: json.newTop})).appendTo($(".newest-list"));
			}
			var paddingHeight = $(".article-twotitle").height() + $(".pages-header").height() + $(".wantdonate-tab").height();
			var tabTop 		  = $(".article-twotitle").height() + $(".pages-header").height()
			$(".main-container").css("paddingTop",paddingHeight);
			$(".wantdonate-tab").css("top",tabTop);
		}
		
		fnAClickBtn();
		
		if (et.loadingLayer && et.loadingLayer.initLoading) {
			et.loadingLayer.initLoading.stop();
		}
	});
});