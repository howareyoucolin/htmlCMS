<script>var poopout = false;</script>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['promotionpopupa']) or time()-$_SESSION['promotionpopupa'] > 3600 or true):?>
<style>
#custom-promotionpopup{display:none;position:fixed;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:99999998;}
#custom-promotionpopup .popup .mid{position:absolute;width:600px;height:400px;top:45%;left:50%;margin-left:-300px;margin-top:-200px;border-radius:25px;background: #FFFAEE;padding-top:50px;}
#custom-promotionpopup .popup .mid .topleft{position:absolute;top:0;left:0;}
#custom-promotionpopup .popup .mid .bottomright{position:absolute;bottom:0;right:0;}
#custom-promotionpopup .popup .mid .header{font-weight:bold;font-size:30px;line-height:60px;border-bottom:1px dotted #DDD;color:#000;}
#custom-promotionpopup .popup .mid .body{font-size:20px;line-height:60px;border-bottom:1px dotted #DDD;}
#custom-promotionpopup .popup .mid .price{font-weight:bold;font-size:100px;line-height:95px;border-bottom:0;color:#AF030A;padding-top:30px;}
#custom-promotionpopup .popup .mid .closez{background:#FFF;width:50px;height:50px;line-height:50px;border-radius:50%;cursor:pointer;color:#AF030A;font-size:50px;position:absolute;top:-18px;right:-18px;z-index:99999999;}
@media screen and (max-width: 480px) {
	#custom-promotionpopup .popup .mid{position:absolute;width:88%;height:275px;margin-left:0;margin-top:0px;top:85px;left:5%;}
	#custom-promotionpopup .popup .mid img{width:70px;}
	#custom-promotionpopup .popup .mid .header{font-weight:bold;font-size:24px;line-height:30px;border-bottom:1px dotted #DDD;color:#000;}
	#custom-promotionpopup .popup .mid .body{font-size:18px;line-height:25px;border-bottom:1px dotted #DDD;}
	#custom-promotionpopup .popup .mid .price{font-weight:bold;font-size:60px;line-height:50px;border-bottom:0;color:#AF030A;padding-top:30px;}
	#custom-promotionpopup .popup .mid .closez{background:#FFF;width:50px;height:50px;line-height:50px;border-radius:50%;cursor:pointer;color:#AF030A;font-size:50px;position:absolute;top:-18px;right:-18px;z-index:99999999;}
}
</style>
<div class="popup">

	<div class="mid">
		
		<img class="topleft" src="https://www.uvnailspa.com/custom/templates/topleft.png" />
		
		<div class="closez"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></div>
		
		<p class="header">Special Offer!</p>
		
		<p class="body">Manicure + Pedicure for</p>
		
		<p class="price"><span style="font-size:14px;font-weight:normal;color:#666;">Only</span>$29<sup style="text-decoration:underline;">99</sup></p>
		
		<p><a href="<?php echo SITE_URL;?>promotions"><button class="btn btn-default">Learn More</button></a></p>
		
		<img class="bottomright" src="https://www.uvnailspa.com/custom/templates/bottomright.png" />
		
	</div>
	<script>poopout = true;</script>
</div>
<?php $_SESSION['promotionpopupa'] = time();?>
<?php endif;?>
<script combine>
$(document).ready(function(){
	if(poopout==true){
		setTimeout(
		function() {
		  $('#custom-promotionpopup').fadeIn("slow",function(){
			$('#custom-promotionpopup .popup .mid').addClass('swing animated');
		  });
		}, 5000);
		$('#custom-promotionpopup .popup .mid .closez').click(function(){$('#custom-promotionpopup').remove();});
	}
});
</script>