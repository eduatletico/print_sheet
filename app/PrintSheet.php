<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintSheet extends Model
{
  protected $table = 'print_sheet';
  protected $primaryKey = 'ps_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'type', 'sheet_url'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [];


  public function print_sheet_item()
  {
    return $this->hasMany('App\PrintSheetItem', 'ps_id', 'ps_id');
  }
}
