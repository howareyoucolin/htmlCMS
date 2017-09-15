<?php 
	
	$namespace = '';
	$col = '';
	$height = '';
	$width = '';
	$max = '';

	if(trim(__('module_var'))!=''){
		$arr = array_map('trim', explode(',', __('module_var')));
		$namespace = $arr[0].'_';
		if(isset($arr[1]) and trim($arr[1])!='') $col = (int)(12/$arr[1]);
		if(isset($arr[3]) and trim($arr[3])!='') $height = trim($arr[3]);
		if(isset($arr[4]) and trim($arr[4])!='') $width = trim($arr[4]);
		if(isset($arr[2]) and trim($arr[2])!='') $max = $arr[2];
		
	}
	else{ 
		$namespace = '';
		$col = 3;
		$height = 540;
		$width = 360;
		$max = 9999;
	}
	if(trim($col)=='') $col = 3;
	if(trim($max)=='') $max = 9999;
	if(trim($height)=='') $height = 540;
	if(trim($width)=='') $width = 360;
	$namespace = 'list_rectangle_'.trim($namespace);
?>
<div class="wrap">

	<div class="container">

		<x><h2><?php __T($namespace.'title',false);?></h2>
		
		<div class="h50"></div></x>
		
		<div class="row main">

			<?php $counter = 0;?>
		
			<?php while(loop($namespace.'icon_@i',$max)):?>
				
				
				
				<div <?php if(($counter++)%(12/$col)==0) echo 'style="clear:both;"';?> class="col-md-<?php echo $col;?> unit">
				
					<div class="inner">
				
					<a style="display:inline-block;<?php if(MODE=='editor') echo 'padding:10px;';?>" href="<?php $link = __L($namespace.'link_@i',false);if(trim($link)=='') echo 'JavaScript:Void(0);';?>">
						<img class="icon" src="<?php __P($namespace.'icon_@i',false,true,$height,$width);?>" />
					</a>
					
					<p>&nbsp;</p>
					
					<x>
					<h3><?php __T($namespace.'list_title_@i',false);?></h3>
					<p>&nbsp;</p>
					</x>
					
					<p class="text"><?php __A($namespace.'content_@i',false);?></p>
				
					<p>&nbsp;</p>
					
					</div>
					
				</div>
				
			<?php endwhile;?>
			
		</div>
	
	</div>

</div>