<div class="wrap">

	<div class="container">
		
		<?php if(__('page')=='article'):?>
		
			<?php $arr = __('menu');?>
		
			<a href="<?php echo SITE_URL;?>"><?php __V('site_name','Site Name for Breadcrumb');?></a> 
			
			>>
			
			<a href="<?php echo SITE_URL.'blog';?>"><?php echo ucfirst(strtolower($arr['blog']));?></a>
			
			>>
			
			<span><?php echo __('blog_title_'.$_GET['arg1']);?></span>
		
		<?php else:?>
		
			<?php $arr = __('menu');?>
		
			<a href="<?php echo SITE_URL;?>"><?php __V('site_name','Site Name for Breadcrumb');?></a> 
			
			>>
			
			<span><?php echo ucfirst(strtolower($arr[__('page')]));?></span>

		<?php endif;?>
		
	</div>

</div>