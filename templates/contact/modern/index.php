<?php 
$custom = false;
if(trim(__('module_var'))=='custom'):
	$custom = true;
endif;
?>
<div class="wrap">
	<div class="container">
	
	<x>
	<h2><?php __T('title?',false);?></h2>
	<div class="h50"></div>
	</x>
	
	<div class="row">
	
		<div class="col-md-6">
			
			<table id="contact-table">
				
				<x>
				<tr>
					<td><img src="https://369usa.com/images/icons/phone.png" /></td>
					<td><?php if(!$custom) echo 'Telephone'; else __T('#text1',false);?>:<br/><?php __T('phone','phone');?></td>
				</tr>
				</x>
				
				<x>
				<tr>
					<td><img src="https://369usa.com/images/icons/email.png" /></td>
					<td><?php if(!$custom) echo 'Email'; else __T('#text2',false);?>:<br/><?php __T('email','email');?></td>
				</tr>
				</x>
				
				<x>
				<tr>
					<td><img src="https://369usa.com/images/icons/fax.png" /></td>
					<td><?php if(!$custom) echo 'Fax'; else __T('#text3',false);?>:<br/><?php __T('fax','fax');?></td>
				</tr>
				</x>
				
				<x>
				<tr>
					<td><img src="https://369usa.com/images/icons/wechat.png" /></td>
					<td><?php if(!$custom) echo 'Wechat'; else __T('#text4',false);?>:<br/><?php __T('wechat','wechat');?></td>
				</tr>
				</x>
				
				<x>
				<tr>
					<td><img src="https://369usa.com/images/icons/address.png" /></td>
					<td><?php if(!$custom) echo 'Address'; else __T('#text5',false);?>:<br/><?php __A('address','address');?></td>
				</tr>
				</x>
				
				<x>
				<tr>
					<td><img src="https://369usa.com/images/icons/hour.png" /></td>
					<td><?php if(!$custom) echo 'Hours'; else __T('#text6',false);?>:<br/><?php __A('hour','hour');?></td>
				</tr>
				</x>
			
			</table>
			
		</div>
	
		<div class="col-md-6 gmap">
			
			<?php if(MODE=='web'):?>
			<img class="mapload" width="100%" src="https://369usa.com/images/loading/loaderline.gif" />
			<?php endif;?>
			
			<div <?php if(MODE=='web'):?> class="mapframe" <?php endif;?> ><?php __A('googlemap','Google Map');?></div>
		
		</div>
	
	</div>

	</div>
</div>

<script>
$(document).ready(function(){
	var h = $('#contact-table').height();
	$('#contact-modern .gmap').css('height',h+'px');
	$('#contact-modern .gmap iframe').css('height',(h-30)+'px');
	$('#contact-modern .gmap .mapload').hide();
	$('#contact-modern .gmap .mapframe').fadeIn();
});
</script>







