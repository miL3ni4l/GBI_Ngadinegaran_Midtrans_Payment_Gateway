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

<div class="content-header">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-12 col-sm-12 col-12">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item active">
              <h4>Tambah Kategori Rutin</h4>
            </li>
          </ol>

          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/detail_kategori">Kategori Pemasukan</a></li>
            <li class="breadcrumb-item active">Tambah Kategori Rutin</li>
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
            <form method="POST" action="{{ route('store_rutin') }}" enctype="multipart/form-data">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('kode_kategori') ? ' has-error' : '' }}">

                <!-- <label for="kode_kategori" class="col-md-7 control-label">Kode Kategori <b style="color:Tomato;">*</b> </label> -->
                <div class="col-md-12">
                  <input id="kode_kategori" type="hidden" class="form-control" name="kode_kategori" value="{{ $kode }}" readonly="">
                  @if ($errors->has('kode_kategori'))
                  <span class="help-block">
                    <strong>{{ $errors->first('kode_kategori') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="container  col-md-12">
                <label>Kategori <b style="color:Tomato;">*</b></label>
                <select required="required" name="kategori_id" class="custom-select mb-3">
                <option value="">--Pilih Kategori--</option>
                  @php
$no = 1;
@endphp

                  @foreach($details as $d)
                  <option value="{{$d->id}}"> {{ $no++ }}. {{$d->kategori}}</option>
                  @endforeach
                </select>
              </div>


              @if(Auth::user()->level == 'bendahara')
              <div class="form-group{{ $errors->has('petugas_id') ? ' has-error' : '' }}">

                <!-- <label for="petugas_id" class="col-md-7 control-label">Nama Pengguna <b style="color:Tomato;">*</b> </label> -->
                <div class="col-md-12">
                  <input id="petugas_id" type="hidden" class="form-control" name="petugas_id" value="{{ $nama }}" readonly="">
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
                <select required="required" name="petugas_id" class="custom-select mb-3">
                <option value="">--Pilih Petugas--</option>
                  @php
$no = 1;
@endphp

                  @foreach($petugas as $p)
                  <option value="{{$p->id}}"> {{ $no++ }}. [{{$p->user->level}}]-{{$p->nama}}</option>
                  @endforeach
                </select>
              </div>
              @endif

              <div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
                <label for="kategori" class="col-md-2 control-label">Nama Kategori <b style="color:Tomato;">*</b> </label>
                <div class="col-md-12">
                  <input id="kategori" type="text" class="form-control" name="kategori" value="{{ old('kategori') }}" placeholder="Masukkan Nama Kategori . . ." required>


                  @if ($errors->has('kategori'))
                  <span class="help-block text-danger">
                    <strong>{{ $errors->first('kategori') }}</strong>
                  </span>
                  @endif

                </div>
              </div>


              <!-- <div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
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
                                              </div> -->


              <!-- <div  class="container  col-md-12">                               
                                                  <label>Jenis Kategori <b style="color:Tomato;">*</b></label>
                                                    <select   required="required" name="jenis" class="custom-select mb-3" >
                                                      <option value="Rutin">Rutin</option>
                                                    </select>
                                                </div>  -->

              <div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
                <div class="col-md-12">
                  <input id="jenis" type="hidden" class="form-control" name="jenis" value="Rutin" placeholder="Masukkan Nama Kategori . . ." required>


                  @if ($errors->has('jenis'))
                  <span class="help-block text-danger">
                    <strong>{{ $errors->first('jenis') }}</strong>
                  </span>
                  @endif

                </div>
              </div>


              <div class="form-group col-md-12 " style="width: 100%;margin-bottom:20px">
                <label>Keterangan <i>(kosongkan jika tidak ada)</i></label>
                <textarea class="form-control" name="keterangan" autocomplete="off" placeholder="Masukkan Keterangan (Opsional) . . ."></textarea>
              </div>



              <div class="form-group col-md-12">

                <button type="submit" class="btn btn-success col-md-4 float-right" id="submit">Submit </button>
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