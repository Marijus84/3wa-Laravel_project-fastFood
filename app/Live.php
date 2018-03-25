<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
  protected $fillable = [
      'title', 'name', 'comment'
  ];
}
