<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

class Editor_Loader{
	
	private $views = array();
	private $styles = array();
	private $scripts = array();
	private $heads = array();
	
	public function __construct($views = array()){
		
		$this->views = $views;
		
	}
	
	public function print_head(){
		
		GLOBAL $EDITOR;
		
		//For SEO:
		$arg = '';
		if(isset($_GET['arg1'])) $arg = 'arg'.$_GET['arg1'].'_';
		
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>CZ Editor - <?php echo (!($t=__V($arg.'seo_title*','SEO Title',false)))?__('seo_title_home'):__($arg.'seo_title*');?></title>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="<?php echo (!($t=__V($arg.'seo_description*','SEO Description',false,'A')))?__('seo_description_home'):__($arg.'seo_description*');?>">
			<meta name="keywords" content="<?php echo (!($t=__V($arg.'seo_keyword*','SEO Keyword',false)))?__('seo_keyword_home'):__($arg.'seo_keyword*');?>">
			<meta name="author" content="Colin Chiu">
			<meta name="format-detection" content="telephone=no">

			<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
			<script src="<?php echo SITE_URL;?>/assets/srcs/jquery.js"></script>
			<script src="<?php echo SITE_URL;?>/assets/srcs/bootstrap.js"></script>
			<script src="<?php echo SITE_URL;?>/assets/srcs/jquery-ui.js"></script>
			<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/srcs/helper.css?41">
			<link rel="stylesheet" href="../assets/srcs/fontawesome/css/font-awesome.min.css">
			
			<link rel="stylesheet" href="css/style.css?<?php echo time();?>">
			<link rel="stylesheet" href="css/ui.css?<?php echo time();?>">
			
			<?php //After save action, popup saved message dialog.
			if(isset($_SESSION['saved'])):?>
				<script>var SAVED = true;//Super global var;</script>
			<?php unset($_SESSION['saved']); endif;?>
			
			<script src="js/ui.js?<?php echo time();?>"></script>
			<script src="js/photo.js?<?php echo time();?>"></script>
			<script src="js/effect.js?<?php echo time();?>"></script>
			<script src="js/loop-spy.js?<?php echo time();?>"></script>
			<script src="js/script.js?<?php echo time();?>"></script>
			
			<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald&id=oswald" />
			
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
			
			<header class="sys">
			
				<h1 class="sys">
					CZ Editor
				</h1>
				
				<ul id="sys-menu" class="sys">
					<li class="pull-right"><a href="../admin/logout.php">logout</a></li>
					<li class="pull-right"><a target="_blank" href="<?php echo str_replace('/editor/','/',CURRENT_URL);?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></li>
					<?php if(isset($_SESSION['loggedin']) and $_SESSION['loggedin'] > 4):?>
						<li class="pull-right"><a href="advanced_edit.php">Advanced Edit</a></li>
						<li class="pull-right"><a href="advanced_admin.php">Admin Management</a></li>
					<?php endif;?>
					<?php foreach(__('menu') AS $key => $value):?>
						<li><a href="<?php echo EDITOR_URL.$key;?>"><?php echo $value;?></a></li>
					<?php endforeach;?>
					<li id="top-save" class="top-save"><a href="#">Save</a></li>
				</ul>
				
			</header>
			<aside class="sys">
			
				<form id="sys-form" action="save.php" method="POST" enctype="multipart/form-data">
				
					<?php foreach($EDITOR->get_markers() AS $marker):?>
						<div class="unit" <?php if(!$marker["title"]) echo 'style="display:none;"';?>>
							<label class="sys-label"><?php echo (!$marker["title"])?ucwords(preg_replace('/_+/',' ',preg_replace('/_\d+$/','',$marker["name"]))):$marker["title"];?>:</label> <span data-name="<?php echo $marker["name"];?>" class="zoom"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span><br/>
							<?php if($marker["type"] == 'T'):?>
								<input name="<?php echo $marker["name"];?>" type="text" class="sys-input form-control" value="<?php echo __($marker["name"]);?>"/>
							<?php elseif($marker["type"] == 'S'):?>
								<select name="<?php echo $marker["name"];?>" class="sys-input form-control">
									<?php $v = __($marker["name"]);?>
									<?php foreach($marker["extra"] AS $option):?>
										<option value="<?php echo $option;?>" <?php if($v==$option) echo 'selected';?>><?php echo $option;?></option>
									<?php endforeach;?>
								</select>
							<?php elseif($marker["type"] == 'A'):?>
								<span style="margin-top:-15px;" class="fullscreen pull-right glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
								<textarea name="<?php echo $marker["name"];?>" class="sys-textarea form-control"><?php echo preg_replace('/<br\s?\/>/i', "\r\n",__($marker["name"]));?></textarea>
							<?php elseif($marker["type"] == 'L'):?>
								<input name="<?php echo $marker["name"];?>" type="text" class="sys-input form-control" value="<?php echo __($marker["name"]);?>"/>
							<?php elseif($marker["type"] == 'P'):?>						
								<img class="single_image" src="<?php echo (!__($marker["name"]))?SITE_URL.'assets/images/void.png':__($marker["name"]);?>" />
								<div class="delete_image"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></div>
								<input class="single" type="file" data-w="<?php echo $marker["extra"]['w'];?>" data-h="<?php echo $marker["extra"]['h'];?>" data-tw="<?php echo $marker["extra"]['thumb_w'];?>" data-th="<?php echo $marker["extra"]['thumb_h'];?>" name="<?php echo $marker["name"];?>" value="" />
								<input type="hidden" name="<?php echo $marker["name"];?>" value="<?php echo __($marker["name"]);?>" />
							<?php elseif($marker["type"] == 'B'):?>
								<img class="single_image" src="<?php echo (!__($marker["name"]))?SITE_URL.'assets/images/void.png':__($marker["name"]);?>" />
								<div class="delete_image"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></div>
								<input class="single" type="file" data-w="<?php echo $marker["extra"]['w'];?>" data-h="<?php echo $marker["extra"]['h'];?>" data-tw="<?php echo $marker["extra"]['thumb_w'];?>" data-th="<?php echo $marker["extra"]['thumb_h'];?>" name="<?php echo $marker["name"];?>" value="" />
								<input type="hidden" name="<?php echo $marker["name"];?>" value="<?php echo __($marker["name"]);?>" />
							<?php elseif($marker["type"] == 'G'):?>
								<img class="multi_images" src="<?php echo SITE_URL.'assets/images/multi.jpg';?>" />
								<input class="multi" type="file" data-w="<?php echo $marker["extra"]['w'];?>" data-h="<?php echo $marker["extra"]['h'];?>" data-tw="<?php echo $marker["extra"]['thumb_w'];?>" data-th="<?php echo $marker["extra"]['thumb_h'];?>" name="<?php echo $marker["name"];?>[]" multiple />
								<input type="hidden" name="<?php echo $marker["name"];?>" value="<?php echo __($marker["name"]);?>" />
							<?php endif;?>
						</div>
					<?php endforeach;?>
					
					<h6>Advanced Settings <button class="advanced-switch btn btn-default"> + </button></h6>
					<div id="advanced">
						<p class="hint">Warning: Advanced section is designed for people who have programming technical background use ONLY. If you don't have enough technical knowledge as background. It's highly suggested NOT to edit the section below.</p>
						<?php foreach($EDITOR->get_advanced_markers() AS $marker):?>
							<label class="sys-label"><?php echo (!$marker["title"])?ucwords(preg_replace('/_+/',' ',preg_replace('/_\d+$/','',$marker["name"]))):$marker["title"];?>:</label><br/>
							<?php if($marker["input_type"]=='T'):?>
								<input name="<?php echo $marker["name"];?>" type="text" class="advanced-input sys-input form-control" value="<?php echo str_replace('"','&quot;',__($marker["name"]));?>"/>
							<?php else:?>
								<textarea name="<?php echo $marker["name"];?>" class="advanced-input sys-input form-control" ><?php echo __($marker["name"]);?></textarea>
							<?php endif;?>
						<?php endforeach;?>
					</div>
					
					<input type="hidden" name="page_url" value="<?php echo CURRENT_URL;?>"/>
					<input type="submit" name="save_btn" value="save" style="display:none;"/>
					
				</form>
				
			</aside>
			<section class="sys">
		<?php
		
	}
	
