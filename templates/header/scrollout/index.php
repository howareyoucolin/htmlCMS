<?php
if(trim(__('module_var'))!=''){
	$menu_array = array_map('trim', explode(',', __('module_var')));
}
?>
<div class="wrap">

	<div class="container">
	
		<img class="logo" src="<?php __P('logo','Logo',true,0,120);?>" />
	
		<ul class="pull-right">
			<?php foreach($menu_array AS $item):?>
				<?php $parts = array_map('trim', explode('|', $item));?>
				<li><a class="scrollto" data-scrollto="scrollto_<?php echo $parts[0];?>" href="javascript:void(0);"><?php echo $parts[1];?></a></li>
			<?php endforeach;?>
		</ul>
	
	</div>

</div>

<script>
$(document).ready(function(){
	$('.scrollto').click(function(){
		var to = $(this).data('scrollto');
		var y = $('#'+to).offset().top;
		$('html, body').stop().animate({
			scrollTop: y
		}, 2000);
	});
});
</script>