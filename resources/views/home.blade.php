@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 ">
          <h1 class="text-center">The Home Page</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <form action="{{route('home')}}" method="post">
          <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="New idea?">
          </div>
          <div class="form-group col-md-3 col-md-offset-4">
            <button type="submit" class="btn btn-primary">Add new topic</button>
            {{csrf_field()}}
          </div>
        </form>
      </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 ">
          <h3 class="text-center">Current topics</h3>
          @if($topics->count())
          <table class="table">
            <thead>
              <th>Topic</th>
              <th>Posts</th>
              <th>Added by</th>
              <th>Date</th>
              @if(Auth::user()->isAdminOrModerator())
                <th>Delete</th>
              @endif
            </thead>
            <tbody>
              @foreach($topics as $topic)
                <tr>
                  <td><a href="{{route('topic.index', $topic->slug)}}">{{$topic->name}}</a></td>
                  <td>{{$topic->postsCount}}</td>
                  <td><a href="{{route('profile.index', $topic->user->username)}}">{{$topic->user->username}}{{$topic->user->isAdminOrModerator() ? '('.$topic->user->myRole.')':''}}</a></td>
                  <td>{{$topic->created_at->format('H:i:s j.n.Y')}}</td>
                  @if(Auth::user()->isAdminOrModerator())
                  <td>
                    <form action="{{route('home.delete', $topic->slug)}}" method="post">
                      <button type="submit" class="btn btn-danger">Delete</button>
                      {{csrf_field()}}
                    </form>
                  </td>

                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <p class="text-center">No topics yet. Create one!</p>
          @endif
        </div>
    </div>

</div>
@endsection