	public function print_foot(){
		
		echo '</section></body></html>';
		
	}
	
	public function print_body(){
		
		global $data;
		$index = 1;
		
		//Check View Types£º
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
					include('../custom/templates/'.$match[1].'.php');
				}
				else{		
					echo '<div id="'.$view.'">';
					include('../custom/templates/'.$match[1].'.php');
					echo '</div>';
				}
			} 
			
			//System templates:
			else if (preg_match('/^\s*(\w+)-(\w+)\*?\s*$/i', $view, $match)) {	
				$TEMPLATE_URL = SITE_URL.'templates/'.$match[1].'/'.$match[2].'/';
				if(substr($view , -1) == '*'){
					//If there is a star marker, no echo auto-wrapper: 
					include('../templates/'.$match[1].'/'.$match[2].'/index.php');
				}
				else{
					echo '<div id="'.$view.'">';
					include('../templates/'.$match[1].'/'.$match[2].'/index.php');
					echo '</div>';
				}
			
			//Custom plain html code:
			}else{
				echo $view;
			}
			
		}
		
	}
	
	public function init_styles(){
		
		foreach($this->views as $view){	
			$view = preg_replace('/{.*}$/i', '', $view);
			$parts = explode("-", $view);			
			if(file_exists('../templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'style.css')) {				
				$this->styles[] = SITE_URL.'templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'style.css';				
			}			
		}
		
		//Load Custom CSS:
		$dir = new DirectoryIterator('../custom/css/');
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
			if(file_exists('../templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'script.js')) {				
				$this->scripts[] = SITE_URL.'templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'script.js';				
			}			
		}
		
		//Load Custom JS:
		$dir = new DirectoryIterator('../custom/js/');
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
			if(file_exists('../templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'head.html')) {				
				$this->heads[] = SITE_URL.'templates/'.$parts[0].'/'.str_replace('*','',$parts[1]).'/'.'head.html';				
			}		
		}
		
		//Load Custom HEAD:
		$dir = new DirectoryIterator('../custom/head/');
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
		
		//In order to collect all markers, must force to run print_body() prior to print_head():
		ob_start();
		$this->print_body();
		$body = ob_get_contents();
		ob_end_clean();
		
		$this->print_head();
		echo $body;
		$this->print_foot();
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

