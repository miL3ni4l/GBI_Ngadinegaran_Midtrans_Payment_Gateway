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

            <h4>Edit Komunitas <b> {{ $data->nama_komunitas }}</b></h4> 
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active"><a href="/komunitas">Ibadah</a></li>
              <li class="breadcrumb-item active">Edit Komunitas {{ $data->nama_komunitas }}</li>
            </ol>
          </div>
          
          <div class=" table-responsive col-md-12 col-sm-6 col-12">
            
          <div class="card card-secondary">
            <div class="card-body">

                <form action="{{ route('ibadah.update', $data->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                      {{ method_field('put') }}
                      
                                    

                                                              <div class="form-group{{ $errors->has('nama_komunitas') ? ' has-error' : '' }}">
                                                                        <label for="nama_komunitas" class="col-md-4 control-label">Nama Komunitas <b style="color:Tomato;">*</b> </label>
                                                                        <div class="col-md-12">
                                                                            <input id="nama_komunitas" type="text" class="form-control" name="nama_komunitas"  placeholder="Masukkan Nama Komunitas . . ."value="{{ $data->nama_komunitas }}" required>
                                                                            @if ($errors->has('nama_komunitas'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('nama_komunitas') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                              </div>

                                                              <div class="form-group col-md-12 ">
                                                                                  <label for="email" class="control-label">Deskripsi Komunitas <b style="color:Tomato;">*</b></label>
                                                                                   
                                                                                      <textarea id="inputDescription"  name="deskripsi" class="form-control col-md-12"  placeholder="Masukkan keterangan (Opsional) . . ." rows="3">{{ $data->deskripsi }}</textarea>
                                                                               
                                                              </div>

                                                              <div class="form-group{{ $errors->has('pj') ? ' has-error' : '' }}">
                                                                        <label for="pj" class="col-md-4 control-label">Penanggung Jawab <b style="color:Tomato;">*</b> </label>
                                                                        <div class="col-md-12">
                                                                            <input id="pj" type="text" class="form-control" name="pj"  placeholder="Masukkan Nama Komunitas . . ."value="{{ $data->pj }}" required>
                                                                            @if ($errors->has('pj'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('pj') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                              </div>

                                                              <div class="form-group{{ $errors->has('kontak') ? ' has-error' : '' }}">
                                                                        <label for="kontak" class="col-md-4 control-label">Kontak <b style="color:Tomato;">*</b> </label>
                                                                        <div class="col-md-12">
                                                                            <input id="kontak" type="number" class="form-control" name="kontak"  placeholder="Masukkan Nama Komunitas . . ."value="{{ $data->kontak }}" required>
                                                                            @if ($errors->has('kontak'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('kontak') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                              </div>

                                                              <div class="form-group col-md-12">
                                                                <label for="cover" class="col-md-12 control-label">Cover <i>(kosongkan jika tidak ada)</i> </label>
                                                                <div class="col-md-12">
                                                              
                                                                <img width="188" height="188" @if($data->cover) src="{{ asset('images/Komunitas/'.$data->cover) }}" @endif />
                                                                    <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
                                                                </div>
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


