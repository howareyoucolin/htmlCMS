<div class="wrap">

	<div class="container">

		<div class="content row">
		
			<?php $output = array();?>
			
			<?php ob_start();?>
			<?php while(loop('blog_title_@i')):?>
			
			<div class="blog-entry col-md-3">	
			
				<div class="inner">
			
				<?php $permalink = SITE_URL.'article/'.$GLOBALS['i'];?>
			
				<a href="<?php echo $permalink;?>"><img src="<?php __P('blog_feature_image_@i',false,true,600,400);?>" /></a>
			
				<h3><a href="<?php echo $permalink;?>"><?php $title = __T('blog_title_@i',false);?></a></h3>
				
				<div class="excerpt">
					
					<?php $block = __A('blog_content_@i',false,false);?>
					
					<div data-text="<?php echo varify('blog_content_'.$GLOBALS['i']);?>">
					<?php
					//Output excerpt:
					echo mb_substr(strip_tags($block),0,199,'UTF-8').' ...';
					?>
					</div>
					
				</div>
				
				<p><a <?php if(MODE=='editor') echo 'onclick="window.location=\''.EDITOR_URL.'?page=article&arg1='.$GLOBALS['i'].'\';"';?> href="<?php echo $permalink;?>">Read more ...</a></p>
				
				</div>
				
			</div>
			
			<?php
			$output[] = ob_get_contents();
			ob_end_clean();
			ob_start();
			?>
			
			<?php endwhile;?>
			<?php ob_end_clean();?>
			
			<?php $c = 0;?>
			<?php for($i=count($output)-1;$i>=0;$i--){
				//Output in a reversed order:
				if($c%4==0 and $c>0) echo '<div class="h25" style="clear:both;"></div>';
				echo $output[$i];
				$c++;
			}?>	
			
		</div>
	
	


	</div>

</div>

<?php if(MODE=='editor'):?>
<script>
$(document).ready(function(){

	$('#blog-block').find('a').each(function(){
	
		$(this).removeAttr('href');
	
	});



});
</script>
<?php endif;?>








