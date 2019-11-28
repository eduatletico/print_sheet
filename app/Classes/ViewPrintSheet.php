<?php

namespace App\Classes;

use App\Classes\PlaceProduct as PlaceProduct;

class ViewPrintSheet
{
  private $_width, $_height;
  private $_mult = 50;

  public function __construct()
  {
    $this->_width = config('page.size.width') * $this->_mult;
    $this->_height = config('page.size.height') * $this->_mult;
  }

  private function imageCreateTrueColorTransparent()
  {
  	$im = imagecreatetruecolor($this->_width, $this->_height);
  	imagesavealpha($im, true);

  	$transColor = imagecolorallocatealpha($im, 0, 0, 0, 127);
  	imagefill($im, 0, 0, $transColor);

  	return $im;
  }

  public function createPage($page)
  {
  	$sheet = $this->imageCreateTrueColorTransparent($this->_width, $this->_height);
  	$black = imagecolorallocate($sheet, 0, 0, 0);
  	foreach ($page as $i => $prod) {
      $prod["x_pos"] = $prod["x_pos"] * $this->_mult;
      $prod["y_pos"] = $prod["y_pos"] * $this->_mult;
      $prod["width"] = $prod["width"] * $this->_mult;
      $prod["height"] = $prod["height"] * $this->_mult;
  		$red = mt_rand(0, 255);
  		$green = mt_rand(0, 255);
  		$blue = mt_rand(0, 255);
  		imagefilledrectangle($sheet, $prod["x_pos"], $prod["y_pos"], $prod["x_pos"] + $prod["width"], $prod["y_pos"] + $prod["height"], imagecolorallocatealpha($sheet, $red, $green, $blue, 64));
  		imagerectangle($sheet, $prod["x_pos"], $prod["y_pos"], $prod["x_pos"] + $prod["width"], $prod["y_pos"] + $prod["height"], imagecolorallocate($sheet, $red, $green, $blue));
  		imagestring($sheet, 10, $prod["x_pos"] + 2, $prod["y_pos"] + 2, ($prod["width"] / $this->_mult)."/".($prod["height"] / $this->_mult), $black);
  	}

    $file = 'tmp/print_'.md5(date('YmdHis')).'.png';
  	imagepng($sheet, $file);

    return $file;
  }
}
