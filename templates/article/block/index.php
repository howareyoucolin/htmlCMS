<?php

if(!$_GET['arg1']){
	header('Location:'.SITE_URL.'/404');
	exit(1);
}

$id = $_GET['arg1'];

if(!__('blog_title_'.$id)){
	header('Location:'.SITE_URL.'/404');
	exit(1);
}

?>

<div class="wrap">

	<div class="container">
	
		<h2><?php __T('blog_title_'.$id);?></h2>
		
		<div class="h50"></div>
		
		<div class="content">
		<?php __A('blog_content_'.$id);?>
		</div>
		
	</div>

</div>

