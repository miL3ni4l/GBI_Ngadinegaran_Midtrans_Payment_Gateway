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
        <div class="col-md-12 col-sm-12 col-12">

          <div class="btn-group">
            @if(Auth::user()->level == 'admin')
            <a href="{{ route('kategori.create') }}" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Kategori</a>
            @else
            <a type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Kategori</a>
            @endif
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="{{ route('create_rutin') }}">Kategori Rutin</a>
              <a class="dropdown-item" href="{{ route('create_khusus') }}">Kategori Khusus</a>
            </div>
          </div>

          <div class="btn-group">
            <a type="button" class="btn btn-success"> <i class="fas fa-filter  text-center"></i></a>
            <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
              <a data-toggle="modal" data-target="#modal-filter" type="button">Kategori Rutin</a>
              <a data-toggle="modal" data-target="#modal-filter1" type="button">Kategori Khusus</a>
            </div>
          </div>

          <!-- <div class="btn-group">
                                        <button  data-toggle="modal" data-target="#modal-filter"  type="button" class="btn btn-success">
                                        <i class="fas fa-filter  text-center"></i>
                                        </button>
                                      </div>

                                      <div class="btn-group">
                                        <button  data-toggle="modal" data-target="#modal-filter1"  type="button" class="btn btn-success">
                                        <i class="fas fa-filter  text-center"></i>
                                        </button>
                                      </div> -->

          <div class="btn-group">
            <a href="{{route('detail_kategori.index')}}" type="button" class="btn btn-warning">
              <i class="fas fa-undo"></i>
            </a>
          </div>

          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Kategori Pemasukan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>

@if (Session::has('message'))
<section class="content-header">
  <div class="container-fluid">

    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!-- <a class="close" data-dismiss="alert" >x</a> -->
        <a class="close" data-dismiss="alert" class="btn btn-danger btn-sm"><i style="color:red" class="fas fa-times"></i></a>
      </button>
    </div>

  </div>
</section>
@endif


@if(Auth::user()->level == 'admin')
<!-- <div class="content-header">
                        <div class="container-fluid">
                          <div class="row">

                              <?php
                              $seluruh_pemasukan = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
                                ->where('status', '1')
                                ->first();

                              $total = $seluruh_pemasukan->total;
                              ?>

                              <div class="col-md-12">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                      <h3 class="card-title">
                                      <b>Kategori Pemasukan</b> 
                                      </h3>
                                    </div>

                                    <div class="card-tools"> 
                                      <div class="card-body ">

                                      <div class="row">
                                        @foreach($kategoris_pemasukan as $kp)
                                        &nbsp
                                          <div >
                                            <button class="btn btn-outline-info"><b>{{ $kp->kode_kategori }}</b> {{ $kp->kategori }}
                                                                            <a href="{{route('kategori.edit', $kp->id)}}" class="btn btn-secondary btn-sm text-center">
                                                                                  <i class="fas fa-edit  text-center"></i>
                                                                            </a>
                                                                            <a  data-toggle="modal" data-target="#hapus_kategori_{{ $kp->id }}" class="btn btn-danger btn-sm text-center">
                                                                                                                  <i class="fas fa-trash  text-center"></i>
                                                                            </a>  
                                            </button> &nbsp
                                          </div>
                          
                                        &nbsp
                                            <form action="{{ route('kategori.destroy', $kp->id)}}" method="post">
                                                                              <div class="modal fade" id="hapus_kategori_{{ $kp->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                  <div class="modal-content">
                                                                                      <div class="modal-header  bg-danger">
                                                                                        <h4 class="modal-title">Peringatan</h4>
                                                                                      </div>
                                                                                      <div class="modal-body">
                                                                                      {{ csrf_field() }}
                                                                                                      {{ method_field('delete') }}

                                                                                                      <p>Apakah anda yakin ingin menghapus data kategori <b>{{$kp->kategori}}</b> ?</p>
                                                                                      </div>
                                                                                      <div class="modal-footer justify-content-between">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close m-r-5"></i> Batal</button>
                                                                                        
                                                                                        <button type="submit" class="btn btn-danger toastrDefaultError"><i class="fa fa-trash m-r-5"></i> Hapus</button>
                                                                                        
                                                                                      </div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                            </form>
                                        @endforeach
                                      </div>
                                      </div>
                                    </div>
                                </div>
                              </div>

                          </div>
                         </div>       
                      </div> -->
@endif

