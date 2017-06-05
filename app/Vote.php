<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
      'vote',
      'voted_id',
    ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
