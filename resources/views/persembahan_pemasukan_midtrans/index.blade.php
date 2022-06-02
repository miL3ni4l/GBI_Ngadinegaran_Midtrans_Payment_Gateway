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

          <div class="btn-group">
            <a href="/persembahan_pemasukan_midtrans" type="button" class="btn btn-warning">
              <i class="fas fa-undo"></i>
            </a>
          </div>
          <div class="btn-group">
            <button data-toggle="modal" data-target="#modal-filter" type="button" class="btn btn-success">
              <i class="fas fa-filter  text-center"></i>
            </button>
          </div>

          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Pemasukan</li>

          </ol>
        </div>
      </div>

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

@if(isset ($_GET['kategori']))
<section class="content-header">
  <div class="container-fluid">
    <div class="card">

      <div class="card-header pt-4">
        <h3 class="card-title">Filter Midtrans Payment</h3>
      </div>

      <div class="card-body">
        <div class="invoice p-3 mb-3">
          <div class="row">

            <div class="col-12">
              <h4>
                <img src="/adminlte/dist/img/credit/gbi.png" alt="Visa">
                &nbsp; GBI Ngadinegaran Yogyakarta
              </h4>
            </div>

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
                        $kat = "SEMUA KATEGORI";
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
                  <th class="text-center">NAMA</th>
                  <th class="text-center">JENIS</th>
                  <th class="text-center">NOMINAL</th>
                </tr>
              </thead>

              <tbody>
                @php
                $no = 1;
                $total_pemasukan = 0;
                @endphp

                @foreach($persembahan as $t)

                <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td class="text-left">{{ $t->transaction_id }}</td>
                  <td class="text-center">{{ date('d-m-Y', strtotime($t->updated_at )) }}</td>
                  <td class="text-left">{{ $t->donor_name }}</td>
                  <td>{{ $t->detail_kategori->kategori }}</td>
                  <td class="text-right">
                    {{ "Rp.".number_format($t->amount).",-" }}
                    @php $total_pemasukan += $t->amount; @endphp
                  </td>

                </tr>

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

<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Grafik Midtrans Payment Per Bulan</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">

              <div class="col-md-6 col-sm-6 col-12 ">
                <div class="card col-12">
                  <p class="text-center">
                    <strong>Grafik <b>{{date('Y')}} </b></strong>
                  </p>
                  <div class="chart">
                    <canvas id="grafik1"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-12 ">
                <div class="card col-12">
                  <p class="text-center">
                    <strong>Grafik <b>Per Kategori</b> Bulan {{date('M,Y')}}</strong>
                  </p>

                  <div class="chart">
                    <canvas id="grafik2"></canvas>
                  </div>
                </div>
              </div>

              <!-- /.col -->
              <!-- <div class="col-md-4">
                          <p class="text-center">
                            <strong>Goal Completion</strong>
                          </p>
                          <div class="progress-group">
                            Add Products to Cart
                            <span class="float-right"><b>160</b>/200</span>
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-primary" style="width: 80%"></div>
                            </div>
                          </div>
                          <div class="progress-group">
                            Complete Purchase
                            <span class="float-right"><b>310</b>/400</span>
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-danger" style="width: 75%"></div>
                            </div>
                          </div>
                          <div class="progress-group">
                            <span class="progress-text">Visit Premium Page</span>
                            <span class="float-right"><b>480</b>/800</span>
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-success" style="width: 60%"></div>
                            </div>
                          </div>
                          <div class="progress-group">
                            Send Inquiries
                            <span class="float-right"><b>250</b>/500</span>
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-warning" style="width: 50%"></div>
                            </div>
                          </div>
                        </div> -->

            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <h5 class="description-percentage text-success">{{$persembahan->where('status', 'success')->count()}}</h5>
                  <span>Success</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <h5 class="description-percentage text-warning">{{$persembahan->where('status', 'pending')->count()}}</h5>
                  <span>Pending</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <h5 class="description-percentage text-danger">{{$persembahan->where('status', 'failed')->count()}}</h5>
                  <span>Failed</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block">
                  <h5 class="description-percentage text-dark">{{$persembahan->where('status', 'expired')->count()}}</h5>
                  <span>Expired</span>
                </div>
                <!-- /.description-block -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
  </div>
