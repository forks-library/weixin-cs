var model = "";
var modelRender = "";
var no = "";
var loading = false;

require(["template", "page", "lazyload", "swiper", "upload"], function(templateObj) {
	$(".optarget").val("act/help");
	no = et.getQueryString("no");
	
	//证件图片上传	
	et.uploadImg("btnImgUpload", function(data, opts) {
		var haveImgComp = $(".have-img-comp");
		var noImgComp   = $(".no-img-comp");
		var parent      = noImgComp.parent();
		var id          = parent.find(".have-img-comp").size();
		
		if (et.isJQueryObject(noImgComp)) {
			noImgComp.after('<div class="have-img-comp activity-uploadfile-btn" id="btnImgUpload' + id + '"><img class="useridcard-upload-img width100 height100" src="' + data.images + '?x-oss-process=image/resize,w_650/auto-orient,1" ></div>');
			
			et.uploadImg("btnImgUpload" + id, function(data, opts) {
				var targetObj = $("#" + opts.targetId);
				targetObj.find("img").remove();
				$('<img class="useridcard-upload-img width100 height100" src="' + data.images + '?x-oss-process=image/resize,w_650/auto-orient,1" ></div>').appendTo(targetObj);
			});
		}
		
		if (parent.find(".have-img-comp").size() >= 2) {
			et.css.hidden($(".no-img-comp"));
		} else {
			et.css.visit($(".no-img-comp"));
		}
	});
	
	//相关资料图片上传
	et.uploadImg("btnDataImgUpload", function(data, opts) {
		var haveDataImgComp  = $(".have-dataimg-comp");
		var uploadDataImgBtn = $(".upload-dataimg-btn");
		var otherInfoComp    = $(".other-info-imgs");
		var parent           = uploadDataImgBtn.parent();
		var id               = parent.find(".have-dataimg-comp").size();
		
		if (et.isJQueryObject(otherInfoComp)) {
			if (parent.find(".have-dataimg-comp").size() < 11) {
				$('<div class="have-dataimg-comp activity-uploadfile-btn" id="btnDataImgUpload' + id + '"><img class="aboutdata-upload-img width100 height100" src="' + data.images + '?x-oss-process=image/resize,w_650/auto-orient,1" ></div>').appendTo(otherInfoComp);
			} else {
				$('<div class="have-dataimg-comp activity-uploadfile-btn" id="btnDataImgUpload' + id + '"><img class="aboutdata-upload-img width100 height100" src="' + data.images + '?x-oss-process=image/resize,w_650/auto-orient,1" ></div>').prependTo(otherInfoComp);
			}
			et.uploadImg("btnDataImgUpload" + id, function(data, opts) {
				var targetObj = $("#" + opts.targetId);
				targetObj.find("img").remove();
				$('<img class="aboutdata-upload-img width100 height100" src="' + data.images + '?x-oss-process=image/resize,w_650/auto-orient,1" ></div>').appendTo(targetObj);
			});
		}
		
		if (parent.find(".have-dataimg-comp").size() >= 12) {
			et.css.hidden($(".upload-dataimg-btn"));
		} else {
			et.css.visit($(".upload-dataimg-btn"));
		}
	});
	
	var fnJudge = function(obj, value) {
		if (!et.isJQueryObject(obj)) {
			return true;
		} else {
			return !et.isNull(value);
		}
	}
	
	$(".want-help-page-btn").off("tap").tap(function() {
		if (!et.isTrue(loading)) {
			loading = true;
			$(this).animate({opacity: 0.5}, 200, "ease-out", function() {
				$(this).animate({opacity: 1}, 200, "ease-out", function() {
					var	id					= $(".id").val() || '';
					var helpPeopleName		= $(".help-people-name").val() || '';
					var helpPeopleCardnum	= $(".help-people-cardnum").val() || '';
					var helpSubmitMsgselect	= $(".help-submit-msgselect").val() || '';
					var permanentAddress	= $(".permanent-address").val() || '';
					var userIdCardUploadImg	= $(".useridcard-upload-img");
					var contactNumber     	= $(".contact-number").val() || '';
					var salvageReason     	= $(".salvage-reason").val() || '';
					var medicalExpense     	= $(".medical-expense").val() || '';
					var socialSecurity		= $(".social-security").val() || '';
					var otherRecipients		= $(".other-recipients").val() || '';
					var statusStatement		= $(".status-statement").val() || '';
					var aboutDatauploadImg	= $(".aboutdata-upload-img");
					var strUserIdCardUploadImg = "";
					var strAboutDatauploadImg  = "";
					
					loading = false;
					
					if (et.isNull(helpPeopleName) && et.isJQueryObject($(".help-people-name"))) {
						alert("请输入姓名");
						return;
					}
					
					if (et.isNull(helpPeopleCardnum) && et.isJQueryObject($(".help-people-cardnum"))) {
						alert("请输入身份证号码");
						return;
					}
					
					if (et.isNull(permanentAddress) && et.isJQueryObject($(".permanent-address"))) {
						alert("请输入户籍地址");
						return;
					}
					
					if (et.isNull(contactNumber) && et.isJQueryObject($(".contact-number"))) {
						alert("请输入联系电话");
						return;
					}
					if (et.isNull(salvageReason) && et.isJQueryObject($(".salvage-reason"))) {
						alert("请输入求助原因");
						return;
					}
					
					if (et.isNull(medicalExpense) && et.isJQueryObject($(".medical-expense"))) {
						alert("请输入已支付医疗费用");
						return;
					}
					
					if (et.isNull(socialSecurity) && et.isJQueryObject($(".social-security"))) {
						alert("请输入社保报销金额");
						return;
					}
					
					if (et.isNull(statusStatement) && et.isJQueryObject($(".status-statement"))) {
						alert("请输入情况说明");
						return;
					}
					
					if (helpSubmitMsgselect == "0" && et.isJQueryObject($(".help-submit-msgselect"))) {
						alert("请选择镇街");
						return;
					}
					
					if (!et.isJQueryObject(userIdCardUploadImg) && et.isJQueryObject($(".id-card-pic"))) {
						alert("请上传身份证图片");
						return;
					} else {
						for (var i = 0; i < userIdCardUploadImg.length; i++) {
							if (!et.isNull(strUserIdCardUploadImg)) {
								strUserIdCardUploadImg += "|";
							}
							
							var src = $(userIdCardUploadImg[i]).attr("src");
							
							if (src.indexOf("?") != -1) {
								strUserIdCardUploadImg += src.substr(0, src.indexOf("?"));
							} else {
								strUserIdCardUploadImg += src;
							}
						}
					}
					
					if (!et.isJQueryObject(aboutDatauploadImg) && et.isJQueryObject($(".other-info-imgs"))) {
						alert("请上传资料图片");
						return;
					} else {
						for (var i = 0; i < aboutDatauploadImg.length; i++) {
							if (!et.isNull(strAboutDatauploadImg)) {
								strAboutDatauploadImg += "|";
							}
							
							var src = $(aboutDatauploadImg[i]).attr("src");
							
							if (src.indexOf("?") != -1) {
								strAboutDatauploadImg += src.substr(0, src.indexOf("?"));
							} else {
								strAboutDatauploadImg += src;
							}
						}
					}
					
					if (fnJudge($(".help-people-name"),helpPeopleName) && fnJudge($(".help-people-cardnum"),helpPeopleCardnum)
							&& fnJudge($(".help-submit-msgselect"),helpSubmitMsgselect) && fnJudge($(".permanent-address"),permanentAddress)
							&& fnJudge($(".useridcard-upload-img"),strUserIdCardUploadImg) && fnJudge($(".useridcard-upload-img"),strUserIdCardUploadImg)
							&& fnJudge($(".contact-number"),contactNumber) && fnJudge($(".salvage-reason"),salvageReason)
							&& fnJudge($(".medical-expense"),medicalExpense) && fnJudge($(".social-security"),socialSecurity)
							&& fnJudge($(".status-statement"),statusStatement)
							&& fnJudge($(".aboutdata-upload-img"),strAboutDatauploadImg)) {
						et.json(et.url("act/help/addHelpInfor"), function(json) {
							if (et.jsonDecode.hasErr(json)) {
								et.jsonDecode.showErr(json);
							} else {
								alert("申请救助信息提交已成功");
								et.redirect(et.url("user/needhelp/helpAction?no=" + no));
							}
						}, {id:id, type: et.getQueryString("no"), helpNm: helpPeopleName, helpId: helpPeopleCardnum, helpAddr: permanentAddress, handy: contactNumber, reason: salvageReason, medicalExpense: medicalExpense, socialSecurity: socialSecurity, otherRecipients: otherRecipients, statusStatement: statusStatement, town: helpSubmitMsgselect, idcardImg: strUserIdCardUploadImg, aboutDataImg: strAboutDatauploadImg});
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