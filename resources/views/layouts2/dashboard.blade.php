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

  <div class="content-header">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12 col-sm-12 col-12">
              <div class="col-sm-12">   
              
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/home">Home</a></li>
                </ol>
              </div>
          </div> 

          @if(Auth::user()->petugas)
             @if(Auth::user()->level == 'editor')
             <h1>EDITOR</h1>      
            @else
                     <!--PEMASUKAN--> 
                     <div class="col-md-4 col-sm-4 col-12">  
                    <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-caret-up"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Pemasukan</span>
                      <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format($pemasukan_rutin->total += $pemasukan_khusus->total)." ,-" }}</h5>
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
                <span class="info-box-icon bg-warning"><i class="fa fa-caret-down"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pengeluaran</span>
                  <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format($pengeluaran_khusus->total += $pengeluaran_rutin->total  )." ,-" }}</h5>
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
                <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format
                  (
                  $total_saldo   
                  )
                  ." ,-" }}</h5>
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
                          <h5  class="position-center ">Grafik <b>Per Bulan</b> Tahun {{date('Y')}} </h5>
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
                            <h5  class="position-center ">Grafik <b>Per Tahun</b>  </h5>
                        
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
                            <h5  class="position-center ">Grafik <b>Per Kas</b>  </h5>
                          </div>
                        </div>

                        <div class="position-relative ">
                          <canvas id="grafik4"></canvas>
                        </div>   
              </div>                  
            </div>

            <!-- <div class="col-md-12 col-sm-12 col-12 ">
              <div class="card col-12">
                        <div class="card-header border-0">
                          <div class="d-flex justify-content-between">
                            <h5  class="position-center ">Grafik <b>Midtrans Per Bulan </b>  </h5>
                          </div>
                        </div>

                        <div class="position-relative ">
                          <canvas id="grafik8"></canvas>
                        </div>   
              </div>                  
            </div> -->

         
            @endif
            
    
          @else
            <!-- <div class="col-md-12">
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
                            <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format($pemasukan_rutin->total += $pemasukan_khusus->total )." ,-" }}</h5>
                          </div>
                        </div>

                    
                        <div class="col-sm-3 col-6">
                          <div class="description-block border-right">
                            <span class="description-percentage text-warning"><i class="fas fa-caret-up"></i>  PENGELUARAN BULAN INI </span>
                            <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format($pengeluaran_khusus->total += $pengeluaran_rutin->total  )." ,-" }}</h5>
                          </div>
                        </div>

          
                        <div class="col-sm-6 col-12">
                          <div class="description-block border-right">
                            <span class="description-percentage text-danger"> SALDO GEREJA SEKARANG</span>
                              <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format
                                (
                                $total_saldo   
                                )
                                ." ,-" }}
                              </h5>      
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
                                    <h5  class="position-center ">Grafik <b>Per Bulan</b> Tahun {{date('Y')}} </h5>

                                    </div>
                                  </div>

                                  <div class="position-relative ">
                                  <canvas id="grafik1"></canvas>
                                    </div>       
                        </div>          
                    </div>


                    <div class="col-md-6">
                      <div class="card col-12">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                            <h5  class="position-center ">Grafik <b>Per Tahun</b>  </h5>
                            </div>
                          </div>

                          <div class="position-relative ">
                          <canvas id="grafik2"></canvas>
                          </div>            
                      </div>          
                    </div>
                    

                  </div>

                </div>
            
              </div>
            </div> -->

            <!--PEMASUKAN--> 
            <div class="col-md-4 col-sm-4 col-12">  
                    <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-caret-up"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Pemasukan</span>
                      <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format($pemasukan_rutin->total += $pemasukan_khusus->total )." ,-" }}</h5>
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
                <span class="info-box-icon bg-warning"><i class="fa fa-caret-down"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pengeluaran</span>
                  <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format($pengeluaran_khusus->total += $pengeluaran_rutin->total  )." ,-" }}</h5>
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
                <h5 class="info-box-number text-dark ">{{ "Rp. ".number_format
                  (
                  $total_saldo   
                  )
                  ." ,-" }}</h5>
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
                          <h5  class="position-center ">Grafik <b>Per Bulan</b> Tahun {{date('Y')}} </h5>
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
                            <h5  class="position-center ">Grafik <b>Per Tahun</b>  </h5>
                        
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
                            <h5  class="position-center ">Grafik <b>Per Kas</b>  </h5>
                          </div>
                        </div>

                        <div class="position-relative ">
                          <canvas id="grafik8"></canvas>
                        </div>   
              </div>                  
            </div>



          @endif

     
        </div>
      </div>
  </div>

     


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
        $pemasukan_perbulan_khusus = DB::table('pemasukan_khusus')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereMonth('tanggal',$bulan)
        ->whereYear('tanggal',$tahun)
        ->first();

        $total = $pemasukan_perbulan->total += $pemasukan_perbulan_khusus->total ;
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
        $tahun_khusus = DB::table('pemasukan_khusus')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereYear('tanggal',$thn)
        ->first();

        $total = $tahun->total += $tahun_khusus->total;
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
      $pemasukan_perkas_khusus = DB::table('pemasukan_khusus')
      ->select(DB::raw('SUM(nominal) as total'))
      ->where('kas_id',$id_kas)
      ->where('status','1')
      ->first();

      $total = $pemasukan_perkas->total +=  $pemasukan_perkas_khusus->total ;
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

  var barChartData8 = {
    labels : ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
    datasets : [
    {
      label: 'Payment',
      fillColor : "rgb(52, 152, 219)",
      strokeColor : "rgb(37, 116, 169)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      <?php
      for($bulan=1;$bulan<=12;$bulan++){
        $tahun = date('Y');
        $pemasukan_perbulan = DB::table('donations')
        ->select(DB::raw('SUM(amount) as total'))
        ->where('status','success')
        ->whereMonth('created_at',$bulan)
        ->whereYear('created_at',$tahun)
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

   var ctx = document.getElementById("grafik8").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData8, {
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


