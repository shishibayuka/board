<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
  use HasFactory;

  // 従テーブル(posts)から主テーブル(users)の情報を複数引き出す
  public function user()
  {
    // return $this->belongsTo('User::class');
    return $this->belongsTo('App\Models\User');
  }
}
