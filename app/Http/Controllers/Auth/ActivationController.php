<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    public function activate(Link $link)
    {
      $link->user()->update([
        'active' => true,
      ]);

      $link->delete();

      Auth::login($link->user);

      return redirect('/home')->withInfo('Your account has been activated. Nice to meet you :)');
    }

    public function resend(Request $reqeust)
    {
        return 'maybe later';
    }
}
