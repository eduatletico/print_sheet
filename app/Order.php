<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $primaryKey = 'order_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'order_number', 'customer_id', 'total_price', 'fulfillment_status',
    'fulfilled_date', 'order_status', 'customer_order_count'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [];


  public function products()
  {
    return $this->belongsToMany('App\Product', 'orders_items', 'order_id', 'product_id')
                ->using('App\OrderItem')
                ->withPivot([
                  'order_item_id',
                  'quantity',
                  'refund',
                  'resend_amount'
                ]);
  }
}
