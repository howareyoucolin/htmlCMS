<?php 
	if(trim(__('module_var'))!=''){
		$arr = array_map('trim', explode(',', __('module_var')));
		$col = (int)(12/$arr[0]);
		$max = $arr[1];
	}
	else{ 
		$col = 3;
		$max = 9999;
	}
	if($max=='') $max = 9999;
?>
<div class="wrap">

	<div class="container">

		<h2><?php __T('title?','Title');?></h2>
		
		<div class="h50"></div>
		
		<div class="row main">

			<?php while(loop('icon_@i?',$max)):?>
			
			
				<div class="col-md-<?php echo $col;?>">
					
					<img class="icon" src="<?php __P('icon_@i?',false,true,300,200);?>" />
					
					<p>&nbsp;</p>
					
					<x>
					<h3><?php __T('list_title_@i?',false);?></h3>
					<p>&nbsp;</p>
					</x>
					
					<p class="text"><?php __A('content_@i?',false);?></p>
				
					<p>&nbsp;</p>
					
				</div>
				
			
		
			<?php endwhile;?>
			
		</div>
	
	</div>

</div>