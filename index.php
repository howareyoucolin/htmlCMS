<?php

define('CURRENT_URL', (isset($_SERVER["HTTPS"]) ? 'https' : 'http')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
define('SITE_URL', (isset($_SERVER["HTTPS"]) ? 'https' : 'http')."://$_SERVER[HTTP_HOST]".str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(__FILE__)).'/');
define('MODE','web');

//Load global functions:
include_once('system/functions.php');

//Init 'data' array, which is a global variable:
$data = array();

//Load Config:
include_once('advance/config.php');

if(isset($data['config']['cache']) AND $data['config']['cache']=='on'){
	//Load Cache Manager:
	include_once('system/cache_manager.php');
	$cache_manager = new Cache_Manager(CURRENT_URL);
	//Load cached html if exists:
	if(!is_mobile()){
		if(file_exists($cached_html = $cache_manager->get_html_cache_path())){
			echo file_get_contents($cached_html);
			exit(1);
		}
	}else{
		if(file_exists($cached_html = $cache_manager->get_mobile_html_cache_path())){
			echo file_get_contents($cached_html);
			exit(1);
		}
	}
}

//Get page info, 'home' is the default page:
if(isset($_GET['page']) and $_GET['page']=='home'){
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: ".SITE_URL); 
	exit(1);
}
else if(isset($_GET['page'])) $page = $_GET['page'];
else $page = 'home';

$data['page'] = $page;

//Get page structure and menu:
include_once('system/structure_manager.php');
$structure_manager = new Structure_Manager('advance/structure.cz');

$data['menu'] = $structure_manager->get_menu();
$data['structure'] = $structure_manager->get_page_structure($page);

//Get Custom Scripts:
$data['custom_scripts'] = array();
$dir = new DirectoryIterator('custom/css/');
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $url = SITE_URL.'custom/css/'.($fileinfo->getFilename());
		$data['custom_scripts'][] = '<link rel="stylesheet" href="'.$url.'?'.time().'">';
    }
}
$dir = new DirectoryIterator('custom/js/');
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $url = SITE_URL.'custom/js/'.($fileinfo->getFilename());
		$data['custom_scripts'][] = '<script src="'.$url.'?'.time().'"></script>';
    }
}
//Custom head html:
$data['custom_head'] = array();
$dir = new DirectoryIterator('custom/head/');
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $url = 'custom/head/'.($fileinfo->getFilename());
		$data['custom_head'][] = file_get_contents($url);
    }
}

//Get data from input file:
include_once('system/data_manager.php');
$data_manager = new Data_Manager('data/inputs.php');
$data_manager->render_data_array();

//Start output buffer:
ob_start();

//Load Template Loader:
include_once('system/template_loader.php');
$template_loader = new Template_Loader($data['structure']);
$template_loader->render();

$content = ob_get_contents();
ob_end_clean();

//Get rid of unset <x> blocks and clean up x-markers:
$content = preg_replace('/SYS_X_MARKER/','',preg_replace('/<\/?x>/','',preg_replace('/<x>(?:(?!<\/x>).)*SYS_X_MARKER(?:(?!<x>).)*<\/x>/s', '', $content)));

//Load Marker Manager:
//Marker manager converts markers into system usable code;
include_once('system/marker_manager.php');
$marker_manager = new Marker_Manager();
$marker_manager->translate_site_url($content);

if(isset($data['config']['cache']) AND $data['config']['cache']=='on'){
	//Load Optimizer:
	include_once('system/optimizer.php');
	$optimizer = new Optimizer();
	$optimizer->combine_css($content,$cache_manager->get_css_cache_path(),true);
	$optimizer->combine_js($content,$cache_manager->get_js_cache_path(),false);
	$optimizer->trim_spaces($content);
	//Cache generate:
	if(!is_mobile()){
		$cache_manager->compress_images($content,$data['config']['image_quality']);
		file_put_contents($cache_manager->get_html_cache_path(),$content);
	}else{
		$cache_manager->compress_images($content,$data['config']['image_quality_mobile']);
		file_put_contents($cache_manager->get_mobile_html_cache_path(),$content);
	}
}

//At last, output:
echo $content;
