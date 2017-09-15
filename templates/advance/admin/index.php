<style>
aside.sys{
	display:none;
}
section.sys{
    padding-left: 25px;
}
section.sys p.header{
	background:#272727;
	color:#FFF;
}
#top-save{
	display:none;
}
#advance_edit_save{
	display:none;
}
</style>
<script>
$(document).ready(function(){
	
	$('.glyphicon-eye-open').parent().attr('href','<?php echo SITE_URL;?>');
	
});
</script>
<div>

	<h3>ADMIN MANAGEMENT</h3>
	
	<p>&nbsp;</p>
	
	<form method="POST" action="advanced_admin_save.php">
	
		<p><span style="display:inline-block;width:150px;">New Admin Username :</span> <input name="username" type="text" value=""/></p>
		
		<p><span style="display:inline-block;width:150px;">New Admin Password :</span> <input name="password" type="text" value=""/></p>
	
	<input type="hidden" name="from" value="<?php echo CURRENT_URL;?>" />
	
	<p><span style="display:inline-block;width:150px;">&nbsp;</span> <input id="advance_admin_save" name="save" type="submit" value=" create " /></p>
	
	</form>
	
	<p>&nbsp;</p>
	
	<hr/>
	
	<p>&nbsp;</p>
	
	<h3>ADMIN LIST</h3>
	
	<p>&nbsp;</p>
	
	<?php
	
	$handle = fopen("../data/psw.php", "r");
	if ($handle) {
		while (($line = fgets($handle)) !== false) {
			// process the line read.
			if (preg_match('/^\s*\/\/\s*(\w+)\s*=.*$/', $line, $matches)) {
				echo '
					<form method="POST" action="advanced_admin_save.php">
						<input type="hidden" name="name" value="'.$matches[1].'"/>
						<input type="hidden" name="from" value="'.CURRENT_URL.'" />
						<input type="submit" style="display:none;" name="remove" value="remove" />
						<p><span style="color:#D00;cursor:pointer;" class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> '.$matches[1].'</p>
					</form>
				';
			}
		}
		fclose($handle);
	}
	
	?>
	
	<p>&nbsp;</p>

<script>
$(document).ready(function(){
	
	$('input[name=remove]').click(function(e){
		var r = confirm("Are you sure to remove this admin?");
		if (r == true) {
			return true;
		} else {
			e.preventDefault();
			return false;
		}
	});
	
	$('.glyphicon-remove-sign').click(function(){
		$(this).parent().parent().find('input[name=remove]').trigger('click');
	});
	
});
</script>


</div>