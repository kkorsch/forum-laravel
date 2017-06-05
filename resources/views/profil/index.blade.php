@extends('layouts.app')

@section('style')
<style>
    ul li {
        list-style-type: none;
    }

    ul {
        display: flex;
    }

    .diffrent {
        background-color: red;
    }
    .podswietl:hover{
      background-color: red;
    }
    .center{
      width: 50%;
      margin: 0 auto;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-2 col-md-offset-5">
          <img class="img-circle" src="{{$user->getAvatar(100)}}" alt="{{$user->username}} avatar">
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
          <h2 class="text-center">{{$user->username}}</h2>
          @if($user->isAdminOrModerator())
            <h3 class="text-center">({{$user->myRole}})</h3>
          @endif
            @if($user->rateRounded)
            <ul class="center">
              @for($i = 1; $i<=$user->rateRounded; $i++)
                <li><img src="{{asset('star.png')}}"></li>
                @endfor
            </ul>
            @else
            <p class="text-center">Not rated yet.</p>
            @endif
        </div>
    </div>

    <div class="row">
      <div class="col-md-offset-3 col-md-6">
        <hr>
        @if(Auth::check() && Auth::user()->id !== $user->id)
          @if(!Auth::user()->hasVotedOn($user))
          <h3 class="text-center">Do you know {{$user->username}}? Rate him!</h3>
          @else
          <h3 class="text-center">Changed your mind? Change your rate ;)</h3>
          @endif
        <ul class="center">
          @for($i = 1; $i<11; $i++)
            <li><a href="{{route('vote', [$user->username, $i])}}"><img src="{{asset('star.png')}}" value="$i" class="podswietl {{Auth::user()->howVoted($user) == $i ? 'diffrent' : ''}}"></a></li>
            @endfor
        </ul>
        @elseif(!Auth::check())
        <h3 class="text-center">Before rating user you have to log in!</p>
        @endif
      </div>
    </div>

</div>
@endsection
