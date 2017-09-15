<?php
if(!defined('SITE_URL')) die('Curiosity killed the cat!');

class Image_Manager{

	private $name;
	private $type;
	private $tmp;
	private $size;
	private $target_file;
	private $extension;
	private $width;
	private $height;
	private $imagick;

	public function __construct($file){
	
		$this->name = $file['name'];
		$this->type = $file['type'];
		$this->tmp= $file['tmp_name'];
		$this->size = $file['size'];
		$this->target_file = '../uploads/reg/'.time().rand(1,9999).strtolower(basename($this->name));
		$this->extension = pathinfo($this->target_file,PATHINFO_EXTENSION);
		
		$this->imagick = new Imagick($this->tmp);
		$d = $this->imagick->getImageGeometry(); 
		$this->width = $d['width']; 
		$this->height = $d['height'];
	
	}
	
	public function validate(){
		
		//Check size:
		$max_size=10097152;
		if($this->size > $max_size) throw new Exception('Image size exceeds limit of 9Mb.');
		
		//Check image type:
		if(!in_array($this->type,array("image/gif","image/jpeg","image/png","image/bmp"))) throw new Exception('Invalid image file type.');
		if($this->extension != "jpg" && $this->extension != "png" && $this->extension != "jpeg" && $this->extension != "gif" ) throw new Exception('Invalid image file extension.');
		
		// Check if image file is a actual image or fake image:
		if(!getimagesize($this->tmp)) throw new Exception('Looks like it\'s a fake image.');
		
	}

	/**
	* Generate thumb:
	**/
	public function generate_thumbnail($width=250,$height=250){
	
		$thumb_target_file = str_replace('/reg/','/thumbs/',$this->target_file);
		
		$w = $this->width;
		$h = $this->height;
		
		if($width == 0 AND $height == 0){
			//Do Nothing;
			$this->imagick->writeImage($thumb_target_file);
		}
		//Width=0 means width:auto;
		else if($width == 0){
			$this->imagick->resizeImage(((int)($w*$height/$h)),$height,Imagick::FILTER_LANCZOS,1);
			$this->imagick->writeImage($thumb_target_file);
		}
		//height=0 means height:auto;
		else if($height == 0){
			$this->imagick->resizeImage($width,((int)($width*$h/$w)),Imagick::FILTER_LANCZOS,1);
			$this->imagick->writeImage($thumb_target_file);
		}
		else{
			if($h/$height > $w/$width){
				//do w first:
				$this->imagick->resizeImage($width,((int)($t = $width*$h/$w)),Imagick::FILTER_LANCZOS,1);
				$this->imagick->cropImage($width,$height,0,((int)(abs(($t-$height)/2))));
				$this->imagick->writeImage($thumb_target_file);
			}else{
				//do h first:
				$this->imagick->resizeImage(((int)($t = $w*$height/$h)),$height,Imagick::FILTER_LANCZOS,1);
				$this->imagick->cropImage($width,$height,((int)(abs(($t-$width)/2))),0);
				$this->imagick->writeImage($thumb_target_file);
			}
		}
		
		return $this;
		
	}
	
	/**
	* Upload image:
	**/
	public function upload_image($width=0,$height=0){
		
		$w = $this->width;
		$h = $this->height;
		
		if($width == 0 AND $height == 0){
			//Do Nothing;
			$this->imagick->writeImage($this->target_file);
		}
		//Width=0 means width:auto;
		else if($width == 0){
			$this->imagick->resizeImage(((int)($w*$height/$h)),$height,Imagick::FILTER_LANCZOS,1);
			$this->imagick->writeImage($this->target_file);
		}
		//height=0 means height:auto;
		else if($height == 0){
			$this->imagick->resizeImage($width,((int)($width*$h/$w)),Imagick::FILTER_LANCZOS,1);
			$this->imagick->writeImage($this->target_file);
		}
		else{
			if($h/$height > $w/$width){
				//do w first:
				$this->imagick->resizeImage($width,((int)($t = $width*$h/$w)),Imagick::FILTER_LANCZOS,1);
				$this->imagick->cropImage($width,$height,0,((int)(abs(($t-$height)/2))));
				$this->imagick->writeImage($this->target_file);
			}else{
				//do h first:
				$this->imagick->resizeImage(((int)($t = $w*$height/$h)),$height,Imagick::FILTER_LANCZOS,1);
				$this->imagick->cropImage($width,$height,((int)(abs(($t-$width)/2))),0);
				$this->imagick->writeImage($this->target_file);
			}
		}
		
		return $this;
	
	}

	public function to_url(){
	
		return str_replace('../',SITE_URL,$this->target_file);
	
	}










}