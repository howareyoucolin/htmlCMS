<div class="wrap mobile-hide">

	<div class="layer1">
		<div class="container inner">
			
			<div class="layer3">
			
				<img class="logo" src="<?php __P('logo','Logo',true,130,0);?>" />
			
			</div>
		
		</div>
	</div>

	<div class="layer2">
	
		<div class="container">
	
			<?php if(__('menu')!=false):?> 
			<ul class="pull-right nav">
				<?php foreach(__('menu') as $key => $value):?>
					<li><a href="<?php echo SITE_URL.$key;?>"><?php echo $value;?></a></li>	
				<?php endforeach;?>					
			</ul>
			<?php endif;?>
		
		</div>
	
	</div>
	
</div>

<div class="wrap mobile-only">

	<div class="container" style="padding:0;">

	<nav class="navbar">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span> 
		  </button>
		  <a class="navbar-brand" href="<?php echo SITE_URL;?>"><img style="height:50px;" alt="Nail Spa Scarsdale" src="<?php echo __('logo');?>"/></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav">
			<?php foreach(__('menu') AS $key => $value):?>
				<li class="item"><a name="<?php echo $key;?>" href="<?php echo SITE_URL.$key;?>"><?php echo $value;?></a></li>
			<?php endforeach;?>
		  </ul>
		</div>
	  </div>
	</nav>
	
	</div>

</div>