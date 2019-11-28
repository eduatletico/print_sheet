<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintSheetItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_sheet_item', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('psi_id');
            $table->unsignedInteger('ps_id')->index('ps_id');
            $table->unsignedBigInteger('order_item_id')->index('order_item_id');
            $table->enum('status', ['pass', 'reject', 'complete'])->default('pass')->index('status');
            $table->string('image_url', 255);
            $table->string('size', 255);
            $table->integer('x_pos');
            $table->integer('y_pos');
            $table->integer('width');
            $table->integer('height');
            $table->string('identifier', 255);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->foreign('ps_id', 'print_sheet_item_ibfk_1')->references('ps_id')->on('print_sheet');
            $table->foreign('order_item_id', 'print_sheet_item_ibfk_2')->references('order_item_id')->on('orders_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_sheet_item');
    }
}
