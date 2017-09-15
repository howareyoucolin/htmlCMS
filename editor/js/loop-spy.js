$(document).ready(function(){
	
	/**
	* Very simple exception handling:
	**/
	function CzException(message) {
		this.message = message;
		this.name = 'LoopSpyException';
	}
	
	/**
	* Apply loop-spy on the targeted div, and effect on them:
	**/
	$('.loop-spy').each(function(){
		
		//Init:
		var victim = $(this).next();
		var spy = $(this); 
		var name = spy.data('name');
		victim.append($(this));
		
		//Set positions & styles:
		victim.css('position','relative');
		spy.css('position','absolute').css('top','-7px').css('right','-7px').css('z-index','99999990');
		
		//Set actions:
		spy.click(function(){
			//Delete all associated values within div:
			if(typeof (victim.find('[data-var]')) != 'undefined'){
				victim.find('[data-var]').each(function(){
					$('input[name="'+$(this).data('var')+'"]').val('SYS_REMOVE_MARKER');
				});
			}
			if(typeof (victim.find('[data-inline]')) != 'undefined'){
				victim.find('[data-inline]').each(function(){
					$('input[name="'+$(this).data('inline')+'"]').val('SYS_REMOVE_MARKER');
				});
			}
			if(typeof (victim.find('[data-text]')) != 'undefined'){
				victim.find('[data-text]').each(function(){
					$('textarea[name="'+$(this).data('text')+'"]').val('SYS_REMOVE_MARKER');
				});
			}
			if(typeof (victim.find('[data-photo]')) != 'undefined'){
				victim.find('[data-photo]').each(function(){
					$('input[type="hidden"][name="'+$(this).data('photo')+'"]').val('SYS_REMOVE_MARKER');
				});
			}
			if(typeof (victim.find('[data-bg]')) != 'undefined'){
				victim.find('[data-bg]').each(function(){
					$('input[type="hidden"][name="'+$(this).data('bg')+'"]').val('SYS_REMOVE_MARKER');
				});
			}
			if(typeof (victim.find('[data-gallery]')) != 'undefined'){
				victim.find('[data-gallery]').each(function(){
					$('input[name="'+$(this).data('gallery')+'"]').val('SYS_REMOVE_MARKER');
				});
			}	
			//Remove dom in frontend:
			victim.remove();
		});
	
	});	
	
	/**
	* One extra new element spy:
	**/
	$('.loop-spy[data-name="new"]').each(function(){
		
		//Init:
		var victim = $(this).parent();
		var spy = $(this); 
		//Remove default event handler:
		spy.off('click');
		spy.hide();
		
		//Add a new transparent layer:
		victim.append('<div class="spy-lock"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> ADD NEW</div>');
		var lock = victim.find('.spy-lock');
		lock.css('line-height',lock.height()+'px');
		
		//Init the vars to be not savable:
		var unsavable = function(){
			if(typeof (victim.find('[data-var]')) != 'undefined'){
				victim.find('[data-var]').each(function(){
					var name = $(this).data('var');
					$('input[name="'+name+'"]').attr('name',name+'SYS_REMOVE_MARKER');
				});
			}
			if(typeof (victim.find('[data-inline]')) != 'undefined'){
				victim.find('[data-inline]').each(function(){
					var name = $(this).data('inline');
					$('input[name="'+name+'"]').attr('name',name+'SYS_REMOVE_MARKER');
				});
			}
			if(typeof (victim.find('[data-text]')) != 'undefined'){
				victim.find('[data-text]').each(function(){
					var name = $(this).data('text');
					$('textarea[name="'+name+'"]').attr('name',name+'SYS_REMOVE_MARKER');
				});
			}
			if(typeof (victim.find('[data-photo]')) != 'undefined'){
				victim.find('[data-photo]').each(function(){
					var name = $(this).data('photo');
					$('input[type="hidden"][name="'+name+'"]').attr('name',name+'SYS_REMOVE_MARKER');
				});
			}
			if(typeof (victim.find('[data-bg]')) != 'undefined'){
				victim.find('[data-bg]').each(function(){
					var name = $(this).data('bg');
					$('input[type="hidden"][name="'+name+'"]').attr('name',name+'SYS_REMOVE_MARKER');
				});
			}
			if(typeof (victim.find('[data-gallery]')) != 'undefined'){
				victim.find('[data-gallery]').each(function(){
					var name = $(this).data('gallery');
					$('input[name="'+name+'"]').attr('name',name+'SYS_REMOVE_MARKER');
				});
			}
		};
		
		unsavable();
		
		//Unlock new element:
		lock.click(function(){
			lock.hide();	
			spy.show();
			tosavable();
		});
		
		//Re-Lock 
		spy.click(function(){
			spy.hide();
			lock.show();
			unsavable();			
		});
		
		//Convert the vars to be savable:
		var tosavable = function(){
			if(typeof (victim.find('[data-var]')) != 'undefined'){
				victim.find('[data-var]').each(function(){
					var name = $(this).data('var');
					$('input[name="'+name+'SYS_REMOVE_MARKER"]').attr('name',name);
				});
			}
			if(typeof (victim.find('[data-inline]')) != 'undefined'){
				victim.find('[data-inline]').each(function(){
					var name = $(this).data('inline');
					$('input[name="'+name+'SYS_REMOVE_MARKER"]').attr('name',name);
				});
			}
			if(typeof (victim.find('[data-text]')) != 'undefined'){
				victim.find('[data-text]').each(function(){
					var name = $(this).data('text');
					$('textarea[name="'+name+'SYS_REMOVE_MARKER"]').attr('name',name);
				});
			}
			if(typeof (victim.find('[data-photo]')) != 'undefined'){
				victim.find('[data-photo]').each(function(){
					var name = $(this).data('photo');
					$('input[type="hidden"][name="'+name+'SYS_REMOVE_MARKER"]').attr('name',name);
				});
			}
			if(typeof (victim.find('[data-bg]')) != 'undefined'){
				victim.find('[data-bg]').each(function(){
					var name = $(this).data('bg');
					$('input[type="hidden"][name="'+name+'SYS_REMOVE_MARKER"]').attr('name',name);
				});
			}
			if(typeof (victim.find('[data-gallery]')) != 'undefined'){
				victim.find('[data-gallery]').each(function(){
					var name = $(this).data('gallery');
					$('input[name="'+name+'SYS_REMOVE_MARKER"]').attr('name',name);
				});
			}
		};
	
	});
	
});