@if(isset ($_GET['kategori']))
<section class="content-header">
  <div class="container-fluid">
    <div class="card">

      <div class="card-header pt-4">
        <h3 class="card-title">Filter Kategori Pemasukan</h3>
      </div>

            <!-- LOGO -->
      <div class="card-header pt-4">
        <div class="col-12">
          <h5>
            <img src="/adminlte/dist/img/credit/gbi.png" alt="Visa"> GBI Ngadinegaran Yogyakarta

            <a target="_BLANK" href="{{ route('detail_kategori_print',['kategori' => $_GET['kategori'], 'dari' => $_GET['dari'], 'sampai' => $_GET['sampai']]) }}" class="btn btn-default float-right bg-primary col-md-2 text-center"><i class="fa fa-print "></i> &nbsp; Print</a>

          </h5>
        </div>
      </div>

      <div class="card-body">
        <div class="invoice p-3 mb-3">
          <div class="row">


            <table class="col-12 float-right">
              <h4>
                <div class="col-12">
                  <div class="invoice-col">

                    <tr>
                      <th width="175">DARI TANGGAL</th>
                      <th width="2%" class="text-left">:</th>
                      <td class="text-left">{{ date('d-m-Y',strtotime($_GET['dari'])) }}</td>
                    </tr>

                    <tr>
                      <th width="175">SAMPAI TANGGAL</th>
                      <th width="2%" class="text-left">:</th>
                      <td class="text-left">{{ date('d-m-Y',strtotime($_GET['sampai'])) }}</td>
                    </tr>

                    <tr>
                      <th width="175">KATEGORI</th>
                      <th width="2%" class="text-left">:</th>
                      <td class="text-left">
                        @php
                        $id_kategori = $_GET['kategori'];
                        @endphp

                        @if($id_kategori == "")
                        @php
                        $kat = "SEMUA KATEGORI RUTIN";
                        @endphp
                        @else
                        @php
                        $katt = DB::table('detail_kategori')->where('id',$id_kategori)->first();
                        $kat = $katt->kategori
                        @endphp
                        @endif

                        {{$kat}}
                      </td>
                    </tr>

                  </div>
                </div>
              </h4>
            </table>

          </div>
        </div>
        <br>

        <div class="row">
          <div class="col-12 table-responsive">

            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="text-center">NO</th>
                  <th class="text-center">KODE</th>
                  <th class="text-center">TANGGAL</th>
                  <th class="text-center">DETAIL KATEGORI</th>
                  <th class="text-center">KETERANGAN</th>
                  <th class="text-center">PEMASUKAN</th>
                  <!-- <th class="text-center">PENGELUARAN</th> -->
                </tr>
              </thead>

              <tbody>
                @php
                $no = 1;
                $total_pemasukan = 0;
                $total_pengeluaran = 0;
                @endphp

                @foreach($persembahan as $t)

                <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td class="text-left">{{ $t->transaction_id }}</td>
                  <td class="text-center">{{ date('d-m-Y', strtotime($t->updated_at )) }}</td>
                  <td>{{ $t->detail_kategori->kategori }}</td>
                  @if($t->note == null)
                  <td class="text-center"> -</td>
                  @else
                  <td>{{ $t->note }}</td>
                  @endif
                  <td class="text-right">
                    {{ "Rp.".number_format($t->amount).",-" }}
                    @php $total_pemasukan += $t->amount; @endphp
                  </td>

                </tr>

                @endforeach

                @foreach($pemasukan_rutin as $t)
                @if($t->detail_kategori->jenis == 'Rutin')
                <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td class="text-left">{{ $t->kode_pemasukan_rutin }}</td>
                  <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                  <td>{{ $t->detail_kategori->kategori }}</td>

                  @if($t->keterangan == null)
                  <td class="text-center"> -</td>
                  @else
                  <td>{{ $t->keterangan }}</td>
                  @endif

                  <td class="text-right">
                    {{ "Rp.".number_format($t->nominal).",-" }}
                    @php $total_pemasukan += $t->nominal; @endphp
                  </td>

                </tr>
                @endif
                @endforeach

                @foreach($pemasukan_khusus as $t)
                @if($t->detail_kategori->jenis == 'Khusus')
                <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td class="text-left">{{ $t->kode_pemasukan_khusus }}</td>
                  <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                  <td>{{ $t->detail_kategori->kategori }}</td>

                  @if($t->keterangan == null)
                  <td class="text-center"> -</td>
                  @else
                  <td>{{ $t->keterangan }}</td>
                  @endif

                  <td class="text-right">
                    {{ "Rp.".number_format($t->nominal).",-" }}
                    @php $total_pemasukan += $t->nominal; @endphp
                  </td>

                </tr>
                @endif
                @endforeach

              </tbody>

              <tfoot class="bg-info text-white font-weight-bold">
                <tr>
                  <td colspan="5" class="text-bold text-left bg-secondary">TOTAL PEMASUKAN </td>
                  <td class="text-right bg-primary">{{ "Rp.".number_format($total_pemasukan).",-" }}</td>


                </tr>

              </tfoot>


            </table>

          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <p class="lead"><b>Pembayaran Via BANK BCA :</b></p>
            <img src="/adminlte/dist/img/credit/visa.png" alt="Visa">
            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
              Kas BCA GBI NGADINEGARAN
              </br>
              No Rekening :<b> 445 1096 448</b>
              </br>
              <b>a/n Marthinus Sumendi S.Th atau Sardjono</b>
            </p>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>
