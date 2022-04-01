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
            <h4>Edit Kategori <b> {{ $data->kas }}</b></h4> 
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active"><a href="/kas">Kas</a></li>
              <li class="breadcrumb-item active">Edit Kas {{ $data->kas }}</li>
            </ol>
          </div>
          
          <div class=" table-responsive col-md-12 col-sm-6 col-12">
       
              <div class="card card-secondary">
                <div class="card-body">

                  <form action="{{ route('kas.update', $data->id) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                        {{ method_field('put') }}
                



                                        <div class="form-group{{ $errors->has('kas') ? ' has-error' : '' }} col-md-12">
                                            <label for="kas" class="col-md-4 control-label">Kas <b style="color:Tomato;">*</b> </label>
                                            <div class="col-md-12">
                                                <input id="kas" type="text" class="form-control" name="kas"  placeholder="Masukkan Nama Kas . . ."value="{{ $data->kas }}" required>
                                                @if ($errors->has('kas'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('kas') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- <div class="form-group col-md-12">
                                            <label for="cover" class="col-md-12 control-label">QR Code <i>(kosongkan jika tidak ada)</i> </label>
                                            <div class="col-md-12">
                                          
                                                <img width="188" height="188" @if($data->cover) src="{{ asset('images/Kas/'.$data->cover) }}" @endif />
                                                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
                                            </div>
                                        </div> -->


                                        <div class="form-group col-md-12 ">
                                                                <label for="email" class="col-md-12 control-label">Keterangan <i>(kosongkan jika tidak ada)</label>
                                                                  <div class="col-md-12">
                                                                    <textarea id="inputDescription"  name="keterangan" class="form-control col-md-12"  placeholder="Masukkan keterangan (Opsional) . . ." rows="3">{{ $data->keterangan }}</textarea>
                                                                  </div>
                                            </div>

                                                                      
                                                

                                                <div class="form-group col-md-12">
                                                  <div class="col-md-12">
                                                    <button type="submit" class="btn btn-success col-md-2 float-right" id="submit" > Submit </button>
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-danger col-md-4 float-left"> Reset </button>
                                                  </div>
                                                </div>
                    
                                      
                  </form>

                </div>
              </div>
                    
          </div>

        


        </div>
      </div>
    </section>

@endsection


