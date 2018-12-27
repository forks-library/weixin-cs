var model = "";
var modelRender = "";
var no = "";
var loading = false;

require(["template", "page", "lazyload", "swiper","upload"], function(templateObj) {
	$(".optarget").val("act/help");
	no = et.getQueryString("no");
	
	//相关资料图片上传
	et.uploadImg("btnFileImgUpload", function(data, opts) {
		var haveFileImgComp  = $(".have-fileimg-comp");
		var uploadFileImgBtn = $(".upload-fileimg-btn");
		var aboutDataCont    = $(".activity-uploadfile-cont");
		var parent           = uploadFileImgBtn.parent();
		var id               = parent.find(".have-fileimg-comp").size();
		
		if (et.isJQueryObject(uploadFileImgBtn)) {
			if (parent.find(".have-fileimg-comp").size() < 11) {
				$('<div class="have-fileimg-comp activity-uploadfile-btn" id="btnFileImgUpload' + id + '"><img class="about-file-img width100 height100" src="' + data.images + '?x-oss-process=image/resize,w_650/auto-orient,1" alt="" /></div>').appendTo(aboutDataCont);
			} else {
				$('<div class="have-fileimg-comp activity-uploadfile-btn" id="btnFileImgUpload' + id + '"><img class="about-file-img width100 height100" src="' + data.images + '?x-oss-process=image/resize,w_650/auto-orient,1" alt="" /></div>').prependTo(aboutDataCont);
			}
			
			et.uploadImg("btnFileImgUpload" + id, function(data, opts) {
				var targetObj = $("#" + opts.targetId);
				targetObj.find("img").remove();
				$('<img class="about-file-img width100 height100" src="' + data.images + '?x-oss-process=image/resize,w_650/auto-orient,1" >').appendTo(targetObj);
			});
		}
		
		if (parent.find(".have-fileimg-comp").size() >= 12) {
			et.css.hidden(uploadFileImgBtn);
		} else {
			et.css.visit(uploadFileImgBtn);
		}
	});
	
	var paddingHeight = $(".article-twotitle").height() + $(".pages-header").height();
	$(".main-container").css("paddingTop",paddingHeight);
	
	$(".activity-submit").off("tap").tap(function() {
		if (!et.isTrue(loading)) {
			loading = true;
			
			$(this).animate({opacity: 0.5}, 200, "ease-out", function() {
				$(this).animate({opacity: 1}, 200, "ease-out", function() {
					var	id				= $(".id").val() || '';
					var companyName		= $(".company-name").val() || '';
					var contactsName	= $(".contacts-name").val() || '';
					var contactNum		= $(".contact-num").val() || '';
					var describe		= $(".describe").val() || '';
					var aboutFileImg	= $(".about-file-img");
					var straboutFileImg = "";
					
					loading = false;
					
					if (et.isNull(companyName)) {
						alert("请输入单位全称");
						return;
					}
					if (et.isNull(contactsName)) {
						alert("请输入联系人姓名");
						return;
					}
					if (et.isNull(contactNum)) {
						alert("请输入联系人电话");
						return;
					}
					if (et.isNull(describe)) {
						alert("请输入活动描述");
						return;
					}
					if (!et.isJQueryObject(aboutFileImg)) {
						alert("请上传相关文件图片");
						return;
					} else {
						for (var i = 0; i < aboutFileImg.length; i++) {
							if (!et.isNull(straboutFileImg)) {
								straboutFileImg += "|";
							}
							straboutFileImg += $(aboutFileImg[i]).attr("src").substr(0, $(aboutFileImg[i]).attr("src").indexOf("?"));
						}
					}	
					
					if (!et.isNull(companyName) && !et.isNull(contactsName)
							&& !et.isNull(contactNum) && !et.isNull(describe)
							&& !et.isNull(aboutFileImg)) {							
						et.json(et.url("/act/Volunteer/addVolunteerInfor"), function(json) {
							if (et.jsonDecode.hasErr(json)) {
								et.jsonDecode.showErr(json);
							} else {
								alert("提交成功");
							}
						}, {no : no, userId : id, applicantUnit : companyName, contacts : contactsName, phone : contactNum, note : describe, aboutDataImg : straboutFileImg});
					}
				});
			});
		}
	});
	
	fnAClickBtn();
	
	if (et.loadingLayer && et.loadingLayer.initLoading) {
		et.loadingLayer.initLoading.stop();
	}
});