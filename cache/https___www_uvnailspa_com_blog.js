$(document).ready(function(){

	var url = $(location).attr('href');
	var page = url.substr(url.lastIndexOf('/') + 1).trim();

	if(page == '') page = 'home';
	$('#header-centered a[name="'+page+'"]').addClass('active');
	

});



    var badge_element = document.getElementById("yelp-biz-badge-rrc-gov8xP1iEXkEvV50Qubp0A");
    badge_element.innerHTML = "\u003ca href=\"https://www.yelp.com/biz/1058-uv-nail-spa-new-york\"\u003e\u003cimg alt=\"1058 UV Nail Spa\" src=\"https://dyn.yelpcdn.com/extimg/en_US/rrc/gov8xP1iEXkEvV50Qubp0A.png\" height=\"55\" width=\"125\"\u003e\u003c/a\u003e";

    new WOW().init();
(function(d, t) {var g = d.createElement(t);var s = d.getElementsByTagName(t)[0];g.id = "yelp-biz-badge-script-rrc-gov8xP1iEXkEvV50Qubp0A";g.src = "//yelp.com/biz_badge_js/en_US/rrc/gov8xP1iEXkEvV50Qubp0A.js";s.parentNode.insertBefore(g, s);}(document, 'script'));
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-83133433-3', 'auto');
		ga('send', 'pageview');
		