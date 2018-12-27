var fnAClickBtn = function() {
	$(".aclick-btn").each(function() {
		$(this).off("tap").tap(function(e) {
			var urlData = $(this).data("url") || '';
			
			if (!et.isNull(urlData)) {
				$(this).animate({opacity: 0.5}, 200, "ease-out", function() {
					$(this).animate({opacity: 1}, 200, "ease-out", function() {
						eval(urlData);
					});
				});
			}
			
			et.stop.process(e);
		});
	});
};

var fnBackTop = {
	_prop: {
		id: ".pack-top-viewer"
	}
	,create: function() {
		var html = '<div class="' + this._prop.id.substr(1) + ' bottom-to-top cp-totop display-none">';
		html += '<i class="cp-icon-totop opc85">顶部</i>';
		html += '</div>';
		
		$(this._prop.id).remove();
		$(html).appendTo($(".main-container"));
		
		$(this._prop.id).off("tap").tap(function() {
			$(this).scrollTo();
		})
	}
	,show: function() {
		et.css.visit(this._prop.id);
	}
	,hide: function() {
		et.css.hidden(this._prop.id);
	}
};

var fnNoResult = {
	_prop: {
		id: ".no-result-data"
	}
	,show: function(callback) {
		var html = '<div class="' + this._prop.id.substr(1) + ' text-center search-nogood">很抱歉，没有找到相关的宝贝。</div>'
		
		$(this._prop.id).remove();
		$(html).appendTo($(".main-container"));
		
		$(this._prop.id).fadeIn(300, function() {
			if (!et.isNull(callback) && et.isFunction(callback)) {
				callback();
			}
		});
	}
	,hide: function(callback) {
		$(this._prop.id).fadeOut(300, function() {
			if (!et.isNull(callback) && et.isFunction(callback)) {
				callback();
			}
		});
	}
	,isShow: function() {
		var propObj = $(this._prop.id);
		return et.isJQueryObject(propObj) && propObj.css('display') != 'none' ? true : false;
	}
};

require(["template", "page", "lazyload"], function(templateObj) {
	/**
	 * 强制刷新
	 */
	if (!et.isNull($(".token").val() || '') && !et.isTrue($(".isDebug").val())) {
		et.json(et.url("extendAuthfuns/user/chk"), function(json) {
			if (et.jsonDecode.hasErr(json)) {
				if (!!(window.attachEvent && !window.opera)) {
					document.execCommand("stop");
				} else {
					window.stop();
				}
				window.location.reload(true);
			} else {
			}
		});
	}
	
	/**
	 * 底部导航中间按钮效果
	 */
	if (et.isJQueryObject($(".cf-icon-select"))) {
		$(".cf-icon-select").off("tap").tap(function() {
			$(".cf-foot-midnav").fadeIn();
			$(".cf-icon-select-click").fadeIn();
			$(".cf-icon-select").fadeOut();
		});
		$(".cf-icon-select-click").on("tap", function() {
			$(".cf-foot-midnav").fadeOut();
			$(".cf-icon-select-click").fadeOut();
			$(".cf-icon-select").fadeIn();
		});			
	}
	
	
	fnAClickBtn();
	
	if (window.addEventListener) {
		window.addEventListener('resize', function () {
			if (document.activeElement.tagName == 'INPUT' || document.activeElement.tagName == 'TEXTAREA') {
				window.setTimeout(function () {
					document.activeElement.scrollIntoViewIfNeeded();
				}, 0);
			}
		}, false);
	}
});