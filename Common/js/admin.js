$(function() {

	/**
	 * 生成激活码 activeNumber
	 * @return {[type]} [description]
	 */
	$("#subLang").click(function() {
		var lang = $(".createCount").val();
		var placename = $("#placename").val();
 
		$.get("?m=activeNumber&&a=createAcitiveNumber", {
			lang: lang,
			placename : placename
		}, function(data) {
			alert(data["info"]);
		})
	});

	/**
	 * 导出验证码
	 * @return {[type]} [description]
	 */
	$("#exportNum").click(function(){
		 window.location.href='./?m=excel&&a=export_data&&place='+$("#placename").val();
	})
	/**
	 * 删除景点 placeControl
	 * @return {[type]} [description]
	 */
	$(document).delegate(".del", "click", function() {
		var that = this;
		$.post("./?m=placeControl&&a=deletePlace", {
			"placename": $(this).parent().find("input[name=oldname]").val()
		}, function(data) {
 
			if(data['data']) $(that).parent().remove();
			else alert(data['info']);
		});
	});

	/**
	 * 取消添加景点 placeControl
	 * @return {[type]} [description]
	 */
	$(document).delegate(".cancel", "click", function() {
		$(this).parent().remove();
	})

	/**
	 * 添加景点 placeControl
	 * @return {[type]} [description]
	 */
	$("#addPlace").bind("click", function() {
		var panel = $("#placecontrol .place");
		var newLable = '<form  class="listForm form-inline" action="./?m=placeControl&&a=addPlace" method="POST"><input type="text" name="placename" value="" /><select name="available"><option value="1"  selected="selected">可用</option><option value="0">不可用</option></select><input type="submit" class="btn btn-primary sub" value="确认添加" /></form>';


		panel.append(newLable);


	})

	/**
	 * 预约查询
	 * @return {[type]} [description]
	 */
	$(".queryBlock input").bind("keyup",function(e){
		
		if(e.which == 13){
			var qdata = $(this).val().trim();
			var place = $("#rl-place").val();
			var tableHtml = "<tr class='theader'><th>姓名</th><th>电话</th><th>身份证号</th><th>预约人数</th><th>预约地点</th><th>预约码</th><th>游玩时间</th><th>提交时间</th></tr>";
			$.get("./?m=reserList&&a=ajaxQueryList",{
				place:place,
				data:qdata
			},function(data){
				if(data['info']){
					 tableHtml += formatTable(data['info']);
					 $("#reserList").html(tableHtml);
				}else{
					alert("没有查询到预约用户！");
				}
				
			});
		}
		
	});

	function formatTable(data){
		var html = '';
		for(var i=0; i < data.length; i++){
			var activeArr = "";
			for(var j = 0; j<data[i].playerid.split(",").length; j++){
				activeArr += data[i].playerid.split(",")[j] + "</br>"
			}
			html += "<tr><td>"+data[i].name+"</td><td>"+data[i].tel+"</td><td>"+data[i].idcard+"</td><td>"+data[i].playercount+"人</td><td>"+data[i].place+"</td><td>"+activeArr+"</td><td>"+data[i].playdate+"</td><td>"+data[i].createdate.split(" ")[0]+"</td></tr>";
			
			
		}
		return html;
	}
})