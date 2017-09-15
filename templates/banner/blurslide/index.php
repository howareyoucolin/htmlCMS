<?php 
	if(trim(__('module_var'))!=''){
		$arr = array_map('trim', explode(',', __('module_var')));
		$namespace = $arr[0].'_';
		$height = $arr[1];
		$transparency = $arr[2];
	}
	else{
		$height = 500;
		$transparency = 0.5;
		$namespace = '';
	}
?>

<?php if(!isset($GLOBALS['asset']['bxslider'])): //Avoid include twice:?>

	<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/srcs/bxslider/jquery.bxslider.min.css">
	<script src="<?php echo SITE_URL;?>/assets/srcs/bxslider/jquery.bxslider.min.js"></script>

	<?php $GLOBALS['asset']['bxslider'] = true;?>
<?php endif;?>

<div class="wrap">

	<ul class="bxslider" <?php $images = __G('slider?','Slide Show',true,1920,$height);?>>
		<?php foreach($images AS $image):?>
			<?php if(trim($image)=='') continue;?>
			<li><img src="<?php echo $image;?>" /></li>
		<?php endforeach;?>
	</ul>
	
	<div class="foreground" style="width:100%;height:<?php echo $height;?>px;background:rgba(0,0,0,<?php echo $transparency;?>);"></div>
	
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