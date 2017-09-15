<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

class Cache_Manager{
	
	private $cache_path = '';
	
	public function __construct($url){
		if(!file_exists('cache/')){
			mkdir('cache/');
		}
		$this->cache_path = preg_replace('/[=\?]/','-',$url);
		$this->cache_path = 'cache/'.preg_replace('/\W/','_',$this->cache_path);
	}
	
	public function get_css_cache_path(){
		return $this->cache_path.'.css';
	}
	
	public function get_js_cache_path(){
		return $this->cache_path.'.js';
	}
	
	public function get_html_cache_path(){
		return $this->cache_path.'.html';
	}
	
	public function get_mobile_html_cache_path(){
		return $this->cache_path.'_mobile.html';
	}
	
	public function compress_images(&$content,$quality){
		if(!file_exists('cache/'.$quality)){
			mkdir('cache/'.$quality);
		}
		if(!file_exists('cache/'.$quality.'/reg/')){
			mkdir('cache/'.$quality.'/reg/');
		}
		if(!file_exists('cache/'.$quality.'/thumbs/')){
			mkdir('cache/'.$quality.'/thumbs/');
		}
		preg_match_all('/<img.*?src\s*=\s*[\'\"](.*?)[\'\"].*?>|background\s*\:\s*url\s*\(\s*[\'\"]?(.*?)[\'\"]?\s*\)/i', $content, $matches);
		$images = array_merge($matches[1],$matches[2]);
		//echo '<pre>';var_dump($images);die;
		foreach($images as $image){
			if (strpos($image, SITE_URL.'uploads/') === false OR trim($image)=='') continue;//Only compress our own site's uploaded image;
			//clean up images' postfix:
			$image = preg_replace('/\?\d*$/','',$image);
			$path = str_replace(SITE_URL,'',$image);
			$compressed_image = $this->compress($path, 'cache/'.str_replace('uploads/',$quality.'/',$path), $quality);
			//Replace image with a smaller one as display:
			$content = str_replace($image,SITE_URL.$compressed_image,$content);
		}
	}
	
	private function compress($source, $destination, $quality) {
		$info = getimagesize($source);
		if($info['mime'] == 'image/jpeg'){ 
			$image = imagecreatefromjpeg($source);
			imagejpeg($image, $destination, $quality);
		}elseif($info['mime'] == 'image/gif'){
			$image = imagecreatefromgif($source);
			imagegif($image, $destination, $quality);
		}elseif($info['mime'] == 'image/png'){
			//For Now:
			copy($source, $destination);
		}
		return $destination;
	}
	
}