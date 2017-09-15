<?php

define('CURRENT_URL', (isset($_SERVER["HTTPS"]) ? 'https' : 'http')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
define('EDITOR_URL', (isset($_SERVER["HTTPS"]) ? 'https' : 'http')."://$_SERVER[HTTP_HOST]".str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(__FILE__)).'/');
define('SITE_URL', str_replace('/editor/','/',EDITOR_URL));
define('MODE','editor');

session_start();

//Check if logged in:
if(!isset($_SESSION['loggedin'])){
	header('Location:../admin/');
	exit(1);
}

//Load editor manager:
include_once('../system/editor_manager.php');
//EDITOR is a global object, it handles all auto-generated editor markers:
$EDITOR = new Editor_Manager('../data/inputs.php');

//Load global functions:
include_once('../system/functions_editor.php');

//Init 'data' array, which is a global variable:
$data = array();

//Load Config:
include_once('../advance/config.php');

//Get page info, 'home' is the default page:
if(isset($_GET['page'])) $page = $_GET['page'];
else $page = 'home';

$data['page'] = $page;

//Get page structure and menu:
include_once('../system/structure_manager.php');
$structure_manager = new Structure_Manager('../advance/structure.cz');

$data['menu'] = $structure_manager->get_menu();
$data['structure'] = $structure_manager->get_page_structure($page);

//Get Custom Scripts:
$data['custom_scripts'] = array();
$dir = new DirectoryIterator('../custom/css/');
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $url = SITE_URL.'custom/css/'.($fileinfo->getFilename());
		$data['custom_scripts'][] = '<link rel="stylesheet" href="'.$url.'?'.time().'">';
    }
}
$dir = new DirectoryIterator('../custom/js/');
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $url = SITE_URL.'custom/js/'.($fileinfo->getFilename());
		$data['custom_scripts'][] = '<script src="'.$url.'?'.time().'"></script>';
    }
}
//Custom head html:
$data['custom_head'] = array();
$dir = new DirectoryIterator('../custom/head/');
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $url = '../custom/head/'.($fileinfo->getFilename());
		$data['custom_head'][] = file_get_contents($url);
    }
}

//Get data from input file:
include_once('../system/data_manager.php');
$data_manager = new Data_Manager('../data/inputs.php');
$data_manager->render_data_array();

//Start output buffer:
ob_start();

//Load Editor Template Loader:
include_once('../system/editor_loader.php');
$editor_loader = new Editor_Loader($data['structure']);
$editor_loader->render();

$content = ob_get_contents();
ob_end_clean();

//Load Marker Manager:
//Marker manager converts markers into system usable code;
include_once('../system/marker_manager.php');
$marker_manager = new Marker_Manager();

//Process markers:
$marker_manager->translate_L_markers($content);
$marker_manager->translate_P_markers($content);
$marker_manager->translate_B_markers($content);
$marker_manager->translate_G_markers($content);
$marker_manager->translate_site_url($content);

//At last, output:
echo $content;

















