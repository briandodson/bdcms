$(document).ready(function(){
closetimer = 0;
	if($("#nav")) {
		$("#nav b").mouseover(function() {
		clearTimeout(closetimer);
			if(this.className.indexOf("clicked") != -1) {
				$(this).parent().next().slideUp(500);
				$(this).removeClass("clicked");
			}
			else {
				$("#nav b").removeClass();
				$(this).addClass("clicked");
				$("#nav ul:visible").slideUp(500);
				$(this).parent().next().slideDown(500);
			}
			return false;
		});
		$("#nav2").mouseover(function() {
		clearTimeout(closetimer);
		});
		$("#nav2").mouseout(function() {
			closetimer = window.setTimeout(function(){
			$("#nav2 ul:visible").slideUp(100);
			$("#nav2 b").removeClass("clicked");
			}, 10);
		}); 
	}		
});
