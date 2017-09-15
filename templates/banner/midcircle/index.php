<?php 
	if(trim(__('module_var'))!=''){
		$arr = array_map('trim', explode(',', __('module_var')));
		$height = $arr[0];
		$show_circle = $arr[1];
	}
	else{ 
		$height = 500;
		$show_circle = true;
	}
	if($height=='') $height = 500;
	if($show_circle=='') $show_circle = true;
?>


<div class="wrap" style="background:url('<?php __B('banner_background?','Banner Background',true,1920,$height);?>');height:<?php echo $height;?>px;" >

	<?php if($show_circle):?>
	<div class="circle wow bounceIn" data-wow-delay="1s">
		<img class="logo" src="<?php __P('logo','Logo',true,0,120);?>" />
		<h2><?php __T('wecome_message?','Wecome Message');?></h2>
		<p class="phonez"><a href="tel:<?php $phone = __L('phone','Phone');?>"><button class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> <?php echo $phone;?>&nbsp;&nbsp;&nbsp;&nbsp;</button></a></p>
		<p class="faxz">Fax: <?php __T('fax','Fax');?></p>
		<p class="emailz">Email: <?php __T('email','Email');?></p>
		<p class="addressz"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><br/><?php __A('address','Address');?></p>
		<div class="socialmedia">
			<p>
			<x>
			<!-- Instagram -->
			<a href="<?php __L('instagram_link','Instagram Link');?>" target="_blank">
				<img src="https://www.369usa.com/369usa_cloud/images/icons/instagram.png" alt="instagram" width="25">
			</a>
			</x>
			<x>
			<!-- Facebook -->
			<a href="<?php __L('facebook_link','Facebook Link');?>" target="_blank">
				<img src="https://www.369usa.com/369usa_cloud/images/icons/facebook.png" alt="facebook" width="25">
			</a>
			</x>
			<x>
			<!-- Google+ -->
			<a href="<?php __L('google_plus_link','GooglePlus Link');?>" target="_blank">
				<img src="https://www.369usa.com/369usa_cloud/images/icons/google.png" alt="google plus" width="25">
			</a>
			</x>
			<x>
			<!-- LinkedIn -->
			<a href="<?php __L('linkedin_link','LinkedIn Link');?>" target="_blank">
				<img src="https://www.369usa.com/369usa_cloud/images/icons/linkedin.png" alt="linked in" width="25">
			</a>
			</x>
			<x>
			<!-- Twitter -->
			<a href="<?php __L('twitter_link','Twitter Link');?>" target="_blank">
				<img src="https://www.369usa.com/369usa_cloud/images/icons/twitter.png" alt="twitter" width="25">
			</a>
			</x>
			<x>
			<!-- Yelp -->
			<a href="<?php __L('yelp_link','Yelp Link');?>" target="_blank">
				<img src="https://www.369usa.com/369usa_cloud/images/icons/yelp.png" alt="yelp" width="25">
			</a>
			</x>
			</p>
		</div>
	</div>
	<?php endif;?>

</div>
