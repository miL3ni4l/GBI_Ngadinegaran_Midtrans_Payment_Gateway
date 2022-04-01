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

  <div class="content-header">
      <div class="container-fluid">
        <div class="row">
        
        <div class="col-md-12 col-sm-12 col-12">
            <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item active"><h4>Tambah Kategori </h4> </li>
            </ol>
            
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="/detail_pengeluaran">Kategori Pengeluaran</a></li>
              <li class="breadcrumb-item active">Tambah Kategori Pengeluaran</li>
              </ol>
            </div>
        </div> 

        @if (Session::has('message'))
        <div class="col-md-12 col-sm-12 col-12">
        <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
        </div> 
        @endif

        <div class=" table-responsive col-md-12 col-sm-6 col-12">     
          <div class="card card-secondary">
            <div class="card-body">
            <form method="POST" action="{{ route('kategori_pengeluaran.store') }}" enctype="multipart/form-data">
              {{ csrf_field() }}


                                   
                                                <div class="form-group{{ $errors->has('kode_kategori') ? ' has-error' : '' }}">
                                                    
                                                    <label for="kode_kategori" class="col-md-7 control-label">Kode Kategori <b style="color:Tomato;">*</b> </label>
                                                    <div class="col-md-12">
                                                        <input id="kode_kategori" type="text" class="form-control" name="kode_kategori" value="{{ $kode }}" readonly="">
                                                        @if ($errors->has('kode_kategori'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('kode_kategori') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
                                                                <label for="kategori" class="col-md-2 control-label">Nama Kategori  <b style="color:Tomato;">*</b> </label>
                                                                <div class="col-md-12">
                                                                    <input id="kategori" type="text" class="form-control" name="kategori" value="{{ old('kategori') }}" placeholder="Masukkan Nama Kategori . . ." required>
                                                            
                                                                    
                                                                    @if ($errors->has('kategori'))
                                                                        <span class="help-block text-danger">
                                                                            <strong>{{ $errors->first('kategori') }}</strong>
                                                                        </span>
                                                                    @endif

                                                                </div>
                                                </div>

    

    <div class="form-group col-md-12">
     
      <button type="submit" class="btn btn-success col-md-2 float-right" id="submit" >
                          Submit
      </button>
      &nbsp;
      <button type="reset" class="btn btn-danger col-md-1 float-left">
                                    Reset
      </button>
      <a href="{{route('kategori.index')}}" class="btn btn-light pull-right col-md-1">Back</a>
    </div>
    
                      
  </form>
            </div>  
          </div>
        </div> 
        


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>


    
@endsection

