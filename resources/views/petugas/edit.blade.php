@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 10
    });

  });
</script>
@stop
@extends('layouts2.app')

@section('content')


<section class="content-header">
  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-6">

        <h4>Edit Petugas <b>{{ $data->kode_petugas }} </b>
          @if($data->user->level == 'admin')
          <span class="badge bg-success"> Admin</span>
          @else
          <span class="badge bg-warning"> Bendahara</span>

          @endif
        </h4>
      </div>

      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active"><a href="/petugas">Petugas</a></li>
          <li class="breadcrumb-item active">Edit Petugas {{ $data->nama }}</li>
        </ol>
      </div>

      <div class=" table-responsive col-md-12 col-sm-6 col-12">
        <div class="card card-secondary">
          <div class="card-body">
            <form action="{{ route('petugas.update', $data->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('put') }}


              <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                <label for="nama" class="col-md-4 control-label">Nama Petugas <b style="color:Tomato;">*</b></label>
                <div class="col-md-12">
                  <input id="nama" type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
                  @if ($errors->has('nama'))
                  <span class="help-block">
                    <strong>{{ $errors->first('nama') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group ">
                <label for="email" class="col-md-12 control-label">Alamat <b style="color:Tomato;">*</b></label>
                <div class="col-md-12">
                  <textarea id="inputDescription" name="alamat" class="form-control col-md-12" placeholder="Masukkan alamat (Opsional) . . ." rows="3">{{ $data->alamat }}</textarea>
                </div>
              </div>

              <div class="form-group col-md-12" style="width: 100%;margin-bottom:20px">
                <label>No Telp <b style="color:Tomato;">*</b></label>
                <input type="number" class="form-control py-0" name="no_telp" value="{{ $data->no_telp }}" placeholder="Masukkan No Telp . . ." style="width: 100%">
              </div>

              <div class="form-group col-md-12">

                <button type="submit" class="btn btn-success col-md-4 float-right" id="submit"> Submit </button>
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