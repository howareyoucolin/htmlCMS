<?php 

session_start();

//Check if logged in:
if(!isset($_SESSION['loggedin'])){
	header('Location:../admin/');
	exit(1);
}

$content = file_get_contents('../data/psw.php');

if(preg_match('/^\/\/\s*\[(\w+)\]\s*$/m',$content,$match)){
			
	$key = $match[1];
	
}

if(isset($_POST['save'])){
	
	$username = trim($_POST['username']);
	$password = md5($key.trim($_POST['password']));
	
	if (preg_match('/^\s*\/\/\s*'.$username.'\s*=.*$/m', $content)) {
		$content = preg_replace('/^\s*\/\/\s*'.$username.'\s*=.*$/m', PHP_EOL.'//'.$username.' = '.str_replace('$','\$',$password).PHP_EOL ,$content);//Escape $ sign;
	}else{
		$content .= PHP_EOL.'//'.$username.' = '.$password.PHP_EOL;
	}
	
	
	
}

if(isset($_POST['remove'])){

	$name = trim($_POST['name']);

	if (preg_match('/^\s*\/\/\s*'.$name.'\s*=.*$/m', $content)) {
		$content = preg_replace('/^\s*\/\/\s*'.$name.'\s*=.*$/m', PHP_EOL.PHP_EOL ,$content);//remove;
	}
	
}


//Clean up abandand line breaks:
$content = preg_replace('/(\r?\n){2,}/m', PHP_EOL.PHP_EOL ,$content);

file_put_contents('../data/psw.php',$content);

$_SESSION['saved'] = '1';

header( 'Location: '.$_POST['from'] );
exit(1);