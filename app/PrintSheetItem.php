<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintSheetItem extends Model
{
  protected $table = 'print_sheet_item';
  protected $primaryKey = 'psi_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'ps_id', 'order_item_id', 'status', 'image_url', 'size',
    'x_pos', 'y_pos', 'width', 'height', 'identifier'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [];


  public function print_sheet()
  {
    return $this->belongsTo('App\PrintSheet', 'ps_id', 'ps_id');
  }

  public function orders_items()
  {
    return $this->belongsTo('App\OrderItem', 'order_item_id', 'order_item_id');
  }
}
