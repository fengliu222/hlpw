$(function() {

	/**
	 * 生成激活码 activeNumber
	 * @return {[type]} [description]
	 */
	$("#subLang").click(function() {
		var lang = $(".createCount").val(); 
		var placename = $("#placename").val();
 		var siteName = $("#partner").val().trim();
		$.get("?m=activeNumber&&a=createAcitiveNumber", {
			lang: lang,
			placename : placename ,
			partnername : siteName
		}, function(data) {
			alert(data["info"]);
		}) 
	});

	/**
	 * 导出验证码 
	 * @return {[type]} [description]
	 */
	$('#activeDate').datepick({
		dateFormat: 'yy-mm-dd'
	});
	$("#exportNum").click(function(){
		var date = $("#activeDate").val();
	 	window.location.href='./?m=activeNumber&&a=exports&&place='+$("#placename").val()+'&&date='+date;
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
	$(".queryInput").bind("keyup",function(e){
		e.preventDefault();
		if(e.which == 13){ 
			querylist();
		}
		
	});

	$(".query").on("click",function(){
		querylist();
	})

	function querylist(){
		var qdata = $(".queryInput").val().trim();
		var place = $("#rl-place").val();
		var queryBy = $("#rl-queryBy").val();
		var tableHtml = "<tr class='theader'><th>姓名</th><th>电话</th><th>身份证号</th><th>预约人数</th><th>预约地点</th><th>预约码</th><th>来自</th><th>游玩时间</th><th>提交时间</th></tr>";
		$.get("./?m=reserList&&a=ajaxQueryList",{
			place:place,
			data:qdata,
			queryBy: queryBy
		},function(data){
			if(data['info']){
				 tableHtml += formatTable(data['info']);

				 var statis = data['info'][1],
				 	 statisHtml = '<table class="table table-striped"><tr class="theader">';
				 for(var i in statis){
				 	statisHtml += '<th>'+ i + '</th>';
				 }
				 statisHtml += "</tr><tr>";
				 for(var j in statis){
				 	statisHtml += '<td>'+ statis[j] + '</td>';
				 }
				 statisHtml += "</tr>";

				 $("#reservationList .form-inline").css("margin-top","0");
				 $("#reserList").html(tableHtml);
				 $(".statisblock").html(statisHtml);
			}else{
				alert("没有查询到预约用户！");
			}
			
		}); 
	}
	$(".exports").on("click",function(){
		window.location.href="./?m=reserList&&a=exportsExc";
	});

	$(".addSite").on("click", function(e){
		e.preventDefault();
		var $this = $(this);
		if($this.val() == "保存"){
			//上传保存新站点逻辑
			var siteName = $(".newSiteName").val().trim();
			
			$.post("./?m=partner&&a=addPartner",{
				name:siteName
			},function(data){
				if(data["data"] == 1){
					window.location.reload();
				}
			});
		}else{
			$(".partnerSelect").toggle();
			$(".newSiteName").toggle();
			$this.val("保存");
		}
	});

	//删除合作站点
	$(".removeSite").on("click",function(){
		var siteName = $("#partner").val().trim();
		if(confirm("是否确认删除此站点？删除后将无法统计此站点的消费码！")){
			$.post("./?m=partner&&a=deletePartner",{name:siteName},function(data){
				if(data['data'] == 1){
					window.location.reload();
				}
			})
		}
	})

	// 数据汇总开始时间绑定
	$('#startDate').datepick({
		dateFormat: 'yy-mm-dd'
	});
	// 数据汇总结束时间绑定
	$('#endDate').datepick({
		dateFormat: 'yy-mm-dd'
	});
	// 数据汇总查询按钮绑定
	$("#checkbtn").on("click",function(){
		$.get('./?m=usednumber&&a=doQuery',{
			start: $('#startDate').val(),
			end: $('#endDate').val()
		},function(data){
			var html = $(data["info"]);
			$(".dataDisplay").html(html.find(".dataDisplay").html());
		});
	});

	function formatTable(data){
		var html = '',
			data = data[0];

		for(var i=0; i < data.length; i++){
			var activeArr = "";
			var fromArr = "";
			for(var j = 0; j<data[i].playerid.split(",").length; j++){
				activeArr += data[i].playerid.split(",")[j] + "</br>"
			}
			for(var k = 0; k<data[i].from.length;k++){
				fromArr += data[i].from[k] + "<br>";
			}
			html += "<tr><td>"+data[i].name+"</td><td>"+data[i].tel+"</td><td>"+data[i].idcard+"</td><td>"+data[i].playercount+"人</td><td>"+data[i].place+"</td><td>"+activeArr+"</td><td>"+fromArr+"</td><td>"+data[i].playdate+"</td><td>"+data[i].createdate.split(" ")[0]+"</td></tr>";
		}
 
		return html;
	}
})