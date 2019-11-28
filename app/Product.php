<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $primaryKey = 'product_id';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'vendor', 'type', 'size', 'price', 'handle',
    'inventory_quantity', 'sku', 'design_url', 'published_state'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [];


  public function orders()
  {
    return $this->belongsToMany('App\Order', 'orders_items', 'order_id', 'product_id')
                ->using('App\OrderItem')
                ->withPivot([
                  'order_item_id',
                  'quantity',
                  'refund',
                  'resend_amount'
                ]);
  }
}
