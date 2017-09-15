<div class="wrap">

	<div class="container">
	
		<a class="logo" href="<?php echo SITE_URL;?>"><img src="<?php __P('logo','Logo',true,0,100);?>"></a>
	

		
		<?php if(__('menu')!=false):?> 
		<ul class="pull-right nav">
			<?php foreach(__('menu') as $key => $value):?>
				<li><a href="<?php echo SITE_URL.$key;?>"><?php echo $value;?></a></li>	
			<?php endforeach;?>					
		</ul>
		<?php endif;?>


	
	</div>

</div>