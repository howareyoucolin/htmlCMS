
<div class="wrap">
<div class="container">

		<x><h2 class="headdy"><?php __T('gallery_title?','Gallery Title');?></h2>

		<div class="h50"></div></x>

		<div <?php $gallery = __G('gallery?','Gallery',true,0,0,300,215);?>> 
		
			<div class="row gallery-holder">
			
				<?php foreach($gallery  AS $image):?>
				
						<?php
						if (!preg_match("/.*(\.jpg|\.jpeg|\.png|\.gif)$/i", trim($image))) {
							continue;
						}
						?>
						<div class="unit col-md-2 col-xs-6">
							<a class="image-link" href="<?php echo $image;?>">
								<img src="<?php echo str_replace('/reg/','/thumbs/',$image);?>" alt="" class="img-responsive" />
							</a>
						</div>
					
				<?php endforeach;?>
		
			</div>	
			
			<div class="clr"></div>
				
		</div>

</div>
</div>

<?php if(!isset($GLOBALS['asset']['magnifipopup'])): //Avoid include twice:?>
	<link rel="stylesheet" href="http://www.369nyc.com/web/cdn/MagnificPopup/style.css">
	<script src="http://www.369nyc.com/web/cdn/MagnificPopup/main.js"></script>
	<?php $GLOBALS['asset']['magnifipopup'] = true;?>
<?php endif;?>
<script>
$(document).ready(function() {
	$('.gallery-holder').magnificPopup({
	  delegate: 'a', // child items selector, by clicking on it popup will open
	  type: 'image',
	  gallery:{enabled:true}
	});
});
</script>

