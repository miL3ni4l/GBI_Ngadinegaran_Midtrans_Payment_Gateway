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
                <h4>Tambah Pendeta</h4> 
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active"><a href="/pendeta">Pendeta</a></li>
                <li class="breadcrumb-item active">Tambah Pendeta</li>
                </ol>
            </div>
            <div class=" table-responsive col-md-12 col-sm-6 col-12">       
                <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
                <div class="align-items-center">

                
                    <div class="col-lg-6 mx-auto">
                    <form method="POST" action="{{ route('pendeta.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row">

    


                            <div class="col-6">
                                <div class="form-group{{ $errors->has('nama_pendeta') ? ' has-error' : '' }}">
                                        <label for="nama_pendeta" class="col-md-12 control-label">Nama Pendeta  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="nama_pendeta" type="text" class="form-control" name="nama_pendeta" value="{{ old('nama_pendeta') }}" placeholder="Masukkan Nama Pendeta . . ."required>
                                            @if ($errors->has('nama_pendeta'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('nama_pendeta') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
                                        <label for="alias" class="col-md-12 control-label">Alias  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="alias" type="text" class="form-control" name="alias" value="{{ old('alias') }}" placeholder="Masukkan Nama Pendeta . . ."required>
                                            @if ($errors->has('alias'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('alias') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
                                        <label for="tempat_lahir" class="col-md-12 control-label">Tempat Lahir  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukkan Nama Pendeta . . ."required>
                                            @if ($errors->has('tempat_lahir'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>


                            
                           
                            <div class="col-6">
                                <div class="form-group{{ $errors->has('tgl_lahir') ? ' has-error' : '' }}">
                                        <label for="tgl_lahir" class="col-md-12 control-label">Tanggal Lahir  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="tgl_lahir" type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir') }}" placeholder="Masukkan Nama Pendeta . . ."required>
                                            @if ($errors->has('tgl_lahir'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tgl_lahir') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>


                            
                            <div class="col-6">
                                <div class="form-group{{ $errors->has('tlp_pendeta') ? ' has-error' : '' }}">
                                        <label for="tlp_pendeta" class="col-md-12 control-label">Telp  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="tlp_pendeta" type="number" class="form-control" name="tlp_pendeta" value="{{ old('tlp_pendeta') }}" placeholder="Masukkan Nama Pendeta . . ."required>
                                            @if ($errors->has('tlp_pendeta'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tlp_pendeta') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group{{ $errors->has('istri') ? ' has-error' : '' }}">
                                        <label for="istri" class="col-md-12 control-label">Istri  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="istri" type="text" class="form-control" name="istri" value="{{ old('istri') }}" placeholder="Masukkan Nama Pendeta . . ."required>
                                            @if ($errors->has('istri'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('istri') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group{{ $errors->has('pendidikan') ? ' has-error' : '' }}">
                                        <label for="pendidikan" class="col-md-12 control-label">Pendidikan  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="pendidikan" type="text" class="form-control" name="pendidikan" value="{{ old('pendidikan') }}" placeholder="Masukkan Nama Pendeta . . ."required>
                                            @if ($errors->has('pendidikan'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('pendidikan') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group{{ $errors->has('karir') ? ' has-error' : '' }}">
                                        <label for="karir" class="col-md-12 control-label">Karir  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="karir" type="text" class="form-control" name="karir" value="{{ old('karir') }}" placeholder="Masukkan Nama Pendeta . . ."required>
                                            @if ($errors->has('karir'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('karir') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group{{ $errors->has('biografi') ? ' has-error' : '' }}">
                                        <label for="biografi" class="col-md-12 control-label">Biografi  <b style="color:Tomato;">*</b> </label>
                                        <div class="col-md-12">
                                            <input id="biografi" type="text" class="form-control" name="biografi" value="{{ old('biografi') }}" placeholder="Masukkan Nama Pendeta . . ."required>
                                            @if ($errors->has('biografi'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('biografi') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                                        <label for="email" class="col-md-12 control-label">Foto <i>(kosongkan jika tidak ada)</i> </label>
                                                        
                                                        <div class="col-md-12">
                                                            <img width="236" height="236" />
                                                            <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
                                                        </div>
                                              </div>


                            <div class="form-group col-md-12">
                                                  <div class="col-md-12">
                                                    <button type="submit" class="btn btn-success col-md-4 float-right" id="submit" >Submit </button>     
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-danger col-md-2 float-left"> Reset </button>
                                                  </div>
                            </div>
                            
        
                            
                            </div>
                        </div>
                    </form>
                    </div>

                </div>
                </div>
            </div>           
        </div>
    </div>
</section>

@endsection


