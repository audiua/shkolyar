<?php

class TextInImgHelper{
	public $text_array=array();
	public $font = 'font/Verdana-Regular.ttf';

	// public function __construct($item){
	// 	$this->text = $item->file;
	// }

	public function create(){

		$this->text_array = file('тореадори.txt');

		$ii=1;
		while( count($this->text_array) ){
			$str = '';

			$im = ImageCreate (700, 2800) 
			        or die ("Ошибка при создании изображения");         
			$white = ImageColorAllocate($im, 255, 255, 255); 
			$black = ImageColorAllocate($im, 0, 0, 0);
			
			while( strlen($str) < 6500 ){
				$str .= array_shift($this->text_array);
				if( count($this->text_array) === 0){
					break;
				}
			}
			$str = wordwrap($str, 170, "\n");
			imagettftext($im, 9, 0, 10, 20, $black, $this->font, $str);
			ImagePng($im, 'test/'.$ii.'.png', 9); 

			imagedestroy($im);

			$ii++;

		}


		$this->crop();

	}

	public function crop(){

		$all = scandir('test');

		foreach( $all as $i => $file ){
			if($file === '.' || $file === '..'){
				continue;
			}

			$imgSize = getimagesize("test/".$file);
			$img = imagecreatefrompng("test/".$file);
			
			$x=0;
			$y=$imgSize[1]-1;

			while( $y ){

				while( $x < $imgSize[0] ){
					$ix = imagecolorat($img, $x, $y);

					$colors = imagecolorsforindex($img, $ix);
					// d($colors);
					if( ! $colors['red'] == 255 || ! $colors['green'] == 255 || ! $colors['blue'] == 255 ){
						break(2);

					}

					$x++;
				}

				$x=0;
				--$y;
			}

			$emptyHeigth = $imgSize[1] - $y - 10;

			$newImg  = ImageCreate( $imgSize[0], $imgSize[1]-$emptyHeigth );
			imageCopy($newImg, $img, 0, 0, 0, 0, $imgSize[0], $imgSize[1]-$emptyHeigth );
			ImagePng($newImg, 'test/'.$file, 9);
			imagedestroy($newImg);
		}


	}


}
