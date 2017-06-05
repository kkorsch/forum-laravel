@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 ">
          <h1 class="text-center">The Ranking</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 ">

          <table class="table">
            <thead>
              <th>Rank</th>
              <th>Username</th>
              <th>Rate</th>
              <th>Votes</th>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{$loop->index + 1}}</td>
                  <td><a href="{{route('profile.index', $user->username)}}"><img class="img-circle" src="{{$user->getAvatar(20)}}" alt="{{$user->username}} avatar"> {{$user->username}}{{$user->isAdminOrModerator() ? '('.$user->myRole.')':''}}</a></td>
                  <td>{{$user->rate}}</td>
                  <td>{{$user->votes}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
    </div>

</div>
@endsection
