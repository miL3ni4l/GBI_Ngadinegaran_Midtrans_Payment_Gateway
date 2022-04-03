@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop
@extends('layouts2.app')
 
@section('content')
<div class="row">
@if(Auth::user()->level == 'admin')
 			                  <div class=" col-lg-2">
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b><i class="fa fa-download"></i> Export PDF Anggota</b>
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a class="dropdown-item" href="{{url('laporan/agt/pdf')}}"> Semua  </a>
                            
                            <a class="dropdown-item" href="{{url('laporan/agt/pdf?sts_anggota=jemaat')}}"> Jemaat </a>
                            <a class="dropdown-item" href="{{url('laporan/agt/pdf?sts_anggota=simpatisan')}}"> Simpatisan </a>
                            <a class="dropdown-item" href="{{url('laporan/agt/pdf?sts_anggota=tamu')}}"> Tamu </a>
                          </div>
                        </div>
                       &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                       <div class=" col-lg-2">
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b><i class="fa fa-download"></i> Export PDF Gerwil</b>
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a class="dropdown-item" href="{{url('laporan/gwl/pdf')}}"> Semua  </a>
                            <a class="dropdown-item" href="{{url('laporan/gwl/pdf?gerwil=tengah')}}"> Tengah </a>
                            <a class="dropdown-item" href="{{url('laporan/gwl/pdf?gerwil=timur')}}"> Timur </a>
                            <a class="dropdown-item" href="{{url('laporan/gwl/pdf?gerwil=barat')}}"> Barat </a>
                            <a class="dropdown-item" href="{{url('laporan/gwl/pdf?gerwil=selatan')}}"> Selatan </a>
                            <a class="dropdown-item" href="{{url('laporan/gwl/pdf?gerwil=Utara')}}"> Utara </a>
                          </div>
                        </div>                       

<div class="col-lg-12">
 @if (Session::has('message'))
<div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
 @endif
</div>
</div>
<div class="row" style="margin-top: 20px;">

@else

<div class="col-md-12 d-flex align-items-stretch grid-margin">

<div class="row flex-grow">
 <div class="col-12">
  <div class="card">
   <div class="card-body">
   <h4 class="card-title col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">Filter Laporan Keuangan</h4>
   
                        <div class="form-group{{ $errors->has('tgl_pemasukan_rutin') ? ' has-error' : '' }}">
                            <label for="tgl_pemasukan_rutin" class="col-md-4 control-label">Dari Tanggal</label>
                            <div class="col-md-4">
                                <input id="tgl_pemasukan_rutin" type="date" class="form-control" name="tgl_pemasukan_rutin" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}">
                                @if ($errors->has('tgl_pemasukan_rutin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_pemasukan_rutin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('tgl_pemasukan_rutin') ? ' has-error' : '' }}">
                            <label for="tgl_pemasukan_rutin" class="col-md-4 control-label">Sampai Tanggal</label>
                            <div class="col-md-4">
                                <input id="tgl_pemasukan_rutin" type="date" class="form-control" name="tgl_pemasukan_rutin" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}">
                                @if ($errors->has('tgl_pemasukan_rutin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_pemasukan_rutin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Status</label>
                            <div class="col-md-4">
                            
                            <select class="form-control" name="status" required="">
                            
                                <option value="status">Pemasukan</option>
                                <option value="status">Pengeluaran</option>
                                
                            </select>
                            </div>
                        </div>
                               

                        <div class="form-group{{ $errors->has('kategori_id') ? ' has-error' : '' }}">
                            <label for="kategori_id" class="col-md-4 control-label">Kategori</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                <input id="kategori_judul" type="text" class="form-control" readonly="" required>
                                <input id="kategori_id" type="hidden" name="kategori_id" value="{{ old('kategori_id') }}" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
                                @if ($errors->has('kategori_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kategori_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary" id="submit">
                                    Tampilkan
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Export PDF
                        </button>
                        </div>
                        

   </div>
  </div>
 </div>
</div>


</div>


@endif            
</div>

@endsection