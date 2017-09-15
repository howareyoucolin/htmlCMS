<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

class Data_Manager{

	private $lines = array();

	public function __construct($input_file){
		
		$handle = fopen($input_file, "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				$this->lines[] = $line;
			}
		
			fclose($handle);
		} else {
			// error opening the file.
		} 
		
	}

	public function render_data_array(){
		
		GLOBAL $data;
		
		foreach($this->lines AS $key => $value){
			
			$value = trim($value);
			
			if (preg_match("/^([a-zA-Z0-9-_]+)\s*=\s*(.*)$/i", $value,$match)) {
				//Retrieve data:
				$data[$match[1]] = $match[2];
			} else {
				//ignore and continue next line:
				continue;
			}
		
		}//End Foreach
		
	}





















}
