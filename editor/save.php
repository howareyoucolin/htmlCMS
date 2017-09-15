<?php

session_start();

//Check if logged in:
if(!isset($_SESSION['loggedin'])){
	header('Location:../admin/');
	exit(1);
}

$content = file_get_contents('../data/inputs.php');

//Content Update Handling:	
	//echo '<pre>';var_dump($_POST);die;
foreach($_POST as $key => $value){
    
	if($key == 'save_btn' or $key == 'page_url') continue; //Ignore these 2 vars;
	
	//Save Action Code
	
	$value = str_replace("\r\n", '<br/>' ,$value);
	$value = str_replace("\n", '<br/>' ,$value);
	
	if (preg_match('/^\s*'.$key.'\s*=.*$/m', $content)) {
		$content = preg_replace('/^\s*'.$key.'\s*=.*$/m', PHP_EOL.$key.' = '.str_replace('$','\$',$value).PHP_EOL ,$content);//Escape $ sign;
	}else{
		$content .= PHP_EOL.$key.' = '.$value.PHP_EOL;
	}
	
}

//Clean Up Process:
//Remove lines with SYS_REMOVE_MARKER:
$content = preg_replace('/^.*SYS_REMOVE_MARKER.*$/m', PHP_EOL ,$content);
//Clean up abandand line breaks:
$content = preg_replace('/(\r?\n){2,}/m', PHP_EOL.PHP_EOL ,$content);

file_put_contents('../data/inputs.php',$content);

$_SESSION['saved'] = '1';

header( 'Location: '.$_POST['page_url'] );
exit(1);