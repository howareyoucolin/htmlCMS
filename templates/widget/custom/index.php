<?php 
	if(trim(__('module_var'))!='') $postfix = '_'.__('module_var');
	else $postfix = '';
?>
<div class="wrap">
	<?php __A('custom_html_code'.$postfix,'Custom Html Code');?>
</div>