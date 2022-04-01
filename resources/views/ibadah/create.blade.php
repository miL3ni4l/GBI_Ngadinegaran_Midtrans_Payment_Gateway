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
                        <h4>Tambah Ibadah</h4> 
                      </div>

                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="/home">Home</a></li>
                          <li class="breadcrumb-item active"><a href="/ibadah">Ibadah</a></li>
                          <li class="breadcrumb-item active">Tambah Ibadah</li>
                        </ol>
                      </div>

                      @if (Session::has('message'))
                        <div class="col-md-12 col-sm-12 col-12 timer: 1;">                     
                            <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                            </div>
                        </div>
                      @endif
              
                      <div class=" table-responsive col-md-12 col-sm-6 col-12">     
                          <div class="card card-secondary">
                              <div class="card-body">
                                      <form method="POST" action="{{ route('ibadah.store') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                              <div class="form-group{{ $errors->has('kode_ibadah') ? ' has-error' : '' }}">
                                                    
                                                    <label for="kode_ibadah" class="col-md-7 control-label">Kode Ibadah <b style="color:Tomato;">*</b> </label>
                                                    <div class="col-md-12">
                                                        <input id="kode_ibadah" type="text" class="form-control" name="kode_ibadah" value="{{ $kode }}" readonly="">
                                                        @if ($errors->has('kode_ibadah'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('kode_ibadah') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                              </div>
                                                                          
                                              <div class="form-group{{ $errors->has('ibadah') ? ' has-error' : '' }}">
                                                                <label for="ibadah" class="col-md-2 control-label">Nama Ibadah <b style="color:Tomato;">*</b> </label>
                                                                <div class="col-md-12">
                                                                    <input id="ibadah" type="text" class="form-control" name="ibadah" placeholder="Masukkan Nama Ibadah . . ." value="{{ old('ibadah') }}" required>
                                                                    @if ($errors->has('ibadah'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('ibadah') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                              </div>

                                              <div class="form-group col-md-12 ">
                                                <label for="email" class="control-label">Keterangan <i>(kosongkan jika tidak ada)</label>
                                                 
                                                    <textarea id="inputDescription"  name="keterangan" class="form-control col-md-12"  placeholder="Masukkan keterangan (Opsional) . . ." rows="3"></textarea>
                                 
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


