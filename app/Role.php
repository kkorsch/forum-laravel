<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

  /*
  //relationships
  */
    public function users()
    {
      return $this->belongsToMany(User::class, 'roles_users');
    }
}
