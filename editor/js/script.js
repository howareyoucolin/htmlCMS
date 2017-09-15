$(document).ready(function(){

	//Disable all links in editor main section:
	$('section.sys a').click(function(e){
		//e.stopPropagation();
		e.preventDefault();
		return false;
	});


});