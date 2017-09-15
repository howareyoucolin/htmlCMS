<?php

define('CURRENT_URL', (isset($_SERVER["HTTPS"]) ? 'https' : 'http')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
define('EDITOR_URL', (isset($_SERVER["HTTPS"]) ? 'https' : 'http')."://$_SERVER[HTTP_HOST]".str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(__FILE__)).'/');
define('SITE_URL', str_replace('/editor/','/',EDITOR_URL));

session_start();

//Check if logged in:
if(!isset($_SESSION['loggedin'])){
	header('Location:../admin/');
	exit(1);
}

try{

	if(!isset($_GET['name'])) throw new Exception('Error!!!');
	$name = preg_replace('/\[|\]/i','',$_GET['name']);
	$w = (int) isset($_GET['w'])?$_GET['w']:0;
	$h = (int) isset($_GET['h'])?$_GET['h']:0;
	$tw = (int) isset($_GET['tw'])?$_GET['tw']:0;
	$th = (int) isset($_GET['th'])?$_GET['th']:0;
	
	require_once('../system/image_manager.php');
	
	//Image Upload Handling:
	$files = array();
	for($i = 0; $i < count($_FILES[$name]['name']); $i++){ 
	
		$files[$i]['name'] = $_FILES[$name]['name'][$i];
		$files[$i]['type'] = $_FILES[$name]['type'][$i];
		$files[$i]['tmp_name'] = $_FILES[$name]['tmp_name'][$i];
		$files[$i]['error'] = $_FILES[$name]['error'][$i];
		$files[$i]['size'] = $_FILES[$name]['size'][$i];
	
	}
	
	$re = '[';
	
	foreach($files AS $file){
	
		$image_manager = new Image_Manager($file);
		
		$image_manager->validate();
		if(!$tw) $tw=250;
		if(!$th) $th=250;
		$re .= $image_manager->upload_image($w,$h)->to_url().',';
		$image_manager->generate_thumbnail($tw,$th);
		
	
	}
	
	$re = rtrim($re,',');
	$re .= ']';
	
	echo $re;

}catch (Exception $e) {
    echo $e->getMessage();
}