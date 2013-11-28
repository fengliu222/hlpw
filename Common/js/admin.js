$(function() {

	$("#subLang").click(function() {

		var lang = $(this).prev().val();
		var placename = $("#placename").val();

		$.get("?m=activeNumber&&a=createAcitiveNumber", {
			lang: lang,
			placename : placename
		}, function(data) {
			alert(data["info"]);
		})
	});

	$(document).delegate(".del", "click", function() {
		var that = this;
		$.post("./?m=placeControl&&a=deletePlace", {
			"placename": $(this).parent().find("input[name=oldname]").val()
		}, function(data) {
 
			if(data['data']) $(that).parent().remove();
			else alert(data['info']);
		});
	});

	$(document).delegate(".cancel", "click", function() {
		$(this).parent().remove();
	})

	$("#addPlace").bind("click", function() {
		var panel = $("#placecontrol .place");
		var newLable = '<form  class="listForm form-inline" action="./?m=placeControl&&a=addPlace" method="POST"><input type="text" name="placename" value="" /><select name="available"><option value="1"  selected="selected">可用</option><option value="0">不可用</option></select><input type="submit" class="btn btn-primary sub" value="确认添加" /></form>';


		panel.append(newLable);


	})
})