@endif

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">

          <?php
          $seluruh_pemasukan = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
            ->where('status', '1')
            ->first();

          $total = $seluruh_pemasukan->total;
          ?>

          @if(Auth::user()->level == 'admin')
          <div class="card card-outline card-success">
            <div class="card-header">
              <h3 class="card-title">
                <b>Data Kategori Pemasukan</b>
              </h3>
            </div>

            <div class="card-tools">
              <div class="card-body ">

                <div class="row">
                  @foreach($kategoris_pemasukan as $kp)
                  &nbsp
                  <div>
                    <button class="btn btn-outline-info"><b>{{ $kp->kode_kategori }}</b> {{ $kp->kategori }}
                      <a href="{{route('kategori.edit', $kp->id)}}" class="btn btn-secondary btn-sm text-center">
                        <i class="fas fa-edit  text-center"></i>
                      </a>
                      <a data-toggle="modal" data-target="#hapus_kategori_{{ $kp->id }}" class="btn btn-danger btn-sm text-center">
                        <i class="fas fa-trash  text-center"></i>
                      </a>
                    </button> &nbsp
                  </div>

                  &nbsp
                  <form action="{{ route('kategori.destroy', $kp->id)}}" method="post">
                    <div class="modal fade" id="hapus_kategori_{{ $kp->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header  bg-danger">
                            <h4 class="modal-title">Peringatan</h4>
                          </div>
                          <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}

                            <p>Apakah anda yakin ingin menghapus data kategori <b>{{$kp->kategori}}</b> ?</p>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close m-r-5"></i> Batal</button>

                            <button type="submit" class="btn btn-danger toastrDefaultError"><i class="fa fa-trash m-r-5"></i> Hapus</button>

                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          @endif

          <!-- <div class="card-header">
                                      <h3 class="card-title">Data Detail Kategori Pemasukan</h3>
                                    </div> -->

          <div class="card">
          </div>

          <div class=" table-responsive col-md-12 col-sm-6 col-12">
            <table class="table table-striped" id="example1">
              <thead>
                <tr>
                  <th width="1%">NO</th>
                  <th class="text-center">KODE</th>
                  <th class="text-center">KATEGORI</th>


                  <th class="text-center">DETAIL KATEGORI</th>

                  <th class="text-center">KETERANGAN</th>
                  @if(Auth::user()->level == 'admin')
                  <th class="text-center">PETUGAS</th>
                  @endif
                  <th class="text-center">UPDATE</th>
                  @if(Auth::user()->level == 'admin')
                  <th class="text-center col-md-2" width="10%">OPSI</th>
                  @endif
                </tr>
              </thead>

              <tbody>
                @php
                $no = 1;
                @endphp
                @foreach($datas as $k)
                <tr>
                  <td class="text-left">{{ $no++ }}</td>
                  <td class="text-left">{{ $k->nama_kategori->kode_kategori }}{{ $k->kode_kategori }}</td>
                  <td>{{ $k->nama_kategori->kategori }}</td>



                  <td>{{ $k->kategori }}</td>


                  @if($k->keterangan == null)
                  <td class="text-center">-</td>
                  @else
                  <td>{{ $k->keterangan }}</td>
                  @endif
                  @if(Auth::user()->level == 'admin')
                  <td>{{ $k->petugas->nama }}</td>
                  @endif
                  <td class="text-left">{{ $k->updated_at->diffForHumans() }}</td>



                  @if(Auth::user()->level == 'admin')
                  <td class="text-center col-md-1">
                    <a href="{{route('detail_kategori.edit', $k->id)}}" class="btn btn-secondary btn-sm col-md-2 text-center">
                      <i class="fas fa-edit  text-center"></i>
                    </a>
                    <a data-toggle="modal" data-target="#modalDelete_{{ $k->id }}" class="btn btn-danger btn-sm col-md-2 text-center">
                      <i class="fas fa-trash  text-center"></i>
                    </a>

                    <!-- Modal -->

                    <form action="{{ route('detail_kategori.destroy', $k->id)}}" method="post">
                      <div class="modal fade" id="modalDelete_{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header  bg-danger">
                              <h4 class="modal-title">Peringatan</h4>
                            </div>
                            <div class="modal-body">
                              {{ csrf_field() }}
                              {{ method_field('delete') }}

                              <p>Apakah anda yakin ingin menghapus data kategori <b>{{$k->kategori}}</b> ?</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close m-r-5"></i> Batal</button>

                              <button type="submit" class="btn btn-danger toastrDefaultError"><i class="fa fa-trash m-r-5"></i> Hapus</button>

                            </div>
                          </div>
                        </div>
                      </div>
                    </form>

                  </td>
                  @endif

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>


