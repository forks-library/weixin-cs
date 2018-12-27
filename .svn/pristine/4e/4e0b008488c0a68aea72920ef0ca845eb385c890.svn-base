var model = "";
var modelRender = "";

require(["template", "page", "lazyload", "swiper"], function(templateObj) {
	model = et.template("salvorList.html");
	templateObj.config("escape", false);
	modelRender = templateObj.compile(model);
	
	$(".search-page-btn").off("tap").tap(function() {
		$(this).animate({opacity: 0.5}, 200, "ease-out", function() {
			$(this).animate({opacity: 1}, 200, "ease-out", function() {
				var idCard = $(".search-cardnum-input").val();
				
				if (et.isNull(idCard)) {
					alert("请输入身份证号");
				}
				
				if (!et.isNull(idCard)) {
					et.json(et.url("act/helpdata/dataResult"), function(json) {
						if (et.jsonDecode.hasErr(json)) {
							et.jsonDecode.showErr(json);
						} else {
							if (json.isdata == "false") {
								alert("查无此信息，请确认输入内容是否正确");
							} else if (json.salvors) {
								$(".seach-data").html(modelRender(json));
							}
						}
					}, {idno: idCard});
				}
			});
		});
	});
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});