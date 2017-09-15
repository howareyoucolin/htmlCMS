<?php

if(isset($_POST['save'])){
	
	session_start();
	
	file_put_contents('../advance/structure.cz', $_POST['structure']);
	
	file_put_contents('../custom/css/cz.css', $_POST['style']);
	
	file_put_contents('../custom/js/cz.js', $_POST['script']);
	
	file_put_contents('../custom/head/cz.html', $_POST['head']);
	
	$_SESSION['saved'] = '1';
	
	header('Location:'.$_POST['from']);
	exit(1);
	
}