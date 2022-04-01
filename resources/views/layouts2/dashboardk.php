@extends('layouts2.app')
@section('content')
<section class="content-header" >
      <div class="container-fluid">

      @if (Session::has('message'))
      <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2"class="callout callout-info">
         
          <h5><i class="fas fa-info"></i> Peringatan :</h5>
          {{ Session::get('message') }}
         
      </div>
      @endif


    <div class="row">

    <div class="col-sm-6">

<h4>Grafik Kauangan</h4> 
      </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="/">Home/</a></li> -->
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div>
          
@if(Auth::user()->petugas)
      <!--PEMASUKAN--> 
      <div class="col-md-4 col-sm-4 col-12">
              <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-download"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pemasukan</span>
                <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format($seluruh_pemasukan->total)." ,-" }}</h5>
                <div class="progress"> 
                  <div class="progress-bar bg-success" style="width: 100%"></div>
                </div>
                <span class="progress-description">
              Semua
                </span>
              </div>
            </div>
      </div>

      <!--PENGELUARAN--> 
      <div class="col-md-4 col-sm-4 col-12">
          <div class="info-box">
          <span class="info-box-icon bg-warning"><i class="fa fa-upload"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Pengeluaran</span>
            <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format($seluruh_pengeluaran_khusus->total += $seluruh_pengeluaran_rutin->total  )." ,-" }}</h5>
            <div class="progress">
              <div class="progress-bar bg-warning" style="width: 100%"></div>
            </div>
            <span class="progress-description">
          Semua
            </span>
          </div>
        </div>
      </div>

      <!--SALDO SEKARANG-->
      <div class="col-md-4 col-sm-4 col-12">
        <div class="info-box">
        <span class="info-box-icon bg-danger"><i class="fa fa-credit-card"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Saldo Sekarang</span>
          <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format($seluruh_pemasukan->total -= $seluruh_pengeluaran_khusus->total)." ,-" }}</h5>
          <div class="progress">
            <div class="progress-bar bg-danger" style="width: 100%"></div>
          </div>
          <span class="progress-description">
          Semua
          </span>
        </div>
        </div>
      </div>
     
  
    <!--GRAFIK 1-->
    <div class="col-md-4 col-sm-4 col-12 ">
  
        <div class="card col-12"  >
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                    <h5  class="position-center ">Grafik Keuangan <b>Per Bulan</b> Tahun {{date('Y')}} </h5>
                    </div>
                  </div>

                  <div class="position-relative ">
                    <canvas id="grafik1"></canvas>
                  </div>
             
        </div>                     
    </div>

    <!--GRAFIK 2-->
    <div class="col-md-4 col-sm-4 col-12 ">
        
        <div class="card col-12">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h5  class="position-center ">Grafik Keuangan <b>Per Tahun</b>  </h5>
                  
                    </div>
                  </div>
                  <div class="position-relative ">
                    <canvas id="grafik2"></canvas>
                  </div>
                  
        </div>          
              
    </div>


    <!--GRAFIK KAS-->
    <div class="col-md-4 col-sm-4 col-12 ">

        <div class="card col-12">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h5  class="position-center ">Grafik Keuangan <b>Per Kas</b>  </h5>
                    </div>
                  </div>

                  <div class="position-relative ">
                    <canvas id="grafik4"></canvas>
                  </div>   
        </div>                  
    </div>


@else

          <div class="col-md-12">
            <div class="card">
              
                <div class="card-header">
                  <h2 class="card-title">GRAFIK KEUANGAN GEREJA <b> {{date('M-Y')}}  </b> </h2>

                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                  </div>

                </div>
 
                  <div class="card-footer">
                    <div class="row">

                      <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                          <span class="description-percentage text-success"><i class="fas fa-caret-down"></i> PEMASUKAN BULAN INI</span>
                          <h4 class=""><b>{{ "Rp. ".number_format($pemasukan_bulan_ini->total)." ,-" }}</b></h4>
                        </div>
                      </div>

                      <!-- /.col -->
                      <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                          <span class="description-percentage text-warning"><i class="fas fa-caret-up"></i>  PENGELUARAN BULAN INI </span>
                          <h4 class=""><b>{{ "Rp. ".number_format($pengeluaran_bulan_ini->total)." ,-" }}</b></h4>
                        </div>
                      </div>

                      <!-- /.col -->
                      <div class="col-sm-6 col-12">
                        <div class="description-block border-right">
                          <span class="description-percentage text-danger"> SALDO GEREJA SEKARANG</span>
                          <h4 class=""><b>{{ "Rp. ".number_format($seluruh_pemasukan->total -= $seluruh_pengeluaran_khusus->total)." ,-" }}</b></h4>         
                        </div>
                      </div>

                      
                    </div>
                  </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-md-6">
                      <div class="card col-12"  >
                                <div class="card-header border-0">
                                  <div class="d-flex justify-content-between">
                                  <h5  class="position-center ">Grafik Keuangan <b>Per Bulan</b> Tahun {{date('Y')}} </h5>
                                  <!--  
                                  <a href="javascript:void(0);"> Tahun {{date('Y')}}</a>
                                  -->
                                  </div>
                                </div>

                                <div class="position-relative ">
                                <canvas id="grafik1"></canvas>
                                  </div>       
                      </div>          
                  </div>

                  <!-- <div class="col-md-6">
                  </div> -->
                  <!-- /.col -->
                  <div class="col-md-6">
                    <div class="card col-12">
                        <div class="card-header border-0">
                          <div class="d-flex justify-content-between">
                          <h5  class="position-center ">Grafik Keuangan <b>Per Tahun</b>  </h5>
                          </div>
                        </div>

                        <div class="position-relative ">
                        <canvas id="grafik2"></canvas>
                        </div>            
                    </div>          
                  </div>
                  
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
          
            </div>
          </div>

