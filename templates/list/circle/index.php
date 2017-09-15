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
	if($max=='') $max = 9999;
	$namespace = 'list_circle_'.trim($namespace);
?>
<div class="wrap">

	<div class="container">

		<h2><?php __T($namespace.'title',false);?></h2>
		
		<div class="h50"></div>
		
		<div class="row main">

			<?php while(loop($namespace.'icon_@i',$max)):?>
		
				<div class="col-md-<?php echo $col;?>">
				
					<a style="display:inline-block;" href="<?php $link = __L($namespace.'link_@i',false);if(trim($link)=='') echo 'Javascript:void(0);';?>">
						<img class="icon" src="<?php __P($namespace.'icon_@i',false,true,200,200);?>" />
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