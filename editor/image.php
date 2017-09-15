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
	$name = $_GET['name'];
	$w = (int) isset($_GET['w'])?$_GET['w']:0;
	$h = (int) isset($_GET['h'])?$_GET['h']:0;
	$tw = (int) isset($_GET['tw'])?$_GET['tw']:0;
	$th = (int) isset($_GET['th'])?$_GET['th']:0;
	
	require_once('../system/image_manager.php');
	$image_manager = new Image_Manager($_FILES[$name]);
	
	$image_manager->validate();
	echo $image_manager->upload_image($w,$h)->to_url();
	$image_manager->generate_thumbnail($tw,$th);

}catch (Exception $e) {
    echo $e->getMessage();
}