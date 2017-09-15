<?php

if(trim(__('module_var'))!=''):
	$arr = array_map('trim', explode(',', __('module_var')));
	$col = (int)12/count($arr);
?>
<div class="wrap">

	<div id="googleadsence">
		<div class="container">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- CODE2 -->
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="ca-pub-6301361047314396"
			 data-ad-slot="5054327860"
			 data-ad-format="auto"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		</div>
	</div>
	
	<div class="container">
	
		<div class="row">
		
			<?php foreach($arr as $key):?>
				<div class="col-md-<?php echo $col;?>">
					<!--sitemap-->
					<?php if($key=='sitemap'):?>
						<h3><?php __T('sitemaptitle',false);?></h3>
						<div class="h25"></div>
						<?php if(__('menu')!=false):?> 
						<ul class="foot-nav sitemap"">
							<?php foreach(__('menu') as $key => $value):?>
								<li><a href="<?php echo SITE_URL.$key;?>"><?php echo $value;?></a></li>	
							<?php endforeach;?>					
						</ul>
						<?php endif;?>
					<?php endif;?>
					<!--wechat-->
					<?php if($key=='wechat'):?>
						<h3><?php __T('wechattitle',false);?></h3>
						<div class="h25"></div>
						<?php if(__('menu')!=false):?> 
						<img width="100%" src="<?php __P('wechatimg',false,true,400,400);?>" />
						<?php endif;?>
					<?php endif;?>
					<!--contacts-->
					<?php if($key=='contacts'):?>
						<h3><?php __T('contactstitle',false);?></h3>
						<div class="h25"></div>
						<ul class="contactz">
							<x><li><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> <?php __T('phone','phone');?></li></x>
							<x><li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php __T('email','email');?></li></x>
							<x><li><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <?php __A('address','address');?></li></x>
						</ul>
					<?php endif;?>
					<!--subscribe-->
					<?php if($key=='subscribe'):?>
						<h3><?php __T('subscribetitle',false);?></h3>
						<div class="h25"></div>
						<p><input type="text" class="form-control" placeholder="Your Name" /></p>
						<p><input type="text" class="form-control" placeholder="Your Email" /></p>
						<p><button id="subscribe" class="btn btn-primary">Subscribe</button></p>
						<script>
						$(document).ready(function(){$('#subscribe').click(function(){alert('Subscribed!');});});
						</script>
					<?php endif;?>
				</div>
			<?php endforeach;?>
		</div>
	
		<div class="h50"></div>
	
		<div class="copyright"><?php __V('copyright','Copyright','A');?></div>
	
		<div class="h25"></div>
	
	</div>

</div>

<?php

endif;

?>