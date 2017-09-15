<?php 
	if(trim(__('module_var'))!=''){
		$arr = array_map('trim', explode(',', __('module_var')));
		$namespace = $arr[0].'_';
		$col = (int)(12/$arr[1]);
		$max = $arr[2];
	}
	else{ 
		$namespace = '';
		$col = 3;
		$max = 9999;
	}
	if(trim($max)=='') $max = 9999;
	$namespace = 'list_photo_'.trim($namespace);
?>
<div class="wrap">

	<div class="container">

		<h2><?php __T($namespace.'title',false);?></h2>
		
		<div class="h50"></div>
		
		<div class="row main">

			<?php $counter = 0;?>
		
			<?php while(loop($namespace.'photo_@i',$max)):?>
				
				<div <?php if(($counter++)%(12/$col)==0) echo 'style="clear:both;"';?> class="col-md-<?php echo $col;?>">
				
					<img src="<?php __P($namespace.'photo_@i',false);?>" />
					
					<div style="clear:both;height:10px;"></div>
					
				</div>
				
			<?php endwhile;?>
			
		</div>
	
	</div>

</div>