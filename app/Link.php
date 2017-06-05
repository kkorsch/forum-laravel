<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
  protected $fillable = ['link'];

  protected $table = 'activation_links';

  public function getRouteKeyName()
  {
      return 'link';
  }

  /*
  //relationships
  */
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
