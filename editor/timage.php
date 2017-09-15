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
	
	require_once('../system/image_manager.php');
	$image_manager = new Image_Manager($_FILES['temp']);
	
	$image_manager->validate();
	echo $image_manager->upload_image()->to_url();

}catch (Exception $e) {
    echo $e->getMessage();
}