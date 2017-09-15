$(document).ready(function(){

	var flag = false;

	$(window).scroll(function(){

		if($(window).scrollTop() < 5){
			$('#header-scrollout .logo').hide();
			$('#header-scrollout ul').hide();
			if(flag){
				flag = false;
				$('#header-scrollout .wrap').stop().animate({'height' : '0px'}, 500);
			}
		}else{		
			$('#header-scrollout .logo').show();
			$('#header-scrollout ul').show();
			if(!flag){
				flag = true;
				$('#header-scrollout .wrap').stop().animate({'height' : '55px'}, 500);
			}
		}
		
	});

});