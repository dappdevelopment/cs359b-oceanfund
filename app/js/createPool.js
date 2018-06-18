$(document).ready(function(){

	var addedAt = -1;

	$("#ques-interest").on("input propertychange paste", function(){
		var that = this;		
		if($(that).val() !== ""){
			if(addedAt >= 0){
				$(that).val($(that).val().substring(0, addedAt) + $(that).val().substring(addedAt+1));
			}
			$(that).val($(that).val() + "%");
			addedAt = $(that).val().length - 1;
		}else{
			addedAt = -1;
		}
	});
});