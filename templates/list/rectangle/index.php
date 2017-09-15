<?php 
	if(trim(__('module_var'))!=''){
		$arr = array_map('trim', explode(',', __('module_var')));
		$namespace = $arr[0].'_';
		$col = (int)(12/$arr[1]);
		$height = trim($arr[2]);
		$width = trim($arr[3]);
		$max = $arr[4];
		
	}
	else{ 
		$namespace = '';
		$col = 3;
		$height = 540;
		$width = 360;
		$max = 9999;
	}
	if(trim($max)=='') $max = 9999;
	if(trim($height)=='') $height = 540;
	if(trim($width)=='') $max = 360;
	$namespace = 'list_rectangle_'.trim($namespace);
?>
<div class="wrap">

	<div class="container">

		<h2><?php __T($namespace.'title',false);?></h2>
		
		<div class="h50"></div>
		
		<div class="row main">

			<?php $counter = 0;?>
		
			<?php while(loop($namespace.'icon_@i',$max)):?>
				
				
				
				<div <?php if(($counter++)%(12/$col)==0) echo 'style="clear:both;"';?> class="col-md-<?php echo $col;?>">
				
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
				
			<?php endwhile;?>
			
		</div>
	
	</div>

</div>