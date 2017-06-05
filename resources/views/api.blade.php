@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="text-center">API</h2>
  <div class="row">
    <div class="col-md-offset-3 col-md-6">
      <h4>List of users</h4>
      <a href="{{route('api.users')}}">{{route('api.users')}}</a>
      <h4>List of topics</h4>
      <a href="{{route('api.topics')}}">{{route('api.topics')}}</a>
      <h4>Single topic (use unique "slug" of topic)</h4>
      {{route('api.topic', 'slugGoesHere')}}
    </div>
  </div>

</div>
@endsection
