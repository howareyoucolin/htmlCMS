<?php

if(!function_exists('menufy')) { 

	function menufy($text){
		
		$arr = preg_split('/<br[^>]*>/i', $text);
		foreach($arr AS $line){
			
			if(preg_match('/([^\.]+)\.{6,}([^\.].+)/i', trim($line),$match)){
				echo '<div class="unit">';
				echo '<span>'.$match[1].'</span><span class="pull-right">'.$match[2].'</span>';
				echo '</div>';
			}else{
				echo $line.'<br>';
			}
			
		}
		
	}

}

?>

<div class="wrap">

	<div class="container">

		<x>
		<h2><?php __T('menu_title?','Menu Title');?></h2>

		<div class="h50"></div>
		</x>
		
		<div class="menu row">
		
			<div class="col-md-6">
				<div class="colz">
			
				<?php $menu = __A('menu_items?','Menu Items(Column 1)',false);?>

				
				<div data-text="<?php echo varify('menu_items?');?>">
	
					<?php echo menufy($menu);?>
				
				</div>
				
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="colz">
			
				<?php $menu = __A('menu_items2?','Menu Items(Column 2)',false);?>

				
				<div data-text="<?php echo varify('menu_items2?');?>">
		
					<?php echo menufy($menu);?>
			
				</div>
		
				</div>
			</div>

		</div>
			
	</div>  

</div>	