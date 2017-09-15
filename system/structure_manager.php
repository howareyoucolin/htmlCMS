<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

class Structure_Manager{

	private $menu = array();

	public function __construct($input_file){
		
		$handle = fopen($input_file, "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				
				$line = trim($line);
				if($line == '') continue;//Skip empty line;
				
				if (preg_match("/^(\w+)\:\:$/i", $line, $match)) {
		
					$key = $match[1];
					//Preset options' default value for this key:
					$this->menu[$key]['name'] = $key;
					$this->menu[$key]['front'] = '1';
					$this->menu[$key]['back'] = '1';
					
				}else if(preg_match("/^(\w+)\s*=\s*(.+)$/i", $line, $match)){
				
					$option = $match[1];
					$value = $match[2];
					$this->menu[$key][$option] = $value;
					
				}else{
				
					$this->menu[$key]['modules'][] = $line;
				
				}
			
			}
		
			fclose($handle);
		} else {
			// error opening the file.
		} 
		
	}
	
	public function get_menu(){
		
		$menu = array();
		
		if(MODE == 'web'){
		
			foreach($this->menu as $key => $item){
			
				if(!$item['front']) continue;//If front set to be false, skip and does not render;
						
				$menu[$key] = $item['name']; 
			
			}
		
		}else if(MODE == 'editor'){
			
			foreach($this->menu as $key => $item){
			
				if(!$item['back']) continue;//If front set to be false, skip and does not render;

				$menu[$key] = $item['name']; 
			
			}
			
		}
		
		return $menu;
	
	}
	
	public function get_page_structure($page){
	
		return $this->menu[$page]['modules'];
	
	}
	
	
	
}