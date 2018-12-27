var model = "";
var modelRender = "";

require(["template", "page", "lazyload", "swiper","upload"], function(templateObj) {
	et.tab.show({
		tab: ".tabs"
		,base: ".tab-info"
	});
	
	//	内容
	model = et.template("me1.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);	
	var	id	= $(".id").val() || '';
	
	et.json(et.url("act/Myproject/helpProject"), function(json) {
		if (et.jsonDecode.hasErr(json)) {
			et.jsonDecode.showErr(json);
		} else {
			if (json.datas.juan && !et.isNull(json.datas.juan['0'].juanHelpCode)) {
				$(modelRender({juan: json.datas.juan})).appendTo($("#meDonation").find("ul"));
			} 
			
			if (json.datas && json.datas.seek && json.datas.seek) {
				if (json.datas.seek.hasMessage && et.isTrue(json.datas.seek.hasMessage)) {
					$(".newmsg-tips").show();
				} else {
					$(".newmsg-tips").hide();
				}
				
				if (json.datas.seek.list) {
					$(modelRender({seek: json.datas.seek.list})).appendTo($("#meNeedHelp").find("ul"));
				}
			}
			
			//申请活动tap
			if (json.datas && json.datas.activity && json.datas.activity) {
				if (json.datas.activity.hasMessage && et.isTrue(json.datas.activity.hasMessage)) {
					$(".activity-tips").show();
				} else {
					$(".activity-tips").hide();
				}
				
				if (json.datas.activity.list) {
					$(modelRender({activity: json.datas.activity.list})).appendTo($("#meActivity").find("ul"));
				}
			}
		}
		
		fnAClickBtn();
	}, {userId: id});

	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}	
});