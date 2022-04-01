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
            <li class="breadcrumb-item active"> <h4>Edit Kategori Pengeluaran <b> {{ $data->kode_kategori }}-{{ $data->kategori }}</b></h4>  </li>
            </ol>
            
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="/detail_pengeluaran">Kategori Pengeluaran</a></li>
              <li class="breadcrumb-item active">Edit Kategori Pengeluaran {{ $data->kode_kategori }}-{{ $data->kategori }}</li>
              </ol>
            </div>
        </div> 

        <div class=" table-responsive col-md-12 col-sm-6 col-12">     
          <div class="card card-secondary">
            <div class="card-body">
            <form action="{{ route('kategori_pengeluaran.update', $data->id) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
        {{ method_field('put') }}
                                                

                                                
                                                <div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
                                                    <label for="kategori" class="col-md-4 control-label">Nama Kategori  <b style="color:Tomato;">*</b> </label>
                                                    <div class="col-md-12">
                                                        <input id="kategori" type="text" class="form-control" name="kategori" value="{{ $data->kategori }}" placeholder="Masukkan Nama Kategori . . ."  required>
                                                        @if ($errors->has('kategori'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('kategori') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
   
                                                <!-- <div class="form-group col-md-12" style="width: 100%;margin-bottom:20px">
                                                  <label>Keterangan <i>(kosongkan jika tidak ada)</i></label>
                                                  <textarea class="form-control py-0" name="keterangan"  autocomplete="off" placeholder="Masukkan Keterangan (Opsional) . . ." style="width: 100%">{{ $data->keterangan }}</textarea>
                                                </div> -->
      
                                                <div class="form-group col-md-12">
                                             
                                                    <button type="submit" class="btn btn-success col-md-4 float-right" id="submit" >Submit </button>     
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-danger col-md-2 float-left"> Reset </button>
                                         
                                              </div>
                                                
                                                                  
                                              </form>

            </div>  
          </div>
        </div> 
        


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>


    
@endsection