</div>

<!-- <div class="content-header">
                          <div class="container-fluid">
                            <div class="row">

                            <div class="col-md-6 col-sm-6 col-12 ">
          
                                <div class="card col-12"  >
                                          <div class="card-header border-0">
                                            <div class="d-flex justify-content-between">
                                            <h5  class="position-center ">Grafik <b>Per Bulan</b> Tahun {{date('Y')}} </h5>
                                            </div>
                                          </div>

                                          <div class="position-relative ">
                                            <canvas id="grafik1"></canvas>
                                          </div>
                                    
                                </div>                     
                              </div>

                              <div class="col-md-6 col-sm-6 col-12 ">
          
                                <div class="card col-12"  >
                                          <div class="card-header border-0">
                                            <div class="d-flex justify-content-between">
                                            <h5  class="position-center ">Grafik <b>Per Bulan</b> Tahun {{date('Y')}} </h5>
                                            </div>
                                          </div>

                                          <div class="position-relative ">
                                            <canvas id="grafik2"></canvas>
                                          </div>
                                    
                                </div>                     
                              </div>

                            </div>
                          </div>       
    </div> -->

<!-- <div class="content-header">
                          <div class="container-fluid">
                            <div class="row">

                                <div class="col-12 col-sm-6 col-md-6">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-caret-up"></i></span>

                                    <div class="info-box-content">
                                      <h6 class="info-box-text">Total Volume </h6>
                                        <i>Month to Date</i>
                                      <span class="info-box-number">

                                        <h5>{{ "Rp. ".number_format($total_pemasukan_bulan_ini)." ,-" }}</h5>
                                      
                                      </span>
                                    </div>
  
                                  </div>

                                </div>

                                <div class="col-12 col-sm-6 col-md-6">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                                    <div class="info-box-content">
                                      <h6 class="info-box-text">Total Transaction </h6>
                                        <i>Month to Date</i>
                                      <span class="info-box-number">

                                        <h5>{{$persembahan->where('status', 'success')->count()}}</h5>
                                      
                                      </span>
                                    </div>
  
                                  </div>

                                </div>
                              

                            </div>
                          </div>       
    </div> -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Pemasukan</h3>
          </div>
          <div class="card">
          </div>

          <div class=" table-responsive col-md-12 col-sm-12 col-12">
            <table id="example1" class="table table-striped">
              <thead>
                <tr>
                  <th width="1%">NO</th>
                  <th class="text-center">KODE</th>
                  <th class="text-center">TANGGAL</th>
                  <th class="text-center">NAMA</th>
                  <th class="text-center">EMAIL</th>
                  <th class="text-center">JENIS</th>
                  <th class="text-center">NOMINAL</th>
                  <th class="text-center">STATUS</th>
                  <th class="text-center">UPDATE</th>

                </tr>
              </thead>
              <tbody>
                @php
                $no = 1;
                @endphp
                @foreach($persembahan as $k)
                <tr>
                  <td class="text-left">{{ $no++ }}</td>
                  <td>{{ $k->transaction_id }}</td>
                  <td>{{ $k->updated_at->format('d-M-Y') }}</td>
                  <td>{{ $k->donor_name }}</td>
                  <td>{{ $k->donor_email }}</td>
                  <td>{{ $k->detail_kategori->kategori }}</td>
                  <td class="text-right">{{ "Rp.".number_format($k->amount).",-" }}</td>
                  <td class="text-center">

                    @if($k->status == 'success')
                    <span class="badge bg-success col-md-8">{{ $k->status }}</span>
                    @elseif($k->status == 'failed')
                    <span class="badge bg-danger col-md-8">{{ $k->status }}</span>
                    @elseif($k->status == 'pending')
                    <span class="badge bg-warning col-md-8">{{ $k->status }}</span>
                    @else($k->status == 'expired')
                    <span class="badge bg-dark col-md-8">{{ $k->status }}</span>
                    @endif
                  </td>
                  <td class="text-center">{{ $k->updated_at->diffForHumans() }}</td>
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

