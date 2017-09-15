<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

/**
* CZ is based on a lot of markers to generate editor admin panel,
* therefore this class is the core of the CZ auto-system-generated editor principle.
**/
class Marker_Manager{

	public function __construct(){}
	
	/**
	* Convert L markers, @param takes reference.
	*/
	public function translate_L_markers(&$content){
		
		$content = preg_replace('/(<\w+\s)((?:(?!>).)*)SYS_L_MARKER{(\w+)}((?:(?!<).)*>)/s', '$1 data-inline="$3" $2$4', $content);
		
	}

	/**
	* Convert P markers, @param takes reference.
	*/
	public function translate_P_markers(&$content){
		
		$content = preg_replace('/(<\w+\s)((?:(?!>).)*)SYS_P_MARKER{(\w+)}((?:(?!<).)*>)/s', '$1 data-photo="$3" $2$4', $content);
		
	}

	/**
	* Convert B markers, @param takes reference.
	*/
	public function translate_B_markers(&$content){
		
		$content = preg_replace('/(<\w+\s)((?:(?!>).)*)SYS_B_MARKER{(\w+)}((?:(?!<).)*>)/s', '$1 data-bg="$3" $2$4', $content);
		
	}
	
	/**
	* Convert G markers, @param takes reference.
	*/
	public function translate_G_markers(&$content){
		
		$content = preg_replace('/(<\w+\s)((?:(?!>).)*)SYS_G_MARKER{(\w+)}((?:(?!<).)*>)/s', '$1 data-gallery="$3" $2$4', $content);
		
	}

	public function translate_site_url(&$content){
	
		$content = str_replace('[SITE_URL]', SITE_URL, $content);
	
	}














}