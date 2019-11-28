<?php

use Illuminate\Database\Seeder;

use App\Http\Controllers\OrderController;

class PrintSheetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $orders = DB::table('orders')->get('order_id');
      foreach ($orders as $order) {
        $controller = new OrderController();
        $controller->printOrder($order->order_id);
      }
    }
}
