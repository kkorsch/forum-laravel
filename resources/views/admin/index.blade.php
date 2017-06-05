@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <h1 class="text-center">Welcome {{Auth::user()->myRole}}!</h1>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-4">
        <h3>Make moderator</h3>
        <form action="{{route('admin.add.moderator')}}" method="post">
          <div class="form-group">
            <label for="user" class="form-label"> Username:
              <input type="text" name="user" class="form-control">
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Promote</button>
          {{csrf_field()}}
        </form>
        <hr>
        <h3>Delete moderator</h3>
        <form action="{{route('admin.delete.moderator')}}" method="post">
          <div class="form-group">
            <label for="user" class="form-label"> Username:
              <input type="text" name="user" class="form-control">
            </label>
          </div>
          <button type="submit" class="btn btn-danger">Fire</button>
          {{csrf_field()}}
        </form>
      </div>
      <div class="col-md-4">
        <h3>Delete users</h3>
        <form action="{{route('admin.ban.user')}}" method="post">
          <div class="form-group">
            <label for="user" class="form-label"> Username:
              <input type="text" name="user" class="form-control">
            </label>
          </div>
          <button type="submit" class="btn btn-danger">Ban user</button>
          {{csrf_field()}}
        </form>
      </div>
      @if(Auth::user()->isBigAdmin())
      <div class="col-md-4">
        <h3>Make admin</h3>
        <form action="{{route('admin.add.admin')}}" method="post">
          <div class="form-group">
            <label for="user" class="form-label"> Username:
              <input type="text" name="user" class="form-control">
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Promote</button>
          {{csrf_field()}}
        </form>
        <hr>
        <h3>Delete admin</h3>
        <form action="{{route('admin.delete.admin')}}" method="post">
          <div class="form-group">
            <label for="user" class="form-label"> Username:
              <input type="text" name="user" class="form-control">
            </label>
          </div>
          <button type="submit" class="btn btn-danger">Fire</button>
          {{csrf_field()}}
        </form>
      </div>
      @endif
    </div>
  </div>
@endsection
