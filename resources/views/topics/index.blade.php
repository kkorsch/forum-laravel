@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-center">{{$topic->name}}</h2>
    </div>
  </div>

  <div class="row">
    <div class="col-md-offset-3 col-md-6">
      <form action="{{route('topic.index', $topic->slug)}}" method="post">
        <div class="form-group">
          <label for="body" class="control-label">
            <textarea class="form-control" name="body" rows="3" cols="70" value="{{old('body')}}" placeholder="Have anything to say? So do it! (becouse you're anononymous)"></textarea>
          </label>
        </div>
        <button type="submit" class="col-md-offset-5 btn btn-primary">Post!</button>
        {{csrf_field()}}
      </form>
    </div>
  </div>
  <hr>

  <div class="row">
    <div class="col-md-offset-3 col-md-6">
        @foreach($posts as $post)
          @include('topics.partials.comment')
        @endforeach
    </div>
  </div>

</div>
@endsection
