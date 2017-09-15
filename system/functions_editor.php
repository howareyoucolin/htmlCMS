<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

/**
* Translate a var into a system usable format.
*/
function varify($var){
	
	global $data;
	
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
		GLOBAL $data;
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
	
	GLOBAL $data,$EDITOR;
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

	GLOBAL $data,$EDITOR;
	//Translate into a system usable format.
	$var = varify($var);
	
	$EDITOR->collect($var,'T',$title);

	if($echo){
		echo '<div data-var="'.$var.'">';
		echo __($var);
		echo '</div>';
	}
	
	return __($var);
	
}

/**
* [S]elect  marker:	
**/
function __S($var,$title='Untitled',$echo=TRUE,$pool ='Yes|No'){

	GLOBAL $data,$EDITOR;
	//Translate into a system usable format.
	$var = varify($var);

	$pool_array = array_map('trim', explode('|', $pool));
	
	$EDITOR->collect($var,'S',$title,$pool_array);
	
	if($echo){
		echo '<div data-select="'.$var.'">';
		echo __($var);
		echo '</div>';
	}
	
	return __($var);
	
}

/**
* Text [A]rea marker:	
**/
function __A($var,$title='Untitled',$echo=TRUE){

	GLOBAL $data,$EDITOR;
	//Translate into a system usable format.
	$var = varify($var);

	$EDITOR->collect($var,'A',$title);
	
	if($echo){
		echo '<div data-text="'.$var.'">';
		echo __($var);
		echo '</div>';
	}
	
	return __($var);
	
}

/**
* In(L)ine marker:(Such as links and attributes)	
**/
function __L($var,$title='Untitled',$echo=TRUE){

	GLOBAL $data,$EDITOR;
	//Translate into a system usable format.
	$var = varify($var);
	
	$EDITOR->collect($var,'L',$title);

	if($echo){
		echo 'SYS_L_MARKER{'.$var.'}';
		echo __($var);
	}
	
	return __($var);
	
}

/**
* Image [P]icture marker:	
**/
function __P($var,$title='Untitled',$echo=TRUE,$w=0,$h=0,$thumb_w=250,$thumb=250){
	
	GLOBAL $data,$EDITOR;
	//Translate into a system usable format.
	$var = varify($var);
	
	$EDITOR->collect($var,'P',$title,array('w'=>$w,'h'=>$h,'thumb_w'=>$thumb_w,'thumb_h'=>$thumb_h));
	
	if($echo){
		echo 'SYS_P_MARKER{'.$var.'}';
		echo (!__($var))?SITE_URL.'assets/images/void.png':__($var);
	}
	
	return __($var);
	
}

/**
* Image [B]ackground marker:	
**/
function __B($var,$title='Untitled',$echo=TRUE,$w=0,$h=0,$thumb_w=250,$thumb=250){
	
	GLOBAL $data,$EDITOR;
	//Translate into a system usable format.
	$var = varify($var);
	
	$EDITOR->collect($var,'B',$title,array('w'=>$w,'h'=>$h,'thumb_w'=>$thumb_w,'thumb_h'=>$thumb_h));
	
	if($echo){
		echo 'SYS_B_MARKER{'.$var.'}';
		echo (!__($var))?SITE_URL.'assets/images/bg.png':__($var);
	}
	
	return __($var);
	
}

/**
* Multi-images [G]allery marker:	
**/
function __G($var,$title='Untitled',$echo=TRUE,$w=0,$h=0,$thumb_w=250,$thumb_h=250){
	
	GLOBAL $data,$EDITOR;
	//Translate into a system usable format.
	$var = varify($var);
	
	$EDITOR->collect($var,'G',$title,array('w'=>$w,'h'=>$h,'thumb_w'=>$thumb_w,'thumb_h'=>$thumb_h));
	
	if($echo){
		echo 'SYS_G_MARKER{'.$var.'}';
	}
	
	//Returns an array:
	return array_map('trim', explode(',', trim(__($var),',')));
	
}

/**
* Ad[V]anced input marker:	
**/
function __V($var,$title='Untitled',$echo=TRUE,$input_type='T'){

	GLOBAL $data,$EDITOR;
	//Translate into a system usable format.
	$var = varify($var);
	
	$EDITOR->collect_advanced($var,'V',$title,$input_type);
	
	echo __($var);
	
	return __($var);
	
}

function loop($var,$limit=999999){

	static $counter,$t,$regex,$ckey,$max,$one_more;

	//Limit the maximum times of the loop runs:
	if($counter>=$limit){
		$counter=0;
		$one_more = true;
		$t=null;//Reset for the next loop:
		return false;
	}
	
	if(!isset($t) || is_null($t)){
		$counter = 0;
		$one_more = true;
		GLOBAL $data;
		$t = $data;//Clone;
		//Set a key for the counter '@':
		if (preg_match('/\@([a-zA-Z0-9]+)/i',$var,$match)){
			$ckey = $match[1];
		}else{
			//Since incorrect format, simply return:
			$one_more = true;
			$counter=0;
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
			//This little spy gets into the loop items and spy on them by generates some tricky js actions:
			echo $loop_spy = '<div data-name="'.$key.'" class="loop-spy"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></div>';
			$counter++;
			return true;
		}else{
			unset($t[$key]);
		}
	}
	
	//Let the while loop run one more time for a empty block for a new entry:
	if($one_more){
		$GLOBALS[$ckey] = (int)$max+1;
		$one_more = false;
		//This little spy gets into the loop items and spy on them by generates some tricky js actions:
		echo $loop_spy = '<div data-name="new" class="loop-spy"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></div>';
		$counter++;
		return true;
	}
	
	//At last, end of the loop:
	$counter=0;
	$one_more = true;
	$t=null;//Reset for the next loop:
	return false;
	
}



