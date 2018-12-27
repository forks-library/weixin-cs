var donationModel = "";
var donationModelRender = "";
var helpModel = "";
var helpModelRender = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	templateObj.config("escape", false);
	donationModel = et.template("donationList.html");
	donationModelRender = templateObj.compile(donationModel);
	
	helpModel = et.template("helpType.html");
	helpModelRender = templateObj.compile(helpModel);
	
	et.json(et.url("act/aboutus/projectList"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.donations) {
				$(donationModelRender({datas: json.donations})).appendTo($(".want-help-list"));
			}
			if (json.helps) {
				$(helpModelRender({datas: json.helps})).appendTo($(".want-help-list"));
			}
		}
		
		fnAClickBtn();
	});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});