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

$data['page'] = 'advanced_edit';

//Get page structure and menu:
include_once('../system/structure_manager.php');
$structure_manager = new Structure_Manager('../advance/structure.cz');

$data['menu'] = $structure_manager->get_menu();

//Start output buffer:
ob_start();

//Load Editor Template Loader:
include_once('../system/editor_loader.php');
$editor_loader = new Editor_Loader(array('advance-edit'));
$editor_loader->init_styles();
$editor_loader->init_scripts();
$editor_loader->init_heads();
$editor_loader->print_head();

$content = ob_get_contents();
ob_end_clean();

//Load Marker Manager:
//Marker manager converts markers into system usable code;
include_once('../system/marker_manager.php');
$marker_manager = new Marker_Manager();

//Process markers:
$marker_manager->translate_site_url($content);

//At last, output:
echo $content;

$editor_loader->print_body();
$editor_loader->print_foot();













