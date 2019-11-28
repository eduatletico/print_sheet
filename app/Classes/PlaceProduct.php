<?php

namespace App\Classes;

class PlaceProduct
{
  public $x, $y, $w, $h, $used, $right, $down;

  public function __construct($x, $y, $w, $h, $used = false, $right = null, $down = null) {
    $this->x = $x;
    $this->y = $y;
    $this->w = $w;
    $this->h = $h;
    $this->used = $used;
    $this->right = $right;
    $this->down = $down;
  }
}
