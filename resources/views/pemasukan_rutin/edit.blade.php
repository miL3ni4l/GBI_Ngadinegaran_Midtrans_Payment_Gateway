@section('js')

<script type="text/javascript">
  $(document).on('click', '.pilih', function(e) {
    document.getElementById("acara_judul").value = $(this).attr('data-acara_judul');
    document.getElementById("acara_id").value = $(this).attr('data-acara_id');
    $('#myModal').modal('hide');
  });

  $(document).on('click', '.pilih_kas', function(e) {
    document.getElementById("kas_id").value = $(this).attr('data-kas_id');
    document.getElementById("kas_nama").value = $(this).attr('data-kas_nama');
    $('#myModal2').modal('hide');
  });

  $(function() {
    $("#lookup, #lookup2").dataTable();
  });
</script>

@stop

@section('css')

@stop

@extends('layouts2.app')

@section('content')
<form action="{{ route('pemasukan_rutin.update', $pemasukan_rutin->id) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('put') }}
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">




        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h4>Edit Pemasukan Rutin <b> {{ $pemasukan_rutin->kode_pemasukan_rutin }}</b> </h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active"><a href="/pemasukan_rutin">Pemasukan Rutin</a></li>
                <li class="breadcrumb-item active">Edit Pemasukan Rutin {{ $pemasukan_rutin->kode_pemasukan_rutin }}</li>
              </ol>
            </div>
          </div>
        </div>


        <div class=" table-responsive col-md-6 col-sm-12 col-12">

          <!--area ditambah-->
          <!--area diisi-->
          <div class="card card-secondary">
            <div class="card-body">

              <!--area ditambah   -->




              <div class="form-group{{ $errors->has('kode_pemasukan_rutin') ? ' has-error' : '' }}">

                <!-- <label for="kode_pemasukan_rutin" class="col-md-7 control-label">Kode Trasaksi <b style="color:Tomato;">*</b> </label> -->
                <div class="col-md-12">
                  <input id="kode_pemasukan_rutin" type="hidden" class="form-control" name="kode_pemasukan_rutin" value="{{ $pemasukan_rutin->kode_pemasukan_rutin }}" readonly="">
                  @if ($errors->has('kode_pemasukan_rutin'))
                  <span class="help-block">
                    <strong>{{ $errors->first('kode_pemasukan_rutin') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

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



              <div class="form-group col-md-12" style="width: 100%;margin-bottom:20px">
                <label>Tanggal <b style="color:Tomato;">*</b></label>
                <input type="date" class="form-control datepicker2 py-0" required="required" name="tanggal" value="{{ $pemasukan_rutin->tanggal }}" style="width: 100%">
              </div>


              <div class="form-group col-md-12" style="width: 100%;margin-bottom:20px">
                <label>Jenis Ibadah <b style="color:Tomato;">*</b></label>
                <select class="form-control py-0" required="required" name="ibadah" style="width: 100%">
                  @php
                  $no = 1;
                  @endphp


                  @foreach($ibadah as $i)
                  <option {{ ($pemasukan_rutin->nama_ibadah->id == $i->id ? "selected='selected'" : "") }} value="{{ $i->id }}">{{ $no++ }}. {{ $i->ibadah }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-12" style="width: 100%;margin-bottom:20px">
                <label>Kategori <b style="color:Tomato;">*</b></label>
                <select class="form-control py-0" required="required" name="kategori" style="width: 100%">
                  @php
                  $no = 1;
                  @endphp

                  @foreach($kategori as $k)
                  <option {{ ($pemasukan_rutin->detail_kategori->id == $k->id ? "selected='selected'" : "") }} value="{{ $k->id }}">{{ $no++ }}. {{ $k->kategori }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-12" style="width: 100%;margin-bottom:20px">
                <label>Kas <b style="color:Tomato;">*</b></label>
                <select class="form-control py-0" required="required" name="kas" style="width: 100%">
                  @php
                  $no = 1;
                  @endphp

                  @foreach($kas as $k)
                  <option {{ ($pemasukan_rutin->kas->id == $k->id ? "selected='selected'" : "") }} value="{{ $k->id }}">{{ $no++ }}. {{ $k->kas }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-12" style="width: 100%;margin-bottom:20px">
                <label>Nominal <b style="color:Tomato;">*</b></label>
                <input type="number" class="form-control py-0" required="required" name="nominal" value="{{ $pemasukan_rutin->nominal }}" style="width: 100%">
              </div>





            </div>
          </div>


        </div>

        <div class=" table-responsive col-md-6 col-sm-12 col-12">

          <!--area ditambah-->
          <!--area diisi-->
          <div class="card card-secondary">
            <div class="card-body">

              <!--area ditambah   -->




              <div class="form-group col-md-12">
                <label for="cover" class="col-md-12 control-label">Bukti Pemasukan Rutin <i>(kosongkan jika tidak ada)</i> </label>
                <div class="col-md-12">

                  <img width="186" height="186" @if($pemasukan_rutin->cover) src="{{ asset('images/pemasukan_rutin/'.$pemasukan_rutin->cover) }}" @endif />
                  <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
                </div>
              </div>

              <div class="form-group col-md-12 ">
                <label for="email" class="col-md-12 control-label">Keterangan <i>(kosongkan jika tidak ada)</label>
                <div class="col-md-12">
                  <textarea id="inputDescription" name="keterangan" class="form-control col-md-12" placeholder="Masukkan keterangan (Opsional) . . ." rows="3">{{ $pemasukan_rutin->keterangan }}</textarea>
                </div>
              </div>

              <div class="form-group col-md-12">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-success col-md-2 float-right" id="submit"> Submit </button>
                  &nbsp;
                  <button type="reset" class="btn btn-danger col-md-4 float-left"> Reset </button>
                </div>
              </div>


            </div>
          </div>


        </div>


      </div>
    </div><!-- /.container-fluid -->
  </section>
</form>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Donatur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="lookup" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th width="1%">NO</th>
              <th class="text-center">METODE PEMBAYARAM</th>
              <th class="text-center">UPDATE</th>

            </tr>
          </thead>
          <tbody>
            @php
            $no = 1;
            @endphp
            @foreach($kas as $k)
            <tr>
              <td class="text-left">{{ $no++ }}</td>
              <td>{{ $k->kas }}</td>
              <td class="text-left">{{ $k->updated_at }}</td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection