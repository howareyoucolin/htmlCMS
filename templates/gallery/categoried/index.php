<?php 
	if(trim(__('module_var'))!=''){
		$arr = array_map('trim', explode(',', __('module_var')));
		$col = (int)(12/$arr[0]);
		$width = $arr[1];
		$height = $arr[2];
	}
	else{ 
		$col = 2;
		$width = 300;
		$height = 215;
	}
	if($col=='') $col = 2;
	if($width=='') $width = 300;
	if($height=='') $height = 215;
?>
<div class="wrap">
<div class="container">
		
		<?php if(MODE=='editor'):?> 
			<p><?php $cats = __T('galery_categories?','Gallery Categories');?></p>
		<?php else:?>
		<ul class="filter-menu">
			<li class="filter btn btn-default" data-filter="mix">ALL</li>
			<?php if(__('galery_categories?') != FALSE):?>
				<?php $cats = array_map('trim', explode('|', __('galery_categories?')));?>
				<?php foreach($cats AS $cat):?>
					<li class="filter btn btn-default" data-filter="<?php echo $cat;?>"><?php echo $cat;?></li>
				<?php endforeach;?>
			<?php endif;?>
		</ul>
		<?php endif;?>
		
		<div class="h50"></div>

		<div <?php $gallery = __G('gallery?','Gallery',true,0,0,$width,$height);?>> 
		
			<div class="row gallery-holder">
			
				<div class="mix-holder">
			
				<?php foreach($gallery  AS $image):?>
				
						<?php
						if (!preg_match("/.*(\.jpg|\.jpeg|\.png|\.gif)$/i", trim($image))) {
							continue;
						}
						?>
						<div class="unit col-md-<?php echo $col;?> col-xs-6 mix <?php echo __('gallery_category_unit_'.preg_replace('/\W/','',basename($image)));?>">
							<a class="image-link" href="<?php echo $image;?>">
								<img src="<?php echo str_replace('/reg/','/thumbs/',$image);?>" alt="" class="img-responsive" />
							</a>
							<?php if(MODE=='editor') __S('gallery_category_unit_'.preg_replace('/\W/','',basename($image)),false,true,$cats);?>
						</div>
					
				<?php endforeach;?>
				
				</div>
		
			</div>	
			
			<div class="clr"></div>
				
		</div>

</div>
</div>

<?php if(!isset($GLOBALS['asset']['mixitup'])): //Avoid include twice:?>
	<script defer title="nocache" src="<?php echo SITE_URL;?>/assets/srcs/mixitup.js"></script>
	<?php $GLOBALS['asset']['mixitup'] = true;?>
<?php endif;?>

<style>.mix-holder .unit{display:none;}</style>
	<script combine>
	$(document).ready(function(){
		$('.mix-holder').mixitup();
	});
</script>

<?php if(!isset($GLOBALS['asset']['magnifipopup'])):?>
	<link title="nocache" rel="stylesheet" href="<?php echo SITE_URL;?>/assets/srcs/MagnificPopup/style.css">
	<script defer title="nocache" src="<?php echo SITE_URL;?>/assets/srcs/MagnificPopup/main.js"></script>
	<?php $GLOBALS['asset']['magnifipopup'] = true;?>
<?php endif;?>
<script combine>
$(document).ready(function() {
	$('.gallery-holder').magnificPopup({
	  delegate: 'a',
	  type: 'image',
	  gallery:{enabled:true}
	});
});
</script>

