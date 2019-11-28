<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_items', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('order_item_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id')->index('product_id');
            $table->integer('quantity')->default(1);
            $table->bigInteger('refund')->nullable()->default(0)->index('refunded');
            $table->integer('resend_amount')->default(0);
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'))->index('created_at');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->index('updated_at');
            $table->unique(['order_id', 'product_id'], 'order_product');
            $table->foreign('order_id', 'orders_items_ibfk_1')->references('order_id')->on('orders');
            $table->foreign('product_id', 'orders_items_ibfk_2')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_items');
    }
}