@endif



</div>

</div>

        


        </div>
      </div><!-- /.container-fluid -->
    </section>


<!--SECTION
      -->
      
<script>
  var randomScalingFactor = function(){ return Math.round(Math.random()*500)};

  var barChartData = {
    labels : ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
    datasets : [
    {
      label: 'Pemasukan',
      fillColor : "rgb(52, 152, 219)",
      strokeColor : "rgb(37, 116, 169)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      <?php
      for($bulan=1;$bulan<=12;$bulan++){
        $tahun = date('Y');
        $pemasukan_perbulan = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereMonth('tanggal',$bulan)
        ->whereYear('tanggal',$tahun)
        ->first();
        $total = $pemasukan_perbulan->total;
        if($pemasukan_perbulan->total == ""){
          echo "0,";
        }else{
          echo $total.",";
        }
      }
      ?>
      ]
    },
    {
      label: 'Pengeluaran',
      fillColor : "rgb(171, 183, 183)",
      strokeColor : "rgb(149, 165, 166)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(151,187,205,1)",
      data : [
      <?php
      for($bulan=1;$bulan<=12;$bulan++){
        $tahun = date('Y');
        $pengeluaran_perbulan = DB::table('pengeluaran_khusus')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereMonth('tanggal',$bulan)
        ->whereYear('tanggal',$tahun)
        ->first();

        $pengeluaran_perbulan_rutin = DB::table('pengeluaran_rutin')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereMonth('tanggal',$bulan)
        ->whereYear('tanggal',$tahun)
        ->first();
        
        $total = $pengeluaran_perbulan->total += $pengeluaran_perbulan_rutin->total ;
        if($total == ""){
          echo "0,";
        }else{
          echo $total.",";
        }
      }
      ?>
      ]
    }
    ]

  }

  var barChartData2 = {
    labels : [
    <?php 
    $thn2 = DB::table('transaksi')
    ->select(DB::raw('year(tanggal) as tahun'))
    ->distinct()
    // DARI TAHUN SEBELUMNYA
    ->orderBy('tahun','asc')
    ->get();
    foreach($thn2 as $t){
      ?>
      "<?php echo $t->tahun; ?>",
      <?php 
    }
    ?>
    ],
    datasets : [
    {
      label: 'Pemasukan',
      fillColor : "rgb(52, 152, 219)",
      strokeColor : "rgb(37, 116, 169)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      <?php
      foreach($thn2 as $t){
        $thn = $t->tahun;
        $tahun = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereYear('tanggal',$thn)
        ->first();
        $total = $tahun->total;
        if($tahun->total == ""){
          echo "0,";
        }else{
          echo $total.",";
        }

      }
      ?>
      ]
    },
    {
      label: 'Pengeluaran',
      fillColor : "rgb(171, 183, 183)",
      strokeColor : "rgb(149, 165, 166)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(254, 29, 29, 0)",
      data : [
      <?php
      foreach($thn2 as $t){
        $thn = $t->tahun;
        $tahun = DB::table('pengeluaran_khusus')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereYear('tanggal',$thn)
        ->first();

        $tahun_rutin = DB::table('pengeluaran_rutin')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereYear('tanggal',$thn)
        ->first();

        $total = $tahun->total += $tahun_rutin->total;
        if( $total == ""){
          echo "0,";
        }else{
          echo $total.",";
        }
      }
      ?>
      ]
    }
    ]

  }

  var barChartData4 = {
    labels : [
    @foreach($kas as $k)
    "{{ $k->kas }}",
    @endforeach
    ],
    datasets : [
    {
      label: 'Pemasukan',
      fillColor : "rgb(52, 152, 219)",
      strokeColor : "rgb(37, 116, 169)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      @foreach($kas as $k)
      <?php 
      $id_kas = $k->id;
      $pemasukan_perkas = DB::table('transaksi')
      ->select(DB::raw('SUM(nominal) as total'))
      ->where('kas_id',$id_kas)
      ->where('status','1')
      ->first();
      $total = $pemasukan_perkas->total;
      if($pemasukan_perkas->total == ""){
        echo "0,";
      }else{
        echo $total.",";
      }
      ?>
      @endforeach
      ]
    },{
      label: 'Pengeluaran',
      fillColor : "rgb(171, 183, 183)",
      strokeColor : "rgb(149, 165, 166)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(254, 29, 29, 0)", 
      data : [
      @foreach($kas as $k)
      <?php 
      $id_kas = $k->id;
      $pengeluaran_perkas = DB::table('pengeluaran_khusus')
      ->select(DB::raw('SUM(nominal) as total'))
      ->where('kas_id',$id_kas)
      ->where('status','1')
      ->first();

      $pengeluaran_perkas_rutin = DB::table('pengeluaran_rutin')
      ->select(DB::raw('SUM(nominal) as total'))
      ->where('kas_id',$id_kas)
      ->where('status','1')
      ->first();

      $total = $pengeluaran_perkas->total +=  $pengeluaran_perkas_rutin->total ;
      if($pengeluaran_perkas->total == ""){
        echo "0,";
      }else{
        echo $total.",";
      }
      ?>
      @endforeach
      ]
    }
    ]

  }


  window.onload = function()
  {

    var ctx = document.getElementById("grafik1").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });

    var ctx = document.getElementById("grafik2").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData2, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });

   var ctx = document.getElementById("grafik4").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData4, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });



  }

</script>



@endsection
