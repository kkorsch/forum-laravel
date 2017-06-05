<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index(Topic $topic)
    {
      $posts = $topic->posts()->orderBy('created_at', 'desc')->get();

      return view('topics.index')->with([
        'topic' => $topic,
        'posts' => $posts,
      ]);
    }

    public function addPost(Topic $topic, Request $request)
    {
      $this->validate($request, [
        'body' => 'required|max:250',
      ]);

      $request->user()->posts()->create([
        'body' => $request->body,
        'topic_id' =>$topic->id,
      ]);

      return redirect()->back()->with('info', 'Your post has been added!');
    }
}
