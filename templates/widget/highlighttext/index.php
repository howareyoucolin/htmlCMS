<?php 
	if(trim(__('module_var'))!='') $margintop = __('module_var');
	else $margintop = 0;
?>
<div class="wrap">

	<div class="container">

		<x>
	
		<div class="text" style="margin-top:<?php echo $margintop;?>px;">
		
			<h2><?php __T('highlight_title?',false);?></h2>
			
			<p><?php __A('highlight_text?',false);?></p>
		
		</div>
		
		</x>
	
	</div>

</div>