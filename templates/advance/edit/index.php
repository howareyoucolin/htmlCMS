<style>
aside.sys{
	display:none;
}
section.sys{
    padding-left: 25px;
}
section.sys .righty .frame{
	margin-top: 25px;
	border:1px solid #F3F3F3;
	background:#FAFAFA;
	min-height:1500px;
}
section.sys textarea{
	border:1px solid #F3F3F3;
	background:#FAFAFA;
	width:100%;
	min-height:600px;
}
section.sys p.header{
	background:#272727;
	color:#FFF;
}
#top-save{
	display:none;
}
#advance_edit_save{
	display:block;
}
</style>
<script>
$(document).ready(function(){
	
	$('#top-save').after('<li id="top-save2" class="top-save"><a href="#">Save</a></li>');
	
	$('#top-save2').click(function(){
		
		$('#advance_edit_save').trigger('click');
		
	});
	
	$('.glyphicon-eye-open').parent().attr('href','<?php echo SITE_URL;?>');
	
});
</script>
<div class="col-md-6 lefty">

	<h3>ADVANCED EDIT</h3>
	
	<form method="POST" action="advanced_save.php">
	
	<p>&nbsp;</p>
	
	<p class="header">Structure Schema</p>
	
	<textarea name="structure"><?php echo file_get_contents('../advance/structure.cz');?></textarea>
	
	<p>&nbsp;</p>
	
	<p class="header">Custom Style CSS:</p>
	
	<textarea name="style"><?php if(file_exists('../custom/css/cz.css')) echo file_get_contents('../custom/css/cz.css');?></textarea>
	
	<p>&nbsp;</p>
	
	<p class="header">Custom Script Js:</p>
	
	<textarea name="script"><?php if(file_exists('../custom/js/cz.js')) echo file_get_contents('../custom/js/cz.js');?></textarea>
	
	<p>&nbsp;</p>
	
	<p class="header">Custom Head HTML:</p>
	
	<textarea name="head"><?php if(file_exists('../custom/head/cz.html')) echo file_get_contents('../custom/head/cz.html');?></textarea>
	
	<p>&nbsp;</p>
	
	<input type="hidden" name="from" value="<?php echo CURRENT_URL;?>" />
	
	<input id="advance_edit_save" name="save" type="submit" value="save" />
	
	</form>
	
</div>

<div class="col-md-6 righty">

	<p class="header">VIEW SECTION</p>
	
	<div class="frame">
	
	</div>
	
</div>