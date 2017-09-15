$(document).ready(function(){
	
	/**
	* Very simple exception handling:
	**/
	function CzException(message) {
		this.message = message;
		this.name = 'PhotoException';
	}
	
	/**
	* Trigger single image upload:
	**/
	$('aside.sys img.single_image').click(function(){
	
		$(this).closest('.unit').find('input[type="file"]').trigger('click');
	
	});
	$('[data-photo],[data-bg]').click(function(e){
		
		e.stopPropagation();
		e.preventDefault();
		
		try{
			//Find file input name:
			var name;
			if(typeof (name = $(this).data('photo')) != 'undefined');
			else if(typeof (name = $(this).data('bg')) != 'undefined');
			else throw new CzException('Failed to find the input name, event aborted!');
		}catch (ex) {
		   console.log(ex.message, ex.name); 
		   return false;//Event stops here due to error.
		}
		
		$('aside.sys').find('input[type="file"][name="'+name+'"]').trigger('click');
	
		return false;
	});
	
	/**
	* Ajax handling single image upload:
	**/
	$('aside.sys input.single[type="file"]').change(function(e){
	
		if($(this).val().trim() == '') return false;
		e.preventDefault();
	
		$('.loading').show();
	
		var name = $(this).attr('name');
		var width = $(this).data('w');
		var height = $(this).data('h');
		var thumb_width = $(this).data('tw');
		var thumb_height = $(this).data('th');
        var formData = new FormData($(this).parents('form')[0]);
		
		 $.ajax({
			data: formData,
            cache: false,
            contentType: false,
            processData: false,
            url: 'image.php?name='+name+'&w='+width+'&h='+height+'&tw='+thumb_width+'&th='+thumb_height,
            type: 'POST',
            success: function(data) {
				var data_url = '';
				if(imageExists(data_url = data+'?'+(new Date()).getTime())){
					var el = $('aside.sys input[type="hidden"][name="'+name+'"]');
					el.val(data);
					el.closest('.unit').find('img').attr('src',data_url);
					if($('[data-photo='+name+']').length > 0){
						$('[data-photo='+name+']').attr('src',data_url);
					}
					else if($('[data-bg='+name+']').length > 0){
						var t = $('[data-bg='+name+']').attr('style');
						t = t.replace(/\(\s*[\'\"](.*?)[\'\"]\s*\)/g, '("'+data_url+'")');
						$('[data-bg='+name+']').attr('style',t);
					}
				}	
				$('.loading').hide();
            }
        });
		
		//Reset:
		$(this).val('');
        return false;
	
	});
	
	/**
	* Ajax handling multiple image upload:
	**/
	$('aside.sys input.multi[type="file"]').change(function(e){
	
		if($(this).val().trim() == '') return false;
		e.preventDefault();
	
		$('.loading').show();
	
		var name = $(this).attr('name');
		var width = $(this).data('w');
		var height = $(this).data('h');
		var thumb_width = $(this).data('tw');
		var thumb_height = $(this).data('th');
        var formData = new FormData($(this).parents('form')[0]);
		
		 $.ajax({
			data: formData,
            cache: false,
            contentType: false,
            processData: false,
            url: 'gallery.php?name='+name+'&w='+width+'&h='+height+'&tw='+thumb_width+'&th='+thumb_height,
            type: 'POST',
            success: function(data) {
				var arr = [];
				var re = /^\[(.*?)\]$/;
				if(data.match(re)){
					var str = data.replace(/\[|\]/gi, '');
					arr = str.split(',');
				}
				var holder = $('.pop-holder');
				for (var i = 0, len = arr.length; i < len; i++) {
					if(arr[i].trim() != ''){
						holder.append(
						'<li class="ui-state-default"><span style="cursor:pointer;position:absolute;right:-7px;top:-7px;color:#D00;font-size:18px;" class="sys-g-remove glyphicon glyphicon-remove-circle" aria-hidden="true"></span><img src="'+arr[i]+'"/></li>'
						);
					}
				}
				$('.loading').hide();
            }
        });
		
		//Reset:
		$(this).val('');
        return false;
	
	});
	
	/**
	* Check if image exists:
	**/
	var imageExists = function(image_url){
		var http = new XMLHttpRequest();
		http.open('HEAD', image_url, false);
		http.send();
		return http.status != 404;
	}
	
	/**
	* Delete image/background action(Sidebar):
	**/
	$('aside.sys .delete_image').click(function(e){
		e.stopPropagation();
		var name = $(this).closest('.unit').find('input[type="hidden"]').attr('name');
		$(this).closest('.unit').find('img').attr('src','../assets/images/void.png');
		$(this).closest('.unit').find('input[type="hidden"]').val('');
		if($('[data-photo="'+name+'"]').length){
			$('[data-photo="'+name+'"]').attr('src','../assets/images/void.png');
		}else if($('[data-bg="'+name+'"]').length){
			var t = $('[data-bg='+name+']').attr('style');
			t = t.replace(/\(\s*[\'\"](.*?)[\'\"]\s*\)/g, '("../assets/images/bg.png")');
			$('[data-bg='+name+']').attr('style',t);
		}
	});
	
	var adjust_pic_remove_position = function(image_el,remove_el){
		var ileft = image_el.position().left;
		var itop = image_el.position().top;
		var margin_left = image_el.css('margin-left').replace('px','');
		var margin_top = image_el.css('margin-top').replace('px','');
		var z_index = image_el.css('z-index');
		remove_el.css('top',itop*1+margin_top*1);
		remove_el.css('left',ileft*1+margin_left*1);
		remove_el.css('z-index',z_index*1+1);
	};
	
	/**
	* Bind Delete image/background action to each photo dom(Content):
	**/
	$('[data-photo],[data-bg]').each(function(){
		var name;
		if(typeof (name=$(this).data('photo'))!='undefined');
		else if(typeof (name=$(this).data('bg'))!='undefined');
		$(this).before('<div data-remove="'+name+'" class="pic-remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></div>');
		adjust_pic_remove_position($(this),$('[data-remove="'+name+'"].pic-remove'));
		//Bind event:
		$('[data-remove="'+name+'"].pic-remove').click(function(e){
			e.preventDefault();
			e.stopPropagation();
			$('input[type="hidden"][name="'+name+'"]').closest('.unit').find('.delete_image').trigger('click');
		});
	});
	
	/**
	* Window resize adjustment:
	**/
	$( window ).resize(function(){
		$('[data-photo],[data-bg]').each(function(){
			var name;
			if(typeof (name=$(this).data('photo'))!='undefined');
			else if(typeof (name=$(this).data('bg'))!='undefined');
			adjust_pic_remove_position($(this),$('[data-remove="'+name+'"].pic-remove'));
		});
	});
	/**
	* Image change adjustment:
	**/
	$('[data-photo],[data-bg]').load(function(){
		$('[data-photo],[data-bg]').each(function(){
			var name;
			if(typeof (name=$(this).data('photo'))!='undefined');
			else if(typeof (name=$(this).data('bg'))!='undefined');
			adjust_pic_remove_position($(this),$('[data-remove="'+name+'"].pic-remove'));
		});
	});
	
	/**
	* Ajax handling temp image upload:
	**/
	$('body').on('change','input[type="file"][name="temp"]',function(e){
	
		if($(this).val().trim() == '') return false;
		e.preventDefault();
	
		$('.loading').show();
 
        var formData = new FormData($(this).parents('form')[0]);
		
		 $.ajax({
			data: formData,
            cache: false,
            contentType: false,
            processData: false,
            url: 'timage.php',
            type: 'POST',
            success: function(data) {
				var data_url = '';
				if(imageExists(data_url = data+'?'+(new Date()).getTime())){
					var cursorPosition = $('.czeditor').prop("selectionStart");
					var txt = $('.czeditor').val();
					var front = txt.substring(0,cursorPosition);
					var end = txt.substring(cursorPosition);
					$('.czeditor').val(front+"\r\n\r\n"+'<img src="'+data_url+'" />'+"\r\n\r\n"+end);
				}
				$('.czeditor').trigger('keyup');
				$('.loading').hide();
            }
        });
		
		//Reset:
		$(this).val('');
        return false;
	
	});
	
});