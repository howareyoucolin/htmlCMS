<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

class Template_Loader{
	
	private $views = array();
	private $styles = array();
	private $scripts = array();
	private $heads = array();
	
	public function __construct($views = array()){
		
		$this->views = $views;
		
	}
	
	private function print_head(){
		
		//For SEO:
		$arg = '';
		if(isset($_GET['arg1'])) $arg = 'arg'.$_GET['arg1'].'_';
		
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title><?php echo (!($t=__V($arg.'seo_title*','SEO Title',false)))?__('seo_title_home'):__($arg.'seo_title*');?></title>
			<meta name="description" content="<?php echo (!($t=__V($arg.'seo_description*','SEO Description',false)))?__('seo_description_home'):__($arg.'seo_description*');?>">
			<meta name="keywords" content="<?php echo (!($t=__V($arg.'seo_keyword*','SEO Keyword',false)))?__('seo_keyword_home'):__($arg.'seo_keyword*');?>">
			<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

			<link title="nocache" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
			<script  title="nocache" src="<?php echo SITE_URL;?>/assets/srcs/jquery.js"></script>
			<script  title="nocache" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/srcs/helper.css">
			
			<?php foreach($this->styles as $style){
				echo '<link rel="stylesheet" href="'.$style.'?'.time().'">';
			}?>
			
			<?php foreach($this->scripts as $script){
				echo '<script src="'.$script.'?'.time().'"></script>';
			}?>
			
			<?php foreach($this->heads as $head){
				echo file_get_contents($head);
			}?>
			
			<?php //Load Custom Scripts:
			if(count($this->data['custom_scripts']) > 0){
			foreach($this->data['custom_scripts'] as $script){
				echo $script;
			}
			}?>
			
			<?php //Load Custom Head Html Tags:
			if(count($this->data['custom_head']) > 0){
			foreach($this->data['custom_head'] as $html){
				echo $html;
			}
			}?>
			 
		</head>
		<body>
		<div class="loading"><div class="loader">LOADING ...</div></div>
		<?php
		
	}
	
	private function print_foot(){
		echo '</body></html>';
		?>
		<script combine>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-83133433-3', 'auto');
		ga('send', 'pageview');
		</script>
		<?php
	}
	
	private function print_body(){
		
		global $data;
		$index = 1;
		
		//Check View Types：
		foreach($this->views as $view){
			
			//Retrieve module variable:
			$data['module_var'] ='';
			if(preg_match('/.*\{(.*?)\}$/i', $view, $match)){
				$data['module_var'] = $match[1];
				$view = preg_replace('/{.*}$/i', '', $view);
			}
			
			$data['module_index'] = 0;
			$v = str_replace('*','',$view);
			//Count how many times a same view has been loaded:
			for($i=0;$i<$index;$i++){
				if($v==str_replace('*','',$data['structure'][$i])) $data['module_index']++;
			}
			$index++;
			
			//Echo a seperator:
			if(preg_match('/^\s*\[h(\d+)\]\s*$/i', $view, $match)) {
				$n = (int)$match[1];
				echo '<div class="sep" style="clear:both;height:'.$n.'px;"></div>';
			}
			else if(preg_match('/^\s*\[-h(\d+)\]\s*$/i', $view, $match)) {
				$n = (int)$match[1];
				echo '<div class="sep" style="clear:both;height:1px;margin-top:-'.$n.'px;"></div>';
			}
			
			//Custom template:
			else if (preg_match('/^\s*custom-(\w+)\*?\s*$/i', $view, $match)) {
				//If there is a star marker, no echo auto-wrapper: 
				if(substr($view , -1) == '*'){
					include('custom/templates/'.$match[1].'.php');
				}
				else{		
					echo '<div id="'.$view.'">';
					include('custom/templates/'.$match[1].'.php');
					echo '</div>';
				}
			} 
			
			//System templates:
			else if (preg_match('/^\s*(\w+)-(\w+)\*?\s*$/i', $view, $match)) {	
				$TEMPLATE_URL = SITE_URL.'templates/'.$match[1].'/'.$match[2].'/';
				if(substr($view , -1) == '*'){
					//If there is a star marker, no echo auto-wrapper: 
					include('templates/'.$match[1].'/'.$match[2].'/index.php');
				}
				else{
					echo '<div id="'.$view.'">';
					include('templates/'.$match[1].'/'.$match[2].'/index.php');
					echo '</div>';
				}
			//Custom plain html code:
			}else{
				echo $view;
			}
			
		}
		
	}
	
	public function init_styles(){
		
		if(!$this->views){
			header('Location:'.SITE_URL.'404');
			exit(1);
		}
			
		foreach($this->views as $view){		
			$view = preg_replace('/{.*}$/i', '', $view);
			$parts = explode("-", $view);			

			if(isset($parts[0]) and isset($parts[1]) and file_exists('templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'style.css')) {		
				//sep;
				$this->styles[] = SITE_URL.'templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'style.css';				
			}			
		}
		
		//Load Custom CSS:
		$dir = new DirectoryIterator('./custom/css/');
		foreach ($dir as $fileinfo) {
			if (!$fileinfo->isDot()) {
				$this->styles[] = SITE_URL.'/custom/css/'.$fileinfo->getFilename();
			}
		}
		
		GLOBAL $data;
		if(isset($data['config']['skin']) and count($data['config']['skin']) > 0){
			foreach($data['config']['skin'] as $skin){
				if(trim($skin)=='') continue;
				$this->styles[] = SITE_URL.'templates/skins/'.$skin.'.css';
			}
		}
		
	}
	
	public function init_scripts(){
		
		foreach($this->views as $view){	
			$view = preg_replace('/{.*}$/i', '', $view);
			$parts = explode("-", $view);			
			if(file_exists('templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'script.js')) {				
				$this->scripts[] = SITE_URL.'templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'script.js';				
			}			
		}
		
		//Load Custom JS:
		$dir = new DirectoryIterator('./custom/js/');
		foreach ($dir as $fileinfo) {
			if (!$fileinfo->isDot()) {
				$this->scripts[] = SITE_URL.'/custom/js/'.$fileinfo->getFilename();
			}
		}
		
	}
	
	public function init_heads(){
	
		foreach($this->views as $view){	
			$view = preg_replace('/{.*}$/i', '', $view);
			$parts = explode("-", $view);			
			if(file_exists('templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'head.html')) {				
				$this->heads[] = SITE_URL.'templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'head.html';				
			}		
		}
		
		//Load Custom HEAD:
		$dir = new DirectoryIterator('./custom/head/');
		foreach ($dir as $fileinfo) {
			if (!$fileinfo->isDot()) {
				$this->heads[] = SITE_URL.'/custom/head/'.$fileinfo->getFilename();
			}
		}
		
	}
	
	public function render(){
		
		$this->init_styles();
		$this->init_scripts();
		$this->init_heads();
		
		$this->print_head();
		$this->print_body();
		$this->print_foot();
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

