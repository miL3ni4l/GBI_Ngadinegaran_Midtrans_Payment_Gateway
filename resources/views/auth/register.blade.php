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


<section class="content-header">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-6">
                <h4>Tambah Akun</h4> 
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active"><a href="/user">Akun</a></li>
                <li class="breadcrumb-item active">Tambah Akun</li>
                </ol>
            </div>

            <div class=" table-responsive col-md-12 col-sm-6 col-12">       
                <div class="card card-secondary">
                    <div class="card-body">
                        <!-- TABEL -->
                        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                    <!--area ditambah   -->
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Nama  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label for="username" class="col-md-4 control-label">Username  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                                            @if ($errors->has('username'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            

                                    <div class="form-group">
                                        <label for="email" class="col-md-4 control-label">Foto <i>(kosongkan jika tidak ada)</i></label>
                                        <div class="col-md-12">
                                            <img class="product" width="200" height="200" />
                                            <input type="file" class="uploads form-control" style="margin-top: 20px;" name="Foto">
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                        <label for="level" class="col-md-4 control-label">Level  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                        <select class="form-control" name="level" required="">
                                            <option value="">Pilih Level</option>
                                            <option value="admin">Admin</option>
                                            <option value="bendahara">Bendahara</option>
                                        </select>
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" onkeyup='check();' name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="confirm_password" type="password" onkeyup="check()" class="form-control" name="password_confirmation" required>
                                            <span id='message'></span>
                                        </div>
                                    </div>


                                       
                                        
                                    <div class="form-group col-md-12">
                                             
                                                    <button type="submit" class="btn btn-success col-md-4 float-right" id="submit" >Submit </button>     
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-danger col-md-2 float-left"> Reset </button>
                                         
                                    </div>
                                   
                                            
                        </form>
                    </div>
                </div>  
  
  
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection
