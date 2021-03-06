var model = "";
var modelRender = "";
var no = "";
var loading = false;

require(["template", "page", "lazyload", "swiper","upload"], function(templateObj) {
	$(".optarget").val("act/help");
	no = et.getQueryString("no");
	
//	var paddingHeight = $(".article-twotitle").height() + $(".pages-header").height();
//	$(".main-container").css("paddingTop",paddingHeight);
	
	$(".guestbook-btn").off("tap").tap(function() {
		$(this).animate({opacity: 0.5}, 200, "ease-out", function() {
			$(this).animate({opacity: 1}, 200, "ease-out", function() {
				var	id		= $(".id").val() || '';
				var name	= $(".guest-username").val() || '';
				var note	= $(".guestbook-note").val() || '';
				
				if (et.isNull(note)) {
					alert("请输入留言");
					return;
				}
				
				if (!et.isNull(note)) {							
					et.json(et.url("act/Leaveword/addLeaveWords"), function(json) {
						if (et.jsonDecode.hasErr(json)) {
							et.jsonDecode.showErr(json);
						} else {
							alert("留言提交成功");
							et.redirect(et.url("user/donation/guestlist?no=" + no));
						}
					}, {userId:id, dataId: et.getQueryString("no"), name:name, note:note});
				}
			});
		});
	});
	
	fnAClickBtn();
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});