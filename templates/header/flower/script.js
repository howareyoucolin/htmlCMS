$(document).ready(function(){

	var url = $(location).attr('href');
	var page = url.substr(url.lastIndexOf('/') + 1).trim();

	if(page == '') page = 'home';
	$('#header-flower a[name="'+page+'"]').addClass('active');
	

});