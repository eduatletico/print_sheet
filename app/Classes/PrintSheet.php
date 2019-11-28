<?php

namespace App\Classes;

use App\Classes\PlaceProduct as PlaceProduct;

class PrintSheet
{
  public $page;

  public function __construct()
  {
    $this->init(config('page.size.width'), config('page.size.height'));
  }

  public function init($w, $h)
  {
    $this->page = new PlaceProduct(0, 0, $w, $h);
  }

  public function place($products)
  {
    $products = $this->sortProducts($products);
    foreach ($products as &$product) {
      $product['order_item_id'] = $product['order_item_id'];
      $product['place'] = null;
      if ($placeProduct = $this->findProduct($this->page, $product['w'], $product['h'])) {
        $product['place'] = $this->splitProduct($placeProduct, $product['w'], $product['h']);
      } else {
				$product['place'] = "add_page";
			}
    }
    return $products;
  }

  public function findProduct($placeProduct, $w, $h)
  {
    if ($placeProduct->used) {
      return $this->findProduct($placeProduct->right, $w, $h) ?: $this->findProduct($placeProduct->down, $w, $h);
    } else if ($w <= $placeProduct->w && $h <= $placeProduct->h) {
      return $placeProduct;
    }
    return null;
  }

  public function splitProduct($placeProduct, $w, $h)
  {
    $placeProduct->used = true;
    $placeProduct->down = new PlaceProduct($placeProduct->x, $placeProduct->y + $h, $placeProduct->w, $placeProduct->h - $h);
    $placeProduct->right = new PlaceProduct($placeProduct->x + $w, $placeProduct->y, $placeProduct->w - $w, $h);
    return $placeProduct;
  }

  public function sortProducts($products)
  {
    usort($products, function($a, $b) {
      $a_maxside = max($a['w'], $a['h']);
      $b_maxside = max($b['w'], $b['h']);
      return $a_maxside < $b_maxside;
    });
    return $products;
  }
}
