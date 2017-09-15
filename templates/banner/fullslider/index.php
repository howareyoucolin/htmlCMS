<?php 
	if(trim(__('module_var'))!='') $height = __('module_var');
	else $height = 500;
?>

<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/srcs/bxslider/jquery.bxslider.min.css">
<script src="<?php echo SITE_URL;?>/assets/srcs/bxslider/jquery.bxslider.min.js"></script>

<div class="wrap">

	<ul class="bxslider" <?php $images = __G('#slider','Slide Show',true,1920,$height);?>>
		<?php foreach($images AS $image):?>
			<?php if(trim($image)=='') continue;?>
			<li><img src="<?php echo $image;?>" /></li>
		<?php endforeach;?>
	</ul>
	
</div>

<script>
$('.bxslider').bxSlider({
	mode: 'fade',
	speed: 2000,
	auto: true,
	pause: 7000,
	autoHover: true,
});
</script>