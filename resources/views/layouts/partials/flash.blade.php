<div class="row">
  <div class="col-md-6 col-md-offset-3">
    @if(session()->has('danger'))
    <div class="alert alert-danger">
      {!!session()->get('danger')!!}
    </div>
    @elseif(session()->has('info'))
    <div class="alert alert-info">
      {!!session()->get('info')!!}
    </div>
    @endif
  </div>
</div>
