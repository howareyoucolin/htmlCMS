$(document).ready(function(){

	var url = $(location).attr('href');
	var page = url.substr(url.lastIndexOf('/') + 1).trim();

	if(page == '') page = 'home';
	$('#header-centered a[name="'+page+'"]').addClass('active');
	

});



    var badge_element = document.getElementById("yelp-biz-badge-rrc-gov8xP1iEXkEvV50Qubp0A");
    badge_element.innerHTML = "\u003ca href=\"https://www.yelp.com/biz/1058-uv-nail-spa-new-york\"\u003e\u003cimg alt=\"1058 UV Nail Spa\" src=\"https://dyn.yelpcdn.com/extimg/en_US/rrc/gov8xP1iEXkEvV50Qubp0A.png\" height=\"55\" width=\"125\"\u003e\u003c/a\u003e";

    new WOW().init();

$(document).ready(function(){
	if(poopout==true){
		setTimeout(
		function() {
		  $('#custom-promotionpopup').fadeIn("slow",function(){
			$('#custom-promotionpopup .popup .mid').addClass('swing animated');
		  });
		}, 5000);
		$('#custom-promotionpopup .popup .mid .closez').click(function(){$('#custom-promotionpopup').remove();});
	}
});

	$(document).ready(function(){
		$('.mix-holder').mixitup();
	});

$(document).ready(function() {
	$('.gallery-holder').magnificPopup({
	  delegate: 'a',
	  type: 'image',
	  gallery:{enabled:true}
	});
});
(function(d, t) {var g = d.createElement(t);var s = d.getElementsByTagName(t)[0];g.id = "yelp-biz-badge-script-rrc-gov8xP1iEXkEvV50Qubp0A";g.src = "//yelp.com/biz_badge_js/en_US/rrc/gov8xP1iEXkEvV50Qubp0A.js";s.parentNode.insertBefore(g, s);}(document, 'script'));
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

		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-83133433-3', 'auto');
		ga('send', 'pageview');
		