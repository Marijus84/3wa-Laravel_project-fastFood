<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{

  protected $fillable = [
      'network', 'adress_line_1', 'city', 'post_code', 'phone', 'image_url'
  ];

  public function review()
  {
    return $this->hasMany('App\Review','restaurant_id', 'id');
  }
}
