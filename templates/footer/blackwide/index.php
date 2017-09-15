<div class="wrap">

	<div class="container">

		<div class="row widgets">
			
			<div class="unit col-md-4 col-xs-12 info">
			
				<h3><?php __T('#column1_header','Column 1 Header');?></h3>	
				
				<table>
					
					<x>
					<tr>
						<td>Email:&nbsp;&nbsp;</td>
						<td><?php __T('email','Email');?></td>
					</tr>
					</x>
					
					<x>
					<tr>
						<td>Telephone:&nbsp;&nbsp;</td>
						<td><?php __T('phone','Phone');?></td>
					</tr>
					</x>
					
					<x>
					<tr>
						<td>Address:&nbsp;&nbsp;</td>
						<td><?php __A('address','Eddress');?></td>
					</tr>
					</x>
					
					<x>
					<tr>
						<td>Fax:&nbsp;&nbsp;</td>
						<td><?php __T('fax','Fax');?></td>
					</tr>
					</x>
					
					<x>
					<tr>
						<td>Hours:&nbsp;&nbsp;</td>
						<td><?php __A('hours','Hours');?></td>
					</tr>
					</x>
					
				</table>

			</div>
			
			<div class="unit col-md-4 col-xs-12 qrcode">
				
				<h3><?php __T('#column2_header','Column 2 Header');?></h3>	
				
				<img src="<?php __P('qr_code','QR Code');?>" />
				<p class="hint"><?php __('qr_code_text','QR Code Text');?></p>

			</div>
			
			<div class="unit col-md-4 col-xs-12 share">
			
				<h3><?php __T('#column3_header','Column 3 Header');?></h3>	
				
				<p>
						<!-- Facebook -->
				<a href="https://www.facebook.com/sharer.php?u=<?php __('site_url');?>" target="_blank">
					<img src="https://www.369usa.com/369usa_cloud/images/icons/facebook.png" alt="share <?php __('site_url');?> to facebook" width="25">
				</a>
				<!-- Google+ -->
				<a href="https://plus.google.com/share?url=<?php __('site_url');?>" target="_blank">
					<img src="https://www.369usa.com/369usa_cloud/images/icons/google.png" alt="share <?php __('site_url');?> to google plus" width="25">
				</a>
				<!-- LinkedIn -->
				<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php __('site_url');?>" target="_blank">
					<img src="https://www.369usa.com/369usa_cloud/images/icons/linkedin.png" alt="share <?php __('site_url');?> to linked-in" width="25">
				</a>
				<!-- Twitter -->
				<a href="https://twitter.com/share?url=<?php __('site_url');?>&amp;text=share <?php __('site_url');?>" target="_blank">
					<img src="https://www.369usa.com/369usa_cloud/images/icons/twitter.png" alt="share <?php __('site_url');?> to twitter" width="25">
				</a>
				
				</p>
				
				<p>
					</br>
					<?php __A('copyright');?>
					
				</p>

			</div>
			
		</div>


	</div>
	
</div>