<?php
	$height = 360;
	if(trim(__('module_var'))!=''){
		$height = trim(__('module_var'));
	}
?>
<div class="wrap">
	<img src="<?php __P('banner?',false,true,1920,$height);?>" width="100%" height="<?php echo $height;?>" />
</div>

<style>
#banner-simplefullwidth img{height:auto !important;}
</style>