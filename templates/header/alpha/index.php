<div class="wrap">
	
	<div class="bg" style="background: url('<?php __B('header_background?','Background',true,1920,500);?>') center 0 no-repeat;"></div>
	
	<div class="headz">
		
		<div class="container">
		
			<div class="head">
				
				<h1 class="logo"><a href="<?php echo SITE_URL;?>"><img src="<?php __P('logo','LOGO',true,0,75);?>" /></a></h1>
				
				<ul class="pull-right nav">
					<?php foreach(__('menu') as $key => $value):?>
						<li><a href="<?php echo SITE_URL.$key;?>"><?php echo $value;?></a></li>	
					<?php endforeach;?>					
				</ul>
			
			</div>
		
		</div>
		
	</div>
	
</div>

