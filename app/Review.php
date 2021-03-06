<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  public function restaurant()
  {
    return $this->hasOne('App\Restaurant','id', 'restaurant_id');
  }

  public function user()
  {
    return $this->hasOne('App\User','id', 'user_id');
  }
}
