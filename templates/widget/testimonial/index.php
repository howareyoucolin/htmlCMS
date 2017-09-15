<?php 
	
	$namespace = '';
	$col = '';
	$max = '';

	if(trim(__('module_var'))!=''){
		$arr = array_map('trim', explode(',', __('module_var')));
		$namespace = $arr[0].'_';
		if(isset($arr[1]) and trim($arr[1])!='') $col = (int)(12/$arr[1]);
		if(isset($arr[2]) and trim($arr[2])!='') $max = $arr[2];
		
	}
	else{ 
		$namespace = '';
		$col = 3;
		$max = 9999;
	}
	if(trim($col)=='') $col = 3;
	if(trim($max)=='') $max = 9999;
	$namespace = 'widget_testimonial_'.trim($namespace);
?>
<div class="wrap">

	<div class="container">

		<x><h2><?php __T($namespace.'title',false);?></h2>
		
		<div class="h50"></div></x>
		
		<div class="row main">

			<?php $counter = 0;?>
		
			<?php while(loop($namespace.'name_@i',$max)):?>
				
				<div <?php if(($counter++)%(12/$col)==0) echo 'style="clear:both;"';?> class="col-md-<?php echo $col;?> unit">
				
					<div class="inner">
						
						<div>
							<b><?php __T($namespace.'name_@i');?></b>
							<p><?php __A($namespace.'review_@i');?></p>
						</div>
						
						<div class="triangle">
							<div class="core">
							</div>
						</div>
						
						<div class="icon">
							<img src="<?php __P($namespace.'headicon_@i',false,true,50,50);?>"/>
						</div>
					
					</div>
					
				</div>
				
			<?php endwhile;?>
			
		</div>
	
	</div>

</div>