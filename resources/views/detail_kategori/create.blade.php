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
            <li class="breadcrumb-item active"><h4>Form Tambah Kategori </h4> </li>
            </ol>
            
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="/kategori">Kategori</a></li>
              <li class="breadcrumb-item active">Tambah Kategori</li>
              </ol>
            </div>
        </div> 

        <div class=" table-responsive col-md-12 col-sm-6 col-12">     
          <div class="card card-secondary">
            <div class="card-body">
            <form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
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

                                                <div class="container  col-md-12">                               
                                                <label>Detail Kategori <b style="color:Tomato;">*</b></label>
                                                    <select  required="required" name="detail_id" class="custom-select mb-3" >
                                                      <option value="">Pilih Detail Kategori</option>
                                                      @foreach($details as $d)
                                                          <option value="{{$d->id}}">{{$d->kategori}}</option>
                                                      @endforeach
                                                    </select>
                                                </div> 


                                                @if(Auth::user()->level == 'bendahara')
                                                <div class="form-group{{ $errors->has('petugas_id') ? ' has-error' : '' }}">
                                                    
                                                    <!-- <label for="petugas_id" class="col-md-7 control-label">Nama Pengguna <b style="color:Tomato;">*</b> </label> -->
                                                    <div class="col-md-12">
                                                        <input id="petugas_id" type="hidden" class="form-control" name="petugas_id"  value="{{ $nama }}" readonly="">
                                                        @if ($errors->has('petugas_id'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('petugas_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @else
                                                <div class="container  col-md-12">                               
                                                <label>Petugas <b style="color:Tomato;">*</b></label>
                                                    <select required="required" name="petugas_id" class="custom-select mb-3" >
                                                      <option value="">Pilih Petugas</option>
                                                      @foreach($petugas as $p)
                                                          <option value="{{$p->id}}">[{{$p->user->level}}]-{{$p->nama}}</option>
                                                      @endforeach
                                                    </select>
                                                </div> 
                                                @endif

                                   
                       

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

                                            
                                                 <div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
                                                          <label for="jenis" class="col-md-12 control-label" readonly="" >Jenis Kategori <b style="color:Tomato;">*</b>  </label>
                                                          <div class="col-md-12 ">
                                                            <label class="form-check-label">
                                                                <input type="radio" name="jenis" value="Rutin" required> 
                                                                Persembahan Rutin
                                                            </label>   &nbsp; &nbsp; 
                                                            <label class="form-check-label">
                                                            <input type="radio" name="jenis" value="Khusus" required>
                                                            Persembahan Khusus
                                                            </label>   &nbsp; &nbsp; 

                                                  
                                                          </div>                  
                                                </div>

                                                <div class="form-group col-md-12 " style="width: 100%;margin-bottom:20px">
                                                  <label>Keterangan <i>(kosongkan jika tidak ada)</i></label>
                                                  <textarea class="form-control" name="keterangan" autocomplete="off" placeholder="Masukkan Keterangan (Opsional) . . ."></textarea>
                                                </div>

    

                                                <div class="form-group col-md-12">
                                                  <div class="col-md-12">
                                                    <button type="submit" class="btn btn-success col-md-2 float-right" id="submit" >Submit </button>     
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-danger col-md-4 float-left"> Reset </button>
                                                  </div>
                                              </div>
    
                      
  </form>
            </div>  
          </div>
        </div> 
        


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>


    
@endsection

