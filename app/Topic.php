<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
  protected $fillable = [
    'name',
    'slug',
  ];

  protected $appends = ['postsCount'];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function getPostsCountAttribute()
  {
    return $this->postCount();
  }

  protected function postCount()
  {
    return $this->posts()->get()->count();
  }

  /*
  //relationships
  */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function posts()
  {
    return $this->hasMany(Post::class);
  }
}
