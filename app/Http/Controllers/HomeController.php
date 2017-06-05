<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $topics = Topic::orderBy('created_at', 'desc')->get();
        return view('home')->with('topics', $topics);
    }

    public function post(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|max:250|unique:topics',
      ]);

      $user = $request->user();

      $user->topics()->create([
        'name' => $request->name,
        'slug' => str_slug($request->name),
      ]);

      return redirect()->back()->with('info', 'Topic added!');
    }

    public function delete(Topic $topic, Request $reqeust)
    {
      if(!$reqeust->user()->isAdminOrModerator()){
        return redirect('/home')->with('danger', 'You shall not pass !!!');
      }

      $topic->delete();

      return redirect()->back()->with('info', 'Topic has been removed.');
    }
}
