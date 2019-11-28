<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'title' => 'Product 1',
                'size' => '1x1'
            ],
            [
                'title' => 'Product 2',
                'size' => '2x2'
            ],
            [
                'title' => 'Product 3',
                'size' => '3x3'
            ],
            [
                'title' => 'Product 4',
                'size' => '4x4'
            ],
            [
                'title' => 'Product 5',
                'size' => '5x2'
            ],
            [
                'title' => 'Product 6',
                'size' => '2x5'
            ]
        ];
        DB::table('products')->insert($products);
    }
}