<!-- MODAL FILTER -->
<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
    <div class="modal-content bg-gradient-white">

      <div class="modal-header">
        <h4 class="modal-title" id="modal-title-notification">Filter Midtrans Payment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">

        <form method="GET" action="{{ route('filter_persembahan') }}">
          <div class="form-group col-md-12">
            <div class="form-group">
              <label>Dari Tanggal</label>
              <input class="form-control datepicker2" value="{{ date('Y-m-d') }}" placeholder="Dari Tanggal" type="date" required="required" name="dari" value="<?php if (isset($_GET['dari'])) {
                                                                                                                                                                  echo $_GET['dari'];
                                                                                                                                                                } ?>">
            </div>
          </div>

          <div class="form-group col-md-12">
            <div class="form-group">
              <label>Sampai Tanggal</label>
              <input class="form-control datepicker2" value="{{ date('Y-m-d') }}" placeholder="Sampai Tanggal" type="date" required="required" name="sampai" value="<?php if (isset($_GET['sampai'])) {
                                                                                                                                                                      echo $_GET['sampai'];
                                                                                                                                                                    } ?>">
            </div>
          </div>

          <div class="form-group col-md-12">
            <div class="form-group">
              <label>Cari Kategori</label>
              <select class="form-control" name="kategori">
                <option value="">-- SEMUA KATEGORI --</option>
                @php
                $no = 1;
                @endphp
                @foreach($kategori as $k)
                
                <option <?php
                        if (isset($_GET['kategori'])) {
                          if ($_GET['kategori'] == $k->id) {
                            echo "selected='selected'";
                          }
                        } ?> value="{{ $k->id }}">{{ $no++ }}. {{ $k->kategori }}
                </option>
                @endforeach
              </select>
            </div>
          </div>


          <div class="form-group col-md-12 ">
            <div class="form-group float-right">
              <input type="submit" class="btn btn-success" value="Tampilkan" style="margin-top: 25px col-md-6">
            </div>
          </div>


        </form>

      </div>



    </div>
  </div>
</div>





