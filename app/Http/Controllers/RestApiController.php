<?php

namespace App\Http\Controllers;

use App\User;
use App\Topic;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Transformers\TopicTransformer;

class RestApiController extends Controller
{
    public function usersIndex() {
      $users = User::all();

      return fractal()->collection($users)->transformWith( new UserTransformer)->toArray();
    }

    public function topicsIndex() {
      $topics = Topic::all();

      return fractal()->collection($topics)->parseIncludes(['user'])->transformWith( new TopicTransformer)->toArray();
    }

    public function topicShow(Topic $topic) {
      return fractal()->item($topic)->parseIncludes(['user', 'posts.user'])->transformWith(new TopicTransformer)->toArray();
    }
}
