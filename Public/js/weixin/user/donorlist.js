var model = "";
var modelRender = "";
var no = "";

require(["template", "page", "lazyload", "validate"], function(templateObj) {
	no = et.getQueryString("no");
	
	model = et.template("donatorList.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	et.json(et.url("act/donation/donatorList"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.datas && json.datas) {
				$.each(json.datas, function(index, obj) {
					if (et.isNull(obj.imgUrl)) {
						obj.imgUrl = et.imgUrl("images/cfm-icon-nopic.png");
					}
				});
			}
			
			$(modelRender(json)).appendTo($(".donorname-list"));
		}
		
		fnAClickBtn();
	}, {no: no});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});