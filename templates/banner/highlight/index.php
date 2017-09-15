<?php 
	if(trim(__('module_var'))!=''){
		$arr = array_map('trim', explode(',', __('module_var')));
		$namespace = $arr[0].'_';
		$height = $arr[1];
	}
	else{ 
		$namespace = '';
		$height = 500;
	}
	if($height=='') $max = 500;
	$namespace = 'banner_highlight_'.trim($namespace);
?>
<div class="wrap" style="background:url('<?php __B($namespace.'background?','Background',true,1920,$height);?>');min-height:<?php echo $height;?>px;">

	<div class="container" style="min-height:<?php echo $height;?>px;">

		<div class="guy">
			<img src="<?php __P($namespace.'guy?','Picture');?>">
		</div>
	
	</div>

</div>