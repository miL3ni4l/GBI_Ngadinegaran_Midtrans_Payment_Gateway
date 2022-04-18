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

            <h4>Edit Ibadah <b> {{ $data->ibadah }}</b></h4> 
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active"><a href="/ibadah">Ibadah</a></li>
              <li class="breadcrumb-item active">Edit Ibadah {{ $data->ibadah }}</li>
            </ol>
          </div>
          
          <div class=" table-responsive col-md-12 col-sm-6 col-12">
            
          <div class="card card-secondary">
            <div class="card-body">

                <form action="{{ route('ibadah.update', $data->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                      {{ method_field('put') }}
                      
                                                              <div class="form-group{{ $errors->has('nama_pengguna') ? ' has-error' : '' }}">
                                                                  
                                                                  <!-- <label for="nama_pengguna" class="col-md-7 control-label">Nama Pengguna <b style="color:Tomato;">*</b> </label> -->
                                                                  <div class="col-md-12">
                                                                      <input id="nama_pengguna" type="hidden" class="form-control" name="nama_pengguna" value="{{ $nama }}" readonly="">
                                                                      @if ($errors->has('nama_pengguna'))
                                                                          <span class="help-block">
                                                                              <strong>{{ $errors->first('nama_pengguna') }}</strong>
                                                                          </span>
                                                                      @endif
                                                                  </div>
                                                              </div>

                                                              <div class="form-group{{ $errors->has('ibadah') ? ' has-error' : '' }}">
                                                                        <label for="ibadah" class="col-md-4 control-label">Nama Ibadah <b style="color:Tomato;">*</b> </label>
                                                                        <div class="col-md-12">
                                                                            <input id="ibadah" type="text" class="form-control" name="ibadah"  placeholder="Masukkan Nama Ibadah . . ."value="{{ $data->ibadah }}" required>
                                                                            @if ($errors->has('ibadah'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('ibadah') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                              </div>

                                                              <div class="form-group{{ $errors->has('jam') ? ' has-error' : '' }}">
                                                                        <label for="jam" class="col-md-4 control-label">Jam Ibadah <b style="color:Tomato;">*</b> </label>
                                                                        <div class="col-md-12">
                                                                            <input id="jam" type="time" class="form-control" name="jam"  placeholder="Masukkan Nama jam . . ."value="{{ $data->jam }}" required>
                                                                            @if ($errors->has('jam'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('jam') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                              </div>

                                                              <div class="form-group col-md-12 ">
                                                                                  <label for="email" class="control-label">Keterangan <i>(kosongkan jika tidak ada)</label>
                                                                                   
                                                                                      <textarea id="inputDescription"  name="keterangan" class="form-control col-md-12"  placeholder="Masukkan keterangan (Opsional) . . ." rows="3">{{ $data->keterangan }}</textarea>
                                                                               
                                                              </div>

                                                              <div class="form-group col-md-12">
                                                               
                                                                  <button type="submit" class="btn btn-success col-md-4 float-right" id="submit" > Submit </button>
                                                                  &nbsp;
                                                                  <button type="reset" class="btn btn-danger col-md-2 float-left"> Reset </button>
                                                           
                                                              </div>
                  
                                    
                </form>

            </div>
          </div>
                          
            
        </div>
      </div>
</section>

@endsection


