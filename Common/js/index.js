$(function() {
	var res;
	/**
	 * 日历初始化
	 * @type {String}
	 */

	$('#ariDate').datepick({
		dateFormat: 'yy-mm-dd'
	});


	/**
	 * 表单验证绑定
	 * @type {Boolean}
	 */

	$("#theForm").validationEngine("attach", {
		ajaxFormValidation: true,
		ajaxFormValidationURL: "?m=Index&&a=formFormat",
		ajaxFormValidationMethod: "post",
		onAjaxFormComplete: ajaxForm
	});

	/**
	 * 表单整理信息回调
	 * @param  {[type]} status  [description]
	 * @param  {[type]} form    [description]
	 * @param  {[type]} data    返回信息数组
	 * @param  {[type]} options [description]
	 * @return {[type]}         [description]
	 */

	function ajaxForm(status, form, data, options) {
		
		res = data[0][""];
		if (data[1]) {
			$("#inputForm").addClass("dn");
			$("#confirmForm").removeClass("dn");

			$("#confirmName").html(res[0]);
			$("#confirmTel").html(res[1]);
			$("#confirmID").html(res[2]);
			$("#confirmDate").html(res[3]);
			$("#confirmCount").html(res[4]);
		}

	}

	/**
	 * 事件绑定
	 * @return {[type]} [description]
	 */

	$("#reConfirm").click(function(){
				$("#inputForm").removeClass("dn");
				$("#confirmForm").addClass("dn");
			});

	$("#doConfirm").bind('click',function(){
		$.post("?m=Index&&a=saveBuy",{'name':res[0],'tel':res[1],'idcard':res[2],'playdate':res[3],'playercount':res[4],'playerid':res[5]},function(data){
			alert(data['msg']);
			window.location.reload();
		});
	});

	$(".addYZM").each(function() {
		var self = this;
		$(this).bind("click", function() {
			var copyEle = $(self).parents(".passBlock").clone(true);

			copyEle
				.find(".activeNumber")
				.val("")
				.end()
				.find(".ifIcon")
				.attr({"src": "common/img/nIcon.png"})
				.show();

			$(this)
				.parents(".passBlock")
				.after(copyEle);

			$(".passBlock").each(function(i) {
				$(this)
					.find("input[name^='passNumber_']")
					.attr("name", "passNumber_" + i)
					.attr("id", "passNumber_" + i)
					.end()
					.find("control-label")
					.attr("for", "passNumber_" + i);
			})


		});
	});

	$(document).delegate(".ifIcon", "click", function() {
		$(this).parents(".passBlock").remove();
	})

});