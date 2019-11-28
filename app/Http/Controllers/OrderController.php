<?php

namespace App\Http\Controllers;

use App\Order;
use App\PrintSheet;
use App\PrintSheetItem;
use App\Http\Controllers\PrintSheetController;
use Illuminate\Http\Request;

class OrderController extends Controller
{

  public function showAllOrders()
  {
    // return response()->json(Order::all());
    return Order::all();
  }

  public function showOneOrder($id)
  {
    // $order = Order::with('products')->findOrFail($id);
    // return response()->json($order);
    return Order::with('products')->findOrFail($id);
  }

  public function printOrder($id)
  {
    $order = Order::with('products')->findOrFail($id);

    $items_id = [];
    foreach ($order->products as $prods) {
      if (!in_array($prods->pivot->order_item_id, $items_id)) {
        $items_id[] = $prods->pivot->order_item_id;
      }
    }

    $ps_id = PrintSheetItem::whereIn('order_item_id', $items_id)->groupBy('ps_id')->get('ps_id');
    if (count($ps_id) > 0) {

      return PrintSheet::with(['print_sheet_item' => function($query) {
        $query->whereHas('orders_items', function ($query) {
          $query->has('orders');
        });
      }])->whereIn('ps_id', $ps_id)->get();

    } else {

      $ps = new PrintSheetController();
      return response()->json($ps->create($order->products));

    }

  }

  public function renderListOrders()
  {
    return view('list_orders', ['orders' => $this->showAllOrders()]);
  }

  public function renderViewOrder($id)
  {
    return view('view_order', ['order' => $this->showOneOrder($id)]);
  }

}
