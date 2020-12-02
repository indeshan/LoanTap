	/**
	* @author : Shanteshwar Inde
	**/
	
function change(percentage){ 
	var id = $("#progress-bar");
	if(percentage > 0){ 
		id.animate({'width':''+percentage+'%'}, 200);
	}
}

$(document).ready(function(){
	change(0);
	$('#button').on('click',function(){
		$('#button').attr("disabled","disabled");
		$("#file").hide();
		$("#frame").attr("src","operation.php");
		setTimeout(ajaxCall, 2000);
	});
});

function ajaxCall(){
	$.ajax({
		url: 'progress.php',
		success: function(data){
			data = JSON.parse(data);
			$("#progress-bar").html(data.percent + "%");
			change(data.percent);
			if(data.percent<100)
				ajaxCall();
			else
			{
				$("#button").removeAttr("disabled");
				window.open(data.file_name);
			}
		},
		error: function(){
			alert("There was some error fetching the data");
		}
	});
}