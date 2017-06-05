<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
      $users = User::all();

      $users = $users->sortByDesc(function (User $user){
        return $user->rate + $user->votes;
      });
      return view('ranking.index')->with('users', $users);
    }
}
