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

            <h4>Tambah Kas</h4> 
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active"><a href="/kas">Kas</a></li>
              <li class="breadcrumb-item active">Tambah Kas</li>
            </ol>
          </div>

                  @if (Session::has('message'))
                    <div class="col-md-12 col-sm-12 col-12 timer: 1;">                     
                        <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                        </div>
                    </div>
                  @endif
          
     
          <div class=" table-responsive col-md-12 col-sm-6 col-12">
            <!--area ditambah-->   
            <!--area diisi-->         
                    <div class="card card-secondary">
                      <div class="card-body">
                        <form method="POST" action="{{ route('kas.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                                                                      <div class="form-group{{ $errors->has('kas') ? ' has-error' : '' }} col-md-12">
                                                                                    <label for="kas" class="col-md-2 control-label">Kas <b style="color:Tomato;">*</b> </label>
                                                                                    <div class="col-md-12">
                                                                                        <input id="kas" type="text" class="form-control" name="kas" placeholder="Masukkan Nama Kas . . ." value="{{ old('kas') }}" required>
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
                                                                                <img width="250" height="350" />
                                                                                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
                                                                            </div>
                                                                      </div> -->

                                                                      <div class="form-group col-md-12 ">
                                                                        <label for="email" class="col-md-12 control-label">Keterangan <i>(kosongkan jika tidak ada)</label>
                                                                          <div class="col-md-12">
                                                                            <textarea id="inputDescription"  name="keterangan" class="form-control col-md-12"  placeholder="Masukkan keterangan (Opsional) . . ." rows="3"></textarea>
                                                                          </div>
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


        </div>
      </div><!-- /.container-fluid -->
</section>

@endsection


