<?php

namespace App\Http\Controllers;

use App\PrintSheet;
use App\PrintSheetItem;
use App\Classes\PrintSheet as PrintSheetClass;
use App\Classes\ViewPrintSheet as ViewPrintSheetClass;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrintSheetController extends Controller
{
  private $pages = [];
  private function addPage($products)
  {
    $printSheet = new PrintSheetClass();
    $products = $printSheet->place($products);

    $new_prods = [];
  	$prods_out_page = [];

  	foreach ($products as $prod) {
  		if ($prod["place"] != "add_page") {
  			$new_prods[] = $prod;
  		} else {
  			$prods_out_page[] = $prod;
  		}
  	}

    $this->pages[] = $new_prods;

    if (count($prods_out_page) > 0) {
  		$this->addPage($prods_out_page);
  	}

    return;
  }

  public function create($products)
  {
    $prods_to_print = [];
    foreach ($products as $product) {
      $dim = explode("x", $product->size);
      for ($i = 0; $i < $product->pivot->quantity; $i++) {
        $prods_to_print[] = [
          "w" => $dim[0],
          "h" => $dim[1],
          "order_item_id" => $product->pivot->order_item_id
        ];
      }
    }

    $this->addPage($prods_to_print);

    $ret_pages = [];
    foreach ($this->pages as $prods) {
      $ps = PrintSheet::create(['sheet_url' => 'http://sheet.url/'.Str::random(10)]);

      $order = 1;
      $items = [];
      foreach ($prods as $prod) {
        $ins = [
          'ps_id'         => $ps->ps_id,
          'order_item_id' => $prod['order_item_id'],
          'image_url'     => Str::random(10).'.png',
          'size'          => $prod['w'].'x'.$prod['h'],
          'x_pos'         => $prod['place']->x,
          'y_pos'         => $prod['place']->y,
          'width'         => $prod['w'],
          'height'        => $prod['h'],
          'identifier'    => $order
        ];

        // $ps->print_sheet_item()->attach($ps->ps_id, $ins);

        // PrintSheetItem::create($ins);
        $items[] = PrintSheetItem::create($ins);

        $order++;
      }
      $ps->print_sheet_item = $items;
      $ret_pages[] = $ps;
    }

    return $ret_pages;
  }

  public function showOnePrint($id)
  {
    $print = PrintSheet::with('print_sheet_item')->findOrFail($id);
    return response()->json($print);
  }

  public function generatePage(Request $request) {
    $print = new ViewPrintSheetClass();
    return response()->json($print->createPage($request->all()['items']));
  }
}
