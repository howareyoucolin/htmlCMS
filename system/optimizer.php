<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

class Optimizer{
	
	public function __construct(){}

	public function trim_spaces(&$content){
		return $content = preg_replace('/\s+/', ' ', $content);
	}

	public function combine_css(&$content,$cached_file,$inline=false){
		preg_match_all('/<link((?!nocache).)*?href\s*=\s*[\'\"](.*?)[\'\"].*?>/i', $content, $matches);
		$css_files = $matches[2];
		$text = '';
		foreach($css_files as $css){
			$text .= file_get_contents(preg_replace('/^\/\//','http://',$css));
		}
		$this->trim_spaces($text);
		file_put_contents($cached_file,$text);
		$content = preg_replace('/<link((?!nocache).)*?href\s*=\s*[\'\"](.*?)[\'\"].*?>/i','',$content);
		if($inline){
			$content = str_replace('</head>','<style>'.$text.'</style></head>',$content);
		}else{
			$content = str_replace('</head>','<link rel="stylesheet" href="'.SITE_URL.$cached_file.'"></head>',$content);
		}
		return $text;
	}
	
	public function combine_js(&$content,$cached_file,$inline=false){
		preg_match_all('/<script((?!nocache).)*?src\s*=\s*[\'\"](.*?)[\'\"].*?<\/script>/i', $content, $matches);
		$js_files = $matches[2];
		$text = '';
		foreach($js_files as $js){
			$text .= file_get_contents(preg_replace('/^\/\//','http://',$js));
		}
		preg_match_all('/<script\s+combine.*?>(.*?)<\/script>/is', $content, $matches);
		$js_files = $matches[1];
		foreach($js_files as $js){
			$text .= $js;
		}
		file_put_contents($cached_file,$text);
		$content = preg_replace('/<script((?!nocache).)*?src\s*=.*?>\s*<\/script>/i','',$content);
		$content = preg_replace('/<script\s+combine.*?>(.*?)<\/script>/is','',$content);
		if($inline){
			$content = str_replace('</body>','<script>'.$text.'</script></body>',$content);
		}else{
			$content = str_replace('</body>','<script defer src="'.SITE_URL.$cached_file.'?i"></script></body>',$content);
		}
		return $text;
	}

}