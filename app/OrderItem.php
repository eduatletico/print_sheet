<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
  protected $table = 'orders_items';
  protected $primaryKey = 'order_item_id';

  public $incrementing = true;

  protected $fillable = [
    'order_id', 'product_id', 'quantity', 'refund', 'resend_amount'
  ];

  public function orders()
  {
    return $this->belongsTo('App\Order', 'order_id', 'order_id');
  }

  public function print_sheet_item()
  {
    return $this->hasOne('App\PrintSheetItem', 'order_item_id', 'order_item_id');
  }
}
