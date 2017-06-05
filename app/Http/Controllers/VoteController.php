<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function vote(User $user, $vote)
    {
      if(Auth::user()->id == $user->id){
        return redirect('/home')->with('danger', 'You shall not pass !!!');
      }
      if(Auth::user()->hasVotedOn($user)){
        $user->votes()->where('voted_id', Auth::user()->id)->update([
          'vote' => $vote,
          ]);
          return redirect()->back()->with('info', "Thanks for rating {$user->username} for {$vote}!");

      }
        $user->votes()->create([
          'vote' => $vote,
          'voted_id' => Auth::user()->id,
        ]);


      return redirect()->back()->with('info', "Thanks for rating {$user->username} for {$vote}!");
    }
}