<script>
  var randomScalingFactor = function() {
    return Math.round(Math.random() * 500)
  };

  var barChartData = {
    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
    datasets: [{
        label: 'Pemasukan',
        fillColor: "rgb(52, 152, 219)",
        strokeColor: "rgb(37, 116, 169)",
        highlightFill: "rgba(220,220,220,0.75)",
        highlightStroke: "rgba(220,220,220,1)",
        data: [
          <?php
          for ($bulan = 1; $bulan <= 12; $bulan++) {
            $tahun = date('Y');
            $pemasukan_perbulan = DB::table('persembahan')
              ->select(DB::raw('SUM(amount) as total'))
              ->where('status', 'success')
              ->whereMonth('updated_at', $bulan)
              ->whereYear('updated_at', $tahun)
              ->first();
            // $pemasukan_perbulan_khusus = DB::table('pemasukan_khusus')
            // ->select(DB::raw('SUM(nominal) as total'))
            // ->where('status','1')
            // ->whereMonth('tanggal',$bulan)
            // ->whereYear('tanggal',$tahun)
            // ->first();
            // $pemasukan_perbulan_persembahan = DB::table('persembahan')
            // ->select(DB::raw('SUM(amount) as total'))
            // ->where('status','success')
            // ->whereMonth('updated_at',$bulan)
            // ->whereYear('updated_at',$tahun)
            // ->first();

            $total = $pemasukan_perbulan->total;
            if ($pemasukan_perbulan->total == "") {
              echo "0,";
            } else {
              echo $total . ",";
            }
          }
          ?>
        ]
      },
      {
        label: 'Pengeluaran',
        fillColor: "rgb(171, 183, 183)",
        strokeColor: "rgb(149, 165, 166)",
        highlightFill: "rgba(151,187,205,0.75)",
        highlightStroke: "rgba(151,187,205,1)",
        data: [
          <?php
          for ($bulan = 1; $bulan <= 12; $bulan++) {
            $tahun = date('Y');

            $persembahan_pengeluaran_rutin = DB::table('persembahan_pengeluaran_rutin')
              ->select(DB::raw('SUM(nominal) as total'))
              ->where('status', '1')
              ->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun)
              ->first();

            $persembahan_pengeluaran_khusus = DB::table('persembahan_pengeluaran_khusus')
              ->select(DB::raw('SUM(nominal) as total'))
              ->where('status', '1')
              ->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun)
              ->first();

            $total =  $persembahan_pengeluaran_rutin->total += $persembahan_pengeluaran_khusus->total;
            if ($total == "") {
              echo "0,";
            } else {
              echo $total . ",";
            }
          }
          ?>
        ]
      }
    ]

  }

  var barChartData4 = {
    labels: [
      @foreach($kategori as $k)
      "{{ $k->kategori }}",
      @endforeach
    ],
    datasets: [{
      label: 'Pemasukan',
      fillColor: "rgb(52, 152, 219)",
      strokeColor: "rgb(37, 116, 169)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data: [
        @foreach($kategori as $k)
        <?php
        $id_kategori = $k->id;
        $pemasukan_perbulan_persembahan = DB::table('persembahan')
          ->select(DB::raw('SUM(amount) as total'))
          ->where('donation_type', $id_kategori)
          ->where('status', 'success')
          ->first();


        $total = $pemasukan_perbulan_persembahan->total;
        if ($pemasukan_perbulan_persembahan->total == "") {
          echo "0,";
        } else {
          echo $total . ",";
        }
        ?>
        @endforeach
      ]
    }, {
      label: 'Pengeluaran',
      fillColor: "rgb(171, 183, 183)",
      strokeColor: "rgb(149, 165, 166)",
      highlightFill: "rgba(151,187,205,0.75)",
      highlightStroke: "rgba(254, 29, 29, 0)",
      data: [
        @foreach($kategori as $k)
        <?php
        $id_kategori = $k->id;
        $persembahan_pengeluaran_rutin = DB::table('persembahan_pengeluaran_rutin')
          ->select(DB::raw('SUM(nominal) as total'))
          ->where('kategori_id', $id_kategori)
          ->where('status', '1')
          ->first();
        $persembahan_pengeluaran_khusus = DB::table('persembahan_pengeluaran_khusus')
          ->select(DB::raw('SUM(nominal) as total'))
          ->where('kategori_id', $id_kategori)
          ->where('status', '1')
          ->first();

        $total = $persembahan_pengeluaran_rutin->total += $persembahan_pengeluaran_khusus->total;
        if ($persembahan_pengeluaran_rutin->total == "") {
          echo "0,";
        } else {
          echo $total . ",";
        }
        ?>

        @endforeach
      ]
    }]

  }

  window.onload = function() {

    var ctx = document.getElementById("grafik1").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {
      responsive: true,
      animation: true,
      barValueSpacing: 5,
      barDatasetSpacing: 1,
      tooltipFillColor: "rgba(0,0,0,0.8)",
      multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
    });

    var ctx = document.getElementById("grafik2").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData4, {
      responsive: true,
      animation: true,
      barValueSpacing: 5,
      barDatasetSpacing: 1,
      tooltipFillColor: "rgba(0,0,0,0.8)",
      multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
    });

  }
</script>







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
    })

  })
</script>
@endsection