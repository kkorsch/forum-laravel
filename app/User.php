<?php

namespace App;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
      'rate', 'rateRounded', 'votes', 'myRole',
    ];


    public function getRouteKeyName()
    {
      return 'username';
    }

    public function getAvatar($size)
    {
      return "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm&s=" . $size;
    }

    public function isAdminOrModerator()
    {
      if($this->myRole == 'moderator' || $this->isAdmin() || $this->isBigAdmin()){
        return true;
      }
      return  false;
    }

    public function isBigAdminOrAdmin()
    {
      if($this->isAdmin() || $this->isBigAdmin()){
        return true;
      }
      return false;
    }

    public function isBigAdmin()
    {
      if($this->myRole == 'bigadmin'){
        return true;
      }
      return false;
    }

    public function isAdmin()
    {
      if($this->myRole == 'admin'){
        return true;
      }
      return false;
    }

    public function getMyRoleAttribute()
    {
      return $this->getMyRole();
    }

    protected function getMyRole()
    {
      return $this->role[0]['name'];
    }

    /*
    //voting
    */
    public function getRateAttribute()
    {
      return $this->voteRate();
    }

    public function getRateRoundedAttribute()
    {
      return round($this->voteRate());
    }

    public function getVotesAttribute()
    {
      return $this->voteCount();
    }

    public function hasVotedOn($user)
    {
      return (bool)$user->votes()->where('voted_id', Auth::user()->id)->count();
    }

    public function howVoted($user)
    {
      $vote = $user->votes()->where('voted_id', Auth::user()->id)->first();
      if($vote === null){
        return null;
      }
      return $vote->vote;
    }

    protected function voteCount()
    {
      return $this->votes()->get()->count();
    }

    protected function voteRate()
    {
      $votes = $this->votes()->get();

      if(!$votes->count()){
        return 0;
      }

      $total = 0;

      foreach($votes as $vote){
        $total += $vote->vote;
      }

      return $total/$votes->count();
    }

    /*
    //relationships
    */
    public function role()
    {
      return $this->belongsToMany(Role::class, 'roles_users');
    }

    public function posts()
    {
      return $this->hasMany(Post::class);
    }

    public function link()
    {
      return $this->hasOne(Link::class);
    }

    public function topics()
    {
      return $this->hasMany(Topic::class);
    }
     public function votes()
     {
       return $this->hasMany(Vote::class);
     }
}
