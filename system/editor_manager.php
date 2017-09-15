<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

class Editor_Manager{

	private $markers = array();
	private $advanced_markers = array();
	
	public function __construct(){}
	
	/**
	* Collect markers:
	**/
	public function collect($name,$type,$title,$extra=array()){
		
		$t = &$this->markers[];//Take reference of new array;
		$t['name'] = $name;
		$t['type'] = $type;
		$t['title'] = $title;
		$t['extra'] = $extra;
		//Delete reference since it has no further use:
		unset($t);
		
	}
	
	/**
	* Collect advanced markers:
	**/
	public function collect_advanced($name,$type,$title,$input_type,$extra=array()){
		
		$t = &$this->advanced_markers[];//Take reference of new array;
		$t['name'] = $name;
		$t['type'] = $type;
		$t['title'] = $title;
		$t['input_type'] = $input_type;
		$t['extra'] = $extra;
		//Delete reference since it has no further use:
		unset($t);
		
	}

	/**
	* @array, returns an array of marker objects:
	**/
	public function get_markers(){
	
		return $this->markers;
	
	}
	
	/**
	* @array, returns an array of advanced marker objects:
	**/
	public function get_advanced_markers(){
	
		return $this->advanced_markers;
	
	}

}