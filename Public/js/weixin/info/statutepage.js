var model = "";
var modelRender = "";
var no = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	no = et.getQueryString("no");
	
	model = et.template("statuePage.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/aboutus/statuePage"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.statue) {
				if (json.statue.imgs && json.statue.imgs.length > 0) {
					var htmls = [];
					
					for (var i = 0; i < json.statue.imgs.length; i++) {
						if (json.statue.imgs[i].endWith(".html")) {
							htmls.push(json.statue.imgs[i]);
							json.statue.imgs.remove(json.statue.imgs[i]);
						}
					}
					
					if (htmls.length > 0) {
						json.statue.htmls = htmls;
					}
				}
				
				$(modelRender(json)).appendTo($(".main-container"));
			}
		}
	}, {no: no});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});