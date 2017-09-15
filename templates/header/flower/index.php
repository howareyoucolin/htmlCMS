<div class="wrap mobile-hide">

	<div class="container">
	
		<x><img class="flower" src="<?php __P('#flower','Flower Decoration');?>" /></x>
	
		<ul>
		
			<li><a href="<?php echo SITE_URL;?>"><h1><img class="logo" src="<?php __P('logo','Logo');?>"/></h1></a></li>
			<?php foreach(__('menu') AS $key => $value):?>
				<li class="item"><a name="<?php echo $key;?>" href="<?php echo SITE_URL.$key;?>"><?php echo $value;?></a></li>
			<?php endforeach;?>
			
		</ul>
	
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