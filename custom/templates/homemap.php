<script combine>
$(document).ready(function(){
	
	var loadingline = $('#about-info .map').offset().top/2;
	var loadmap = function() {
		console.log(loadingline+' '+($(window).scrollTop()+ $(window).height() + 300));
		if($('#about-info .map iframe').length){
			$(window).unbind("scroll");
		}
		else if($(window).scrollTop()+ $(window).height() + 300>loadingline){
			$('#about-info .map').html('<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3021.9138694135104!2d-73.96737908414404!3d40.76391907932645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258e8cac878ad%3A0x62b935180637d493!2s1058+3rd+Ave%2C+New+York%2C+NY+10065!5e0!3m2!1sen!2sus!4v1490320053397" width="600" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>');
			
		}
	}
	loadmap();
	$(window).scroll(loadmap);
	
});
</script>