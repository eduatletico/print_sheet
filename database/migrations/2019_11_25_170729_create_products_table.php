<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('product_id');
            $table->string('title', 100)->default('')->index('title');
            $table->string('vendor', 50)->nullable()->index('vendor');
            $table->string('type', 25)->nullable()->index('type');
            $table->string('size', 20)->nullable()->index('size');
            $table->float('price')->default(0);
            $table->string('handle', 75)->nullable();
            $table->integer('inventory_quantity')->default(0);
            $table->string('sku', 30)->nullable()->index('sku');
            $table->string('design_url', 255)->nullable();
            $table->enum('published_state', ['inactive', 'active'])->default('active')->index('published_state');
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'))->index('created_at');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
