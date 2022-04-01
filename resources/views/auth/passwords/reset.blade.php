@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 10
    });

} );
</script>
@stop
@extends('layouts2.app')

@section('content')


<div class="row" style="margin-center: 20px;">


          

  <div class="col-lg-12 grid-margin stretch-card ">

    <div class="card  ">
      <div class="card-body">
      

      

        @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

  <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="align-items-center">

    
        <div class="col-lg-6 mx-auto">
          <form class="form-horizontal " method="POST" action="{{ route('password.update') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
              <label for="new-password" class="col-md-6 control-label">Password Sekarang</label>

              <div class="col-md-12">
                <input id="current-password" type="password" placeholder="********" class="form-control" name="current-password">

                @if ($errors->has('current-password'))
                <span class="help-block">
                  <strong>{{ $errors->first('current-password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
              <label for="new-password" class="col-md-4 control-label">Password Baru</label>

              <div class="col-md-12">
                <input id="new-password" type="password" placeholder="********" class="form-control" name="new-password">

                @if ($errors->has('new-password'))
                <span class="help-block">
                  <strong>{{ $errors->first('new-password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="new-password-confirm" class="col-md-6 control-label">Konfirmasi Password Baru</label>

              <div class="col-md-12">
                <input id="new-password-confirm" type="password" placeholder="********" class="form-control" name="new-password_confirmation">
              </div>
            </div>

            <div class="form-group  float-right ">
              <div class="col-md-12 ">
                <button type="submit" class="btn btn-primary  ">
                  Ganti Password
                </button>
              </div>
            </div>

          </form>
        </div>

      </div>
  </div>

      </div>

    </div>
    


  </div>
  <!-- #/ container -->
</div>

@endsection