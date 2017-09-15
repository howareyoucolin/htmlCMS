$(document).ready(function(){
	
	/**
	* Very simple exception handling:
	**/
	function CzException(message) {
		this.message = message;
		this.name = 'UiException';
	}
	
	/**
	* Text Input handler:
	**/
	$('[data-var]').click(function(e){
		
		e.stopPropagation();
		
		var name = $(this).data('var');
		var ref = $('input[name="'+name+'"]');
		
		//Define box's dimensions:
		var ui = pop_ui({'width':'600px'});
		var box = $('.popui .box');
		
		box.append('<p class="pop-label">'+ref.closest('.unit').find('label').text()+'</p>');
		box.append('<input class="form-control pop-var" />');
		var input =  box.find('input');
		//Add text into input:
		input.val(ref.val());
		
		//Triggered when window is closed:
		ui.on('remove',function(){
			//Copy text back into sidebar text input:
			ref.val(input.val());
			updateText($('[data-var="'+name+'"]'),input.val());
		})
		
	});
	
	/**
	* Select handler:
	**/
	$('[data-select]').click(function(e){
		
		e.stopPropagation();
		
		var name = $(this).data('select');
		var ref = $('select[name="'+name+'"]');
		
		//Define box's dimensions:
		var ui = pop_ui({'width':'600px'});
		var box = $('.popui .box');
		
		box.append('<p class="pop-label">'+ref.closest('.unit').find('label').text()+'</p>');
		box.append('<select class="form-control">'+$('select[name="'+name+'"]').html()+'</select>');
		var select =  box.find('select');
		
		//Triggered when window is closed:
		ui.on('remove',function(){
			var v = select.val();
			//Copy text back into sidebar text input:
			ref.find('option[value="'+v+'"]').prop('selected',true);
			$('[data-select="'+name+'"]').html(v);
		})
		
	});
	
	/**
	* Inline Attr handler:
	**/
	$('[data-inline]').click(function(e){
		
		e.stopPropagation();
		
		var name = $(this).data('inline');
		var ref = $('input[name="'+name+'"]');
		
		//Define box's dimensions:
		var ui = pop_ui({'width':'600px'});
		var box = $('.popui .box');
		
		box.append('<p class="pop-label">'+ref.closest('.unit').find('label').text()+'</p>');
		box.append('<input class="form-control pop-var" />');
		var input =  box.find('input');
		//Add text into input:
		input.val(ref.val());
		
		//Triggered when window is closed:
		ui.on('remove',function(){
			//Copy text back into sidebar text input:
			ref.val(input.val());
		})
		
	});
	
	/**
	* Text Area handler:
	**/
	$('[data-text]').click(function(e){
		
		e.stopPropagation();
		
		var name = $(this).data('text');
		var ref = $('textarea[name="'+name+'"]');
		
		//Define box's dimensions:
		var ui = pop_ui({'width':'100%','height':'100%'});
		var box = $('.popui .box');
		
		box.append('<div class="row"><div class="leftside col-md-6"></div><div class="rightside col-md-6"></div></div>');
		var left = box.find('.leftside');
		var right = box.find('.rightside');
		
		left.append('<p class="pop-label">'+ref.closest('.unit').find('label').text()+' <button class="insert-image btn btn-default">Add Image</button></p>');
		left.append('<form style="display:none;" class="temp-upload"></form>');
		left.append('<textarea class="czeditor"></textarea>');
		
		var tform = $('form.temp-upload');
		tform.append('<input type="file" name="temp" />');
		
		var czeditor =  box.find('.czeditor');
		czeditor.css('height',box.height()-150);
		//Add text into czeditor:
		czeditor.val(ref.val());
		
		right.append('<p class="pop-label">&nbsp;</p>');
		right.append('<div class="czvisual"></div>');
		var czvisual =  box.find('.czvisual');
		czvisual.css('height',box.height()-150);
		
		//CzEditor -> CzVisual:
		czvisual.html(czeditor.val().replace(/\r\n|\r|\n/g,'<br/>'));//Init;
		czeditor.keyup(function() {
			czvisual.html(czeditor.val().replace(/\r\n|\r|\n/g,'<br/>'));
		});
		
		//Prevent redirection:
		czvisual.on('click','a',function(e){
			e.preventDefault();
			return false;
		})
		
		//Triggered when window is closed:
		ui.on('remove',function(e){	
			//Copy text back into sidebar text input:
			ref.val(czeditor.val());
			updateText($('[data-text="'+name+'"]'),czvisual.html());
		})
		
		//Insert a image into textarea:
		$('button.insert-image').click(function(){
			$('input[name="temp"]').trigger('click');
		});
		
	});
	
	/**
	* Input|Textarea Key Up Event
	**/
	$('aside.sys input[type="text"],aside.sys textarea').keyup(function(e){
		
		e.stopPropagation();
		
		var name = $(this).attr('name');
		var el;
		
		if((el=$('[data-var="'+name+'"]')).length>0){
			updateText(el,$(this).val());
		}else{
			updateText($('[data-text="'+name+'"]'),$(this).val().replace(/\r\n|\r|\n/g,'<br/>'));
		}
		
	});
	
	/**
	* Input|Textarea Blur Event, identical effect with above.
	**/
	$('aside.sys input[type="text"],aside.sys textarea').blur(function(e){
		
		e.stopPropagation();
		
		var name = $(this).attr('name');
		var el;
		
		if((el=$('[data-var="'+name+'"]')).length>0){
			updateText(el,$(this).val());
		}else{
			updateText($('[data-text="'+name+'"]'),$(this).val().replace(/\r\n|\r|\n/g,'<br/>'));
		}
		
	});
	
	/**
	* Select Change Event
	**/
	$('aside.sys select').change(function(e){
		
		e.stopPropagation();
	
		var v = $(this).val();
	
		var name = $(this).attr('name');
		$('[data-select="'+name+'"]').html(v);
	
	});
	
	/**
	* Update content for A|T event:
	**/
	var updateText = function(el,txt){
		
		el.html(txt);
		
	};
	
	/**
	* Gallery handler:
	**/
	$('[data-gallery]').click(function(){
		
		var name = $(this).data('gallery');
		$('aside.sys input[name='+name+']').closest('.unit').find('img.multi_images').trigger('click');
		
	});
	$('aside.sys img.multi_images').click(function(){
	
		var ref = $(this).closest('.unit').find('input[type="hidden"]');
		var name = ref.attr('name');
		
		//Define box's dimensions:
		var ui = pop_ui({'width':'800px','height':'600px'});
		var box = $('.popui .box');
		
		box.append('<p class="pop-label">'+ref.closest('.unit').find('label').text()+' <button class="multi-upload btn btn-default">Upload Images</button></p>');
		box.append('<p class="pop-hint">(This supports multiple images upload at one time)</p>');
		
		var multi_upload_btn = $('.multi-upload');
		multi_upload_btn.bind("click", function(){
			$('input[type="file"][name="'+name+'[]"]').trigger('click');
		});
		
		var arrstr = $('input[name="'+name+'"]').val();
		var arr = arrstr.split(",");
		
		box.append('<div class="pop-holder">');
		box.append('<ul>');
		var holder = $('.pop-holder');
		for (var i = 0, len = arr.length; i < len; i++) {
			if(arr[i].trim() != ''){
				holder.append(
				'<li class="ui-state-default"><span style="cursor:pointer;position:absolute;right:-7px;top:-7px;color:#D00;font-size:18px;" class="sys-g-remove glyphicon glyphicon-remove-circle" aria-hidden="true"></span><img src="'+arr[i]+'"/></li>'
				);
			}
		}
		box.append('</ul>');
		box.append('</div>');
		
		holder.sortable({placeholder: "ui-state-highlight"});
		holder.disableSelection();
		
		//Triggered when window is closed:
		ui.on('remove',function(){
			
			var str = '';
			holder.find('img').each(function(){
				str += $(this).attr('src')+',';
			});
			str = str.replace(/,\s*$/, '');
			//Copy text back into sidebar hidden text input:
			ref.val(str);
			
		})
	
	});
	
	/**
	* Remove event:
	**/
	$(document).on('click','.sys-g-remove',function(e){
		e.stopPropagation();
		$(this).parent().remove();
	});
	
	/**
	* Open up a pop UI:
	**/
	var pop_ui = function(param={}){

		$('body').append('<div class="popui"></div>');
		//ui is the root dom of the popup window:
		var ui = $('.popui');
		ui.append('<div class="box"></div>');
		var box = $('.popui .box');
		
		//Set box's properties:
		if(typeof param.height != 'undefined'){box.css('height',param.height);}
		if(typeof param.width != 'undefined'){box.css('width',param.width);}
		//Center the box:
		box.css('margin-left',box.width()/2*(-1)-25).css('margin-top',box.height()/2*(-1)-25);
		
		//Add close button:
		box.append('<div class="exit"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></div>');
		//Add save button:
		box.append('<div class="ok"><button class="btn btn-primary">OK</button></div>');
		
		//Exit: close without change to sidebar:
		box.find('.exit').bind('click',function(){exit(ui)});
		//Exit: close with changes to sidebar:
		box.find('.ok').find('button').bind('click',function(){ok(ui)});
		
		//Returns box object for other modules to customize accordingly:
		return ui;
		
	};
	
	/**
	* Exit the popup UI:
	**/
	var exit = function(el){
		
		//Take off the removal callback event:
		el.off('remove');
		//UI self destroy:
		el.remove();
	
	};
	
	var ok = function(el){
		
		//UI self destroy:
		el.remove();
		
	};
	
	/**
	* Window resize adjustment:
	**/
	$( window ).resize(function(){
	
		var box = $('.popui .box');
		//Center the box:
		box.css('margin-left',box.width()/2*(-1)-25).css('margin-top',box.height()/2*(-1)-25);
		
	});
	
	/**
	* Save Action:
	*/
	$('#top-save a').click(function(e){
		
		e.preventDefault();
		$('aside.sys input[type="submit"]').trigger('click');
		
	});
	
	if(typeof SAVED != 'undefined' && SAVED == true){
		//Define box's dimensions:
		var ui = pop_ui({'width':'400','height':'400'});
		var box = $('.popui .box');
		box.append('<div class="panel panel-success"><div class="panel-heading">System Message:</div><div class="panel-body"><p>&nbsp;</p><p>&nbsp;</p><p>Your changes have been saved! <span style="color:#2c6d3e;font-size:25px;" class="glyphicon glyphicon-ok" aria-hidden="true"></span></p><p>&nbsp;</p><p>&nbsp;</p></div></div>');
	}
	
	/*
	LATER
	$(window).bind("beforeunload", function() { 
		//Define box's dimensions:
		var ui = pop_ui({'width':'400','height':'400'});
		var box = $('.popui .box');
		return false;
	})
	*/
	
	/**
	* Full screen popup window for textarea:
	**/
	$('aside.sys .fullscreen').click(function(){
		var name = $(this).closest('.unit').find('textarea').attr('name');
		$('[data-text="'+name+'"]').trigger('click');
	});

});

