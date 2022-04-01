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
            
            <div class="btn-group">
                <a href="{{ route('kas.create') }}"  type="button" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            </div>       
            
            <div class="btn-group">
                                    <button  data-toggle="modal" data-target="#modal-filter"  type="button" class="btn btn-success">
                                    <i class="fas fa-filter  text-center"></i>
                                    </button>
            </div>
            <!-- <div class="btn-group">
                                    <button  data-toggle="modal" data-target="#modal-filter1"  type="button" class="btn btn-secondary">
                                    <i class="fas fa-tachometer-alt  text-center"></i>
                                    </button>
            </div> -->
            <div class="btn-group">
                                    <a  href="{{route('kas.index')}}" type="button" class="btn btn-warning">
                                    <i class="fas fa-undo"></i>
                                    </a>
            </div>
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Kas</li>
              
            </ol>
            </div>
        </div>    

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>

@if (Session::has('message'))
                    <section class="content-header">
                      <div class="container-fluid">

                              <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <!-- <a class="close" data-dismiss="alert" >x</a> -->
                                  <a class="close" data-dismiss="alert" class="btn btn-danger btn-sm" ><i style="color:red" class="fas fa-times"></i></a>  
                                </button>
                              </div>
          
                      </div>
                    </section>
                    
                  @endif

  @if(isset ($_GET['kas']))
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
          

                <!-- JUDUL -->
                <div class="card-header pt-4">
                  <h3 class="card-title">Data Laporan</h3>
                </div>
                
                <!-- NOTE -->
                <div class="card-header pt-4">
                  <div  class="callout callout-info ">
                      <h5><i class="fas fa-info"></i> Note :</h5>
                      Halaman ini telah ditingkatkan untuk pencetakan. Klik tombol warna biru.
                  </div>
                </div>

                <!-- LOGO -->
                <div class="card-header pt-4">
                  <div class="col-12">
                    <h5>
                      <img src="/adminlte/dist/img/credit/gbi.png" alt="Visa">   GBI Ngadinegaran Yogyakarta

                      <a target="_BLANK" href="{{ route('lapiran_print',['kas' => $_GET['kas'], 'dari' => $_GET['dari'], 'sampai' => $_GET['sampai']]) }}"  class="btn btn-default float-right bg-primary col-md-2 text-center"><i class="fa fa-print "></i> &nbsp; Print</a>
      
                      <a target="_BLANK" href="{{ route('lapiran_excel',['kas' => $_GET['kas'], 'dari' => $_GET['dari'], 'sampai' => $_GET['sampai']]) }}" class="btn btn-default float-right bg-success col-md-2 text-center" ><i class="fa fa-file-excel"></i></i> &nbsp; Cetak Excel</a>           
                    
                    </h5>
                  </div>
                </div>

                <!-- TABEL -->
                <div class="card-header pt-4">
                  <table class="col-12 float-right">
                      <h4>
                          <div class="col-12">
                            <div class="invoice-col">

                              <tr>
                                <th width="150">DARI TANGGAL</th>
                                <th width="5%" class="text-left">:</th>
                                <td  class="text-left">{{ date('d-m-Y',strtotime($_GET['dari'])) }}</td>
                              </tr>
                        
                              <tr >
                                  <th width="150">SAMPAI TANGGAL</th>
                                  <th width="5%" class="text-left">:</th>
                                  <td class="text-left">{{ date('d-m-Y',strtotime($_GET['sampai'])) }}</td>
                              </tr> 

                              <!-- <tr>
                                  <th width="150">KAS</th>
                                  <th width="5%" class="text-left">:</th>
                                  <td  class="text-left">
                                  @php
                                  $id_kas = $_GET['kas'];
                                  @endphp

                                  @if($id_kas == "")
                                      @php
                                      $kat = "SEMUA KAS";
                                      @endphp
                                  @else
                                      @php
                                      $katt = DB::table('kas')->where('id',$id_kas)->first();
                                      $kat = $katt->kas
                                      @endphp
                                  @endif

                                  {{$kat}}
                                  </td>
                              </tr> -->

                            </div>
                          </div>
                      </h4>
                  </table>
                </div>

                <br>  

                <div class="card-header pt-4">
                  <div class="row">

                    <div class="col-12 table-responsive">
                                      <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th class="text-center">NO</th>
                                            <th class="text-center">KODE</th>
                                            <th class="text-center">TANGGAL</th>
                                            <th class="text-center">KATEGORI</th>
                                            <th class="text-center">KAS</th>
                                            <th class="text-center">PEMASUKAN</th>
                                            <th class="text-center">PENGELUARAN</th>
                                          </tr>
                                          
                                        </thead>

                                        <tbody>
                                            @php
                                            $no = 1;
                                            $total_pemasukan_rutin = 0;
                                            $total_pemasukan_khusus = 0;
                                            $total_pengeluaran_khusus = 0;
                                            $total_pengeluaran_rutin = 0;
                                          
                                            @endphp

                                            <!-- PEMASUKAN RUTIN -->
                                            @foreach($transaksi as $t)
                                            <tr>
                                              <td class="text-center">{{ $no++ }}</td>
                                              <td class="text-left">{{ $t->kode_transaksi }}</td>
                                              <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                                              <td class="text-left">{{ $t->detail_kategori->kategori }}</td>
                                              <td class="text-left">{{ $t->kas->kas }}</td>
                                              <td class="text-right">{{ "Rp.".number_format($t->nominal).",-" }}</td>
                                              @php $total_pemasukan_rutin += $t->nominal; @endphp
                                              <td class="text-left"></td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                              <td colspan="5" class="text-bold text-left bg-green">PEMASUKAN RUTIN </td>
                                              <td class="text-right bg-green"><b>{{ "Rp.".number_format($total_pemasukan_rutin).",-" }}</b></td>
                                              <td class="text-left bg-green"></td>
                                            </tr>

                                            <!-- PENGELUARAN RUTIN -->
                                            @foreach($pengeluaran_rutin as $t)
                                            <tr>
                                              <td class="text-center">{{ $no++ }}</td>
                                              <td class="text-left">{{ $t->kode_transaksi }}</td>
                                              <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                                              <td class="text-left">{{ $t->kategori_pengeluaran->kategori }}</td>
                                              <td class="text-left">{{ $t->kas->kas }}</td>
                                              <td class="text-left"></td>
                                              <td class="text-right">{{ "Rp.".number_format($t->nominal).",-" }}</td>
                                              @php $total_pengeluaran_rutin += $t->nominal; @endphp
                                            </tr>
                                            @endforeach
                                            <tr>
                                              <td colspan="5" class="text-bold text-left bg-yellow ">PENGELUARAN RUTIN </td>
                                              <td class="text-left bg-yellow"></td>
                                              <td class="text-right bg-yellow"><b>{{ "Rp.".number_format($total_pengeluaran_rutin).",-" }}</b></td>
                                            </tr>

                                            <!-- PEASUKAN KKHUSUS -->
                                            @foreach($pemasukan_khusus as $t)
                                            <tr>
                                              <td class="text-center">{{ $no++ }}</td>
                                              <td class="text-left">{{ $t->kode_pemasukan_khusus }}</td>
                                              <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                                              <td class="text-left">{{ $t->detail_kategori->kategori }}</td>
                                              <td class="text-left">{{ $t->kas->kas }}</td>
                                              <td class="text-right">{{ "Rp.".number_format($t->nominal).",-" }}</td>
                                              @php $total_pemasukan_khusus += $t->nominal; @endphp
                                              <td class="text-left"></td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                              <td colspan="5" class="text-bold text-left bg-green">PEMASUKAN KHUSUS </td>
                                              <td class="text-right bg-green"><b>{{ "Rp.".number_format($total_pemasukan_khusus).",-" }}</b></td>
                                              <td class="text-left bg-green"></td>
                                            </tr>

                                            <!-- PENGELUARAN KHUSUS -->
                                            @foreach($pengeluaran_khusus as $t)
                                            <tr>
                                              <td class="text-center">{{ $no++ }}</td>
                                              <td class="text-left">{{ $t->kode_transaksi }}</td>
                                              <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                                              <td class="text-left">{{ $t->detail_kategori->kategori }}</td>
                                              <td class="text-left">{{ $t->kas->kas }}</td>
                                              <td class="text-left"></td>
                                              <td class="text-right">{{ "Rp.".number_format($t->nominal).",-" }}</td>
                                              @php $total_pengeluaran_khusus += $t->nominal; @endphp
                                            </tr>
                                            @endforeach
                                            <tr>
                                              <td colspan="5" class="text-bold text-left bg-yellow ">PENGELUARAN KHUSUS </td>
                                              <td class="text-left bg-yellow"></td>
                                              <td class="text-right bg-yellow "><b>{{ "Rp.".number_format($total_pengeluaran_khusus).",-" }}</b></td>
                                            </tr>


                                        </tbody>

                                        <tfoot class="bg-info text-white font-weight-bold">
                  
                                          <tr>
                                          @php $total_pemasukan =  $total_pemasukan_rutin +=  $total_pemasukan_khusus; @endphp
                                            <td colspan="5" class="text-bold text-left bg-secondary">TOTAL PEMASUKAN </td>
                                            <td class="text-left bg-primary"></td>
                                            <td class="text-right bg-primary">{{ "Rp.".number_format($total_pemasukan).",-" }}</td>

                                            
                                          </tr>
                                          <tr>
                                          @php $total_pengeluaran =  $total_pengeluaran_khusus +=  $total_pengeluaran_rutin; @endphp
                                            <td colspan="5" class="text-bold text-left bg-secondary">TOTAL PENGELUARAN</td>
                                            <td class="text-left bg-primary"></td>
                                            <td class="text-right bg-primary">{{ "Rp.".number_format($total_pengeluaran).",-" }}</td>

                                          </tr>

                                          <tr>
                                          @php $total_pendapatan =  $total_pemasukan -=  $total_pengeluaran; @endphp
                                            <td colspan="5" class="text-bold text-left bg-secondary">TOTAL PENDAPATAN</td>
                                            <td class="text-left bg-primary"></td>
                                            <td class="text-right bg-primary">{{ "Rp.".number_format($total_pendapatan).",-" }}</td>

                                          </tr>
                                        </tfoot>

                                      </table>
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
                  <div class="card-header">
                    <h3 class="card-title">Data Kas</h3>
                  </div>
                  <div class="card">
                  </div>

                  <div class=" table-responsive col-md-12 col-sm-12 col-12">
                    <table  id="example1" class="table table-striped">
                        <thead> 
                        <tr>
                        <th width="1%">NO</th>
                
                        <th class="text-center">KAS</th>
                        <th class="text-center">KETERANGAN</th>
                        <th class="text-center" >SISA SALDO</th>
                        <th class="text-center" >UPDATE</th>
                        @if(Auth::user()->level == 'admin')
                        <th class="text-center col-md-2" width="10%">OPSI</th>
                        @endif
                        </tr>
                        </thead>
                        <tbody>
                          @php
                          $no = 1;
                          @endphp
                          @foreach($kas as $k)
                          <tr>
                            <td class="text-left">{{ $no++ }}</td>
                            <td>Kas {{ $k->kas }}</td>
                            @if($k->keterangan  == null)
                                  <td class ="text-center"> -</td>
                                  @else
                                  <td>{{ $k->keterangan }}</td>
                            @endif

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

                                                                        $pengeluaran_perkas_rutin = DB::table('pengeluaran_rutin')
                                                                        ->select(DB::raw('SUM(nominal) as total'))
                                                                        ->where('kas_id',$id_kas)
                                                                        ->where('status','1')
                                                                        ->first();   

                                                                        $pengeluaran_perkas_khusus = DB::table('pengeluaran_khusus')
                                                                        ->select(DB::raw('SUM(nominal) as total'))
                                                                        ->where('kas_id',$id_kas)
                                                                        ->where('status','1')
                                                                        ->first();   

                                                                        $total_pemasukan = $pemasukan_perkas->total +=  $pemasukan_perkas_khusus->total;  
                                                                        $total_penngeluaran = $pengeluaran_perkas_rutin->total +=  $pengeluaran_perkas_khusus->total;  
                                                                        $total = $total_pemasukan -=  $total_penngeluaran ;                                        
                              ?>
                            <td class="text-right">{{ "Rp. ".number_format($total)." ,-" }}</td>
                            <td class="text-center">{{ $k->updated_at->diffForHumans() }}</td>

                            @if(Auth::user()->level == 'admin')
                            <td class="text-center col-md-1">    
                              <!-- <a  href="{{route('kas.show', $k->id)}}" class="btn btn-info btn-sm  text-center" tooltip >
                                                            <i class="fa fa-eye text-center"></i>
                              </a> -->
                              <a href="{{route('kas.edit', $k->id)}}" class="btn btn-secondary btn-sm  text-center" >
                                <i class="fas fa-edit  text-center"></i>
                              </a>
                              <a  data-toggle="modal" data-target="#modalDelete_{{ $k->id }}" class="btn btn-danger btn-sm  text-center" >
                                <i class="fas fa-trash  text-center"></i>
                              </a>
                              
                              <!-- Modal -->
                            
                            
                              
                            <form action="{{ route('kas.destroy', $k->id)}}" method="post">
                                    <div class="modal fade" id="modalDelete_{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header  bg-danger">
                                            <h4 class="modal-title">Peringatan</h4>
                                          </div>
                                          <div class="modal-body">
                                          {{ csrf_field() }}
                                                          {{ method_field('delete') }}

                                                          <p>Apakah anda yakin ingin menghapus data <b>{{$k->kas}}</b> ?</p>

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

  <!-- MODAL FILTER -->
  <div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-white">
          <div class="modal-header">
            <h4 class="modal-title" id="modal-title-notification">Filter Kas</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
              <form method="GET" action="{{ route('periode_kas') }}">
                        {{ csrf_field() }}                                        
                          <div class="form-group col-md-12">
                            <div class="form-group">
                              <label>Dari Tanggal</label>
                              <input class="form-control datepicker2"  placeholder="Dari Tanggal" type="date" required="required" name="dari" value="<?php if(isset($_GET['dari'])){echo $_GET['dari'];} ?>">
                            </div>
                          </div>

                          <div class="form-group col-md-12">
                            <div class="form-group">
                              <label>Sampai Tanggal</label>
                              <input class="form-control datepicker2"  placeholder="Sampai Tanggal" type="date" required="required" name="sampai" value="<?php if(isset($_GET['sampai'])){echo $_GET['sampai'];} ?>">
                            </div>
                          </div>


                          <div class="form-group col-md-12">
                            <div class="form-group">
                              <label>Cari Kas</label>
                              <select class="form-control" name="kas">
                              <option value="">-- SEMUA KAS --</option>
                                @foreach($kas as $k)
                                <option <?php if(isset($_GET['kas'])){ if($_GET['kas'] == $k->id){echo "selected='selected'";} } ?> value="{{ $k->id }}">{{ $k->kas }}</option>
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
    var randomScalingFactor = function(){ return Math.round(Math.random()*500)};

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


    window.onload = function()
    {

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

@section('scripts')
  <script type="text/javascript">
      $(document).ready(function(){
  
          // btn refresh
          $('.btn-refresh').click(function(e){
              e.preventDefault();
              $('.preloader').fadeIn();
              location.reload();
          })
  
          $('.btn-filter').click(function(e){
              e.preventDefault();
            
              $('#modal-filter').modal();
              $('#modal-filter1').modal();
          })
  
      })


      
  </script>
@endsection

