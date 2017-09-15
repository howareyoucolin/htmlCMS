$(document).ready(function(){
	
	/**
	* Very simple exception handling:
	**/
	function CzException(message) {
		this.message = message;
		this.name = 'EffectException';
	}
	
	/**
	* Event when mouse enters the element:
	**/
	var el;
	$('#sys-form input:NOT(.advanced-input), #sys-form textarea, #sys-form img').hover(function(){
	
		var name = $(this).closest('.unit').find('.zoom').data('name');
		
		try{
			//Find the right data type:
			if((el=$('[data-var="'+name+'"]')).length);
			else if((el=$('[data-inline="'+name+'"]')).length);
			else if((el=$('[data-text="'+name+'"]')).length);
			else if((el=$('[data-photo="'+name+'"]')).length); 
			else if((el=$('[data-bg="'+name+'"]')).length); 
			else if((el=$('[data-gallery="'+name+'"]')).length);
			else throw new CzException('Failed to find the associated data type, event aborted!');
		}catch (ex) {
		   console.log(ex.message, ex.name); 
		   return false;//Event stops here due to error.
		}
		
		//Execute event:
		highlight(el,3600000,'hover');
	
	},function(){
		
		el.removeClass('hover');
		
	});
	
	/**
	* Event when focus in text input/area:
	**/
	$('#sys-form input:NOT(.advanced-input), #sys-form textarea').focus(function(){
		
		var name = $(this).attr('name');
		
		try{
			//Find the right data type:
			var el;
			if((el=$('[data-var="'+name+'"]')).length);
			else if((el=$('[data-inline="'+name+'"]')).length);
			else if((el=$('[data-text="'+name+'"]')).length);
			else throw new CzException('Failed to find the associated data type, event aborted!');
		}catch (ex) {
		   console.log(ex.message, ex.name); 
		   return false;//Event stops here due to error.
		}
		
		//Execute events:
		center(el);
		highlight(el);
	
	});
	
	/**
	* Event when click the little search icon:
	**/
	$('#sys-form .zoom').click(function(){
	
		var name = $(this).data('name');
		
		try{
			//Find the right data type:
			var el;
			if((el=$('[data-var="'+name+'"]')).length);
			else if((el=$('[data-inline="'+name+'"]')).length);
			else if((el=$('[data-text="'+name+'"]')).length);
			else if((el=$('[data-photo="'+name+'"]')).length); 
			else if((el=$('[data-bg="'+name+'"]')).length); 
			else if((el=$('[data-gallery="'+name+'"]')).length);
			else throw new CzException('Failed to find the associated data type, event aborted!');
		}catch (ex) {
		   console.log(ex.message, ex.name); 
		   return false;//Event stops here due to error.
		}
		
		//Execute events:
		center(el);
		highlight(el);
	
	});
	
	/**
	* Scroll the element vertically centered in window:
	**/
	var center = function(el){
		
		//Calculate scrolling variables and animate it: 
		var offset = ($(window).height() - el.height())/2;
		$('body').stop().animate({scrollTop:(el.offset().top - offset)}, '3000', 'swing');
		
	};
	
	/**
	* Highlight the element for an amount of time:
	* In fact, there're 2 types of highlight dispite visibly same effect - active/hover
	**/
	var highlight = function(el,t=2000,classname='active'){
	
		//Short highlight effect:
		el.addClass(classname);
		setTimeout(function () { 
			el.removeClass(classname);
		}, t);
	
	};
	
	/**
	* Advanced switch actions:
	**/
	$('aside.sys button.advanced-switch').click(function(e){
		var el = $('aside.sys button.advanced-switch');
		e.preventDefault();
		if($('#advanced').is(':visible')){
			$('#advanced').slideUp( "slow", function() {
				el.text(' + ');
			});
		}else{
			$('#advanced').slideDown( "slow", function() {
				$('aside.sys').stop().animate({scrollTop:($('#advanced').offset().top+100)}, 'slow', 'swing');
				el.text(' - ');
			});
		}
		return false;
	});

});
