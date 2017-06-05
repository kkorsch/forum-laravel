  <div class="media">
    <div class="media-left">
      <img class="media-object img-circle" src="{{$post->user->getAvatar(50)}}" alt="{{$post->user->username}} avatar">
    </div>
    <div class="media-body">
      <div class="user">
        <a href="{{route('profile.index',$post->user->username )}}"><strong>{{$post->user->username}}</strong></a> - <strong>{{$post->user->rate}}</strong> <img src="{{asset('star.png')}}" alt="star"> - {{$post->created_at->diffForHumans()}}
      </div>
      <p>{{ $post->body }}</p>
    </div>
  </div>
