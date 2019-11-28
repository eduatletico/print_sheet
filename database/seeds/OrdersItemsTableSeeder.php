<?php

use Illuminate\Database\Seeder;

class OrdersItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Order::class, 50)->create()->each(function($order) {
        $products = DB::table('products')->take(rand(2, 6))->get();
        foreach ($products as $product) {
          $quant = rand(0, 10);
          if ($quant > 0) {
            $order->products()->attach($product->product_id, ['quantity' => $quant]);
          }
        }
      });
    }
}
