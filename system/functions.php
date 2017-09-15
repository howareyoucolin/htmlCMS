<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

/**
* Translate a var into a system usable format.
*/
function varify($var){

	GLOBAL $data;

	// '@' presents a var in GLOBALS:
	if (preg_match('/\@([a-zA-Z0-9]+)/i',$var,$match)) {
		if(!isset($GLOBALS[$match[1]])){
			$GLOBALS[$match[1]] = 0;
		}
		$var = preg_replace('/\@([a-zA-Z0-9]+)/i',$GLOBALS[$match[1]],$var);
	}

	//'?' presents a module-level local namepace:
	if(substr($var, -1) =='?'){
		$var = substr($var, 0, -1);
		//trim # or *:
		$var = str_replace('*','',str_replace('#','',$var));
		$var = $var.'_local'.$data['module_index'];
		$var = '#'.$var.'*';
	}
	
	//'#' presents a file-level local namespace:
	if(substr($var, 0, 1) =='#'){
		$t = debug_backtrace();
		$i = 0;
		//Loop til it grabs the template caller:
		do{
			if(trim(($path = $t[$i]['file'])) == '') break; //Max execution times to prevent infi-loop;
			$arr = explode('/',$path);
			$z = array_pop($arr);
			$y = array_pop($arr);
			$x = array_pop($arr);
			$i++;
		}while(!preg_match('/\/templates\/.*?\.php$/',$path ));
		$var = $x.'_'.$y.'_'.substr($var, 1);
	}
	
	//'*' presents a page-level local namespace:
	if(substr($var, -1) =='*'){
		$var = substr($var, 0, -1).'_'.$data['page'];
	}

	return $var;

}

/**
* Short form.(-_-)
*/
function v($var){
	varify($var);
}

/**
* @String, returns $data[var] value.
**/
function __($var){
	
	GLOBAL $data;
	//Translate into a system usable format.
	$var = varify($var);
	
	if(array_key_exists($var, $data) AND is_array($data[$var])){
		return $data[$var];
	}else if (!array_key_exists($var, $data) or trim($data[$var]) == ''){
		return false;
	}else{
		return $data[$var];
	}
	
}

/**
* [T]ext input marker:	
**/
function __T($var,$title='Untitled',$echo=TRUE){

	GLOBAL $data;
	//Translate into a system usable format.
	$var = varify($var);

	if (!__($var)){
		echo 'SYS_X_MARKER';//Even $echo set to be false, x-maker still gets echoed out;
	}else{
		if($echo) echo __($var);
	}
	
	return __($var);
	
}

/**
* [S]elect  marker:	
**/
function __S($var,$title='Untitled',$echo=TRUE,$pool ='Yes|No'){

	GLOBAL $data;
	//Translate into a system usable format.
	$var = varify($var);

	if (!__($var)){
		echo 'SYS_X_MARKER';//Even $echo set to be false, x-maker still gets echoed out;
	}else{
		if($echo) echo __($var);
	}
	
	return __($var);
	
}

/**
* Text [A]rea marker:	
**/
function __A($var,$title='Untitled',$echo=TRUE){

	GLOBAL $data;
	//Translate into a system usable format.
	$var = varify($var);

	if (!__($var)){
		echo 'SYS_X_MARKER';//Even $echo set to be false, x-maker still gets echoed out;
	}else{
		if($echo) echo __($var);
	}
	
	return __($var);
	
}

/**
* In(L)ine marker:(Such as links and attributes)	
**/
function __L($var,$title='Untitled',$echo=TRUE){

	GLOBAL $data;
	//Translate into a system usable format.
	$var = varify($var);

	if (!__($var)){
		echo 'SYS_X_MARKER';//Even $echo set to be false, x-maker still gets echoed out;
	}else{
		if($echo) echo __($var);
	}
	
	return __($var);
	
}

/**
* Image [P]icture marker:	
**/
function __P($var,$title='Untitled',$echo=TRUE,$w=0,$h=0,$thumb_w=250,$thumb=250){
	
	GLOBAL $data;
	//Translate into a system usable format.
	$var = varify($var);
	
	if (!__($var)){
		echo 'SYS_X_MARKER';//Even $echo set to be false, x-maker still gets echoed out;
		if($echo) echo SITE_URL.'assets/images/na.jpg';
	}else{
		if($echo) echo __($var);
	}
	
	return __($var);
	
}

/** 
* Image [B]ackground marker:	
**/
function __B($var,$title='Untitled',$echo=TRUE,$w=0,$h=0,$thumb_w=250,$thumb=250){
	
	GLOBAL $data;
	//Translate into a system usable format.
	$var = varify($var);
	
	if (!__($var)){
		if($echo) echo SITE_URL.'assets/images/bg.png';
	}else{
		if($echo) echo __($var);
	}
	
	return __($var);
	
}

/**
* Multi-images [G]allery marker:	
**/
function __G($var,$title='Untitled',$echo=TRUE,$w=0,$h=0,$thumb_w=250,$thumb=250){
	
	GLOBAL $data;
	//Translate into a system usable format.
	$var = varify($var);
	
	if (!__($var)){
		echo 'SYS_X_MARKER';//Even $echo set to be false, x-maker still gets echoed out;
	}
	
	//Returns an array:
	return array_map('trim', explode(',', trim(__($var),',')));
	
}

/**
* Ad[V]anced input marker:	
**/
function __V($var,$title='Untitled',$echo=TRUE,$input_type='T'){

	GLOBAL $data;
	//Translate into a system usable format.
	$var = varify($var);
	
	if($echo) echo __($var);
	
	return __($var);
	
}

function loop($var,$counter=false){

	static $t,$regex,$ckey,$max;
	
	if(!isset($t) || is_null($t)){
		GLOBAL $data;
		$t = $data;//Clone;
		//Set a key for the counter '@':
		if (preg_match('/\@([a-zA-Z0-9]+)/i',$var,$match)){
			$ckey = $match[1];
		}else{
			//Since incorrect format, simply return:
			$t=null;//Reset for the next loop:
			return false;
		}
		//convert $var to usable regex format:
		$regex = preg_replace('/\@([a-zA-Z0-9]+)/i','(\d+)',$var);
		//Init max:
		$max = 0;
	}
	
	foreach($t AS $key => $value){
		if (preg_match('/'.$regex.'/i',$key,$match)) {
			//Set max to a larger int:
			if($match[1]>$max) $max = $match[1];
			$GLOBALS[$ckey] = $match[1];
			unset($t[$key]);
			return true;
		}else{
			unset($t[$key]);
		}
	}
	
	$t=null;//Reset for the next loop:
	return false;
	
}

function is_mobile(){
	//2016 version:
	return preg_match('/(android|webos|avantgo|iphone|ipad|ipod|blackberry|iemobile|bolt|boost|cricket|docomo|f??one|hiptop|mini|opera mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i', $_SERVER['HTTP_USER_AGENT']);
}