<!-- MODAL FILTER RUTIN -->
<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
    <div class="modal-content bg-gradient-white">

      <div class="modal-header">
        <h4 class="modal-title" id="modal-title-notification">Filter Kategori Rutin</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="GET" action="{{ route('rutin') }}">
          {{ csrf_field() }}
          <div class="box-body">

            <div class="form-group col-md-12">
              <div class="form-group">
                <label>Dari Tanggal</label>
                <input class="form-control datepicker2" placeholder="Dari Tanggal" type="date" required="required" name="dari" value="<?php if (isset($_GET['dari'])) {
                                                                                                                                        echo $_GET['dari'];
                                                                                                                                      } ?>">
              </div>
            </div>
            <div class="form-group col-md-12">
              <div class="form-group">
                <label>Sampai Tanggal</label>
                <input class="form-control datepicker2" placeholder="Sampai Tanggal" type="date" required="required" name="sampai" value="<?php if (isset($_GET['sampai'])) {
                                                                                                                                            echo $_GET['sampai'];
                                                                                                                                          } ?>">
              </div>
            </div>
            <div class="form-group col-md-12">
              <div class="form-group">
                <label>Cari Persembahan Rutin</label>
                <select class="form-control" name="kategori">
                  <!-- <option value="">-- SEMUA KATEGORI RUTIN--</option> -->
                  @php
                  $no = 1;
                  @endphp

                  @foreach($kategori_rutin as $k)
                  <option <?php
                          if (isset($_GET['kategori'])) {
                            if ($_GET['kategori'] == $k->id) {
                              echo "selected='selected'";
                            }
                          } ?> value="{{ $k->id }}"> {{ $no++ }}. {{ $k->kategori }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group col-md-12 ">
              <div class="form-group float-right">
                <input type="submit" class="btn btn-success" value="Tampilkan" style="margin-top: 25px col-md-5">
              </div>
            </div>

          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- MODAL FILTER -->
<div class="modal fade" id="modal-filter1" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
    <div class="modal-content bg-gradient-white">

      <div class="modal-header">
        <h4 class="modal-title" id="modal-title-notification">Filter Kategori Khusus</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="GET" action="{{ route('khusus') }}">
          {{ csrf_field() }}
          <div class="box-body">

            <div class="form-group col-md-12">
              <div class="form-group">
                <label>Dari Tanggal</label>
                <input class="form-control datepicker2" placeholder="Dari Tanggal" type="date" required="required" name="dari" value="<?php if (isset($_GET['dari'])) {
                                                                                                                                        echo $_GET['dari'];
                                                                                                                                      } ?>">
              </div>
            </div>
            <div class="form-group col-md-12">
              <div class="form-group">
                <label>Sampai Tanggal</label>
                <input class="form-control datepicker2" placeholder="Sampai Tanggal" type="date" required="required" name="sampai" value="<?php if (isset($_GET['sampai'])) {
                                                                                                                                            echo $_GET['sampai'];
                                                                                                                                          } ?>">
              </div>
            </div>
            <div class="form-group col-md-12">
              <div class="form-group">
                <label>Cari Persembahan Khusus</label>
                <select class="form-control" name="kategori">
                  <!-- <option value="">-- SEMUA KATEGORI KHUSUS--</option> -->
                  @php
                  $no = 1;
                  @endphp

                  @foreach($kategori_khusus as $k)
                  <option <?php
                          if (isset($_GET['kategori'])) {
                            if ($_GET['kategori'] == $k->id) {
                              echo "selected='selected'";
                            }
                          } ?> value="{{ $k->id }}"> {{ $no++ }}. {{ $k->kategori }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group col-md-12 ">
              <div class="form-group float-right">
                <input type="submit" class="btn btn-success" value="Tampilkan" style="margin-top: 25px col-md-5">
              </div>
            </div>

          </div>
        </form>
      </div>

    </div>
  </div>
</div>


@endsection


@section('scripts')

<script type="text/javascript">
  $(document).ready(function() {

    // btn refresh
    $('.btn-refresh').click(function(e) {
      e.preventDefault();
      $('.preloader').fadeIn();
      location.reload();
    })

    $('.btn-filter').click(function(e) {
      e.preventDefault();

      $('#modal-filter').modal();
      $('#modal-filter1').modal();
    })

  })
</script>

@endsection