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
                            <div class="col-md-12 col-sm-12 col-12">

                                  <div class="btn-group">
                                    <a  href="/lapiran" type="button" class="btn btn-warning">
                                    <i class="fas fa-undo"></i>
                                    </a>
                                  </div>
                             
                                  <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                    <li class="breadcrumb-item active">Laporan</li>
                                  </ol>
                            </div>
                        </div> 
      </div>
    </div>
  </div>

  <div class="content-header">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">
                                <div class="card card-outline card-success">
                                  <div class="card-header">
                                    <div class="card-tools"> 
                                    </div>
                                  </div>
                                    <form method="GET" action="{{ route('lapiran') }}">
                                        {{ csrf_field() }}

                                      <!--area ditambah   -->
                                      <div class="row col-md-12">

                                              <div class="form-group col-md-6">
                                              <div class="form-group">
                                                  <label>Dari Tanggal <b style="color:Tomato;">*</b></label>
                                                  <input class="form-control datepicker2" placeholder="Dari Tanggal" type="date" required="required" name="dari" value="<?php if(isset($_GET['dari'])){echo $_GET['dari'];} ?>">
                                              </div>
                                              </div>

                                              <div class="form-group col-md-6">
                                              <div class="form-group">
                                                  <label>Sampai Tanggal <b style="color:Tomato;">*</b></label>
                                                  <input class="form-control datepicker2" placeholder="Sampai Tanggal" type="date" required="required" name="sampai" value="<?php if(isset($_GET['sampai'])){echo $_GET['sampai'];} ?>">
                                              </div>
                                              </div>


                                              <div class="form-group{{ $errors->has('kas') ? ' has-error' : '' }}">
                                                    
                                                        <input id="kas" type="hidden" class="form-control" name="kas" value="" readonly="">
                                                        @if ($errors->has('kas'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('kas') }}</strong>
                                                            </span>
                                                        @endif
                                             
                                              </div>

                                              <div class="form-group col-md-12 ">
                                                <div class="form-group float-right">
                                                    <input type="submit" class="btn btn-success" value="Tampilkan">         
                                                </div>
                                              </div>

                                      </div>

                                        
                                    
                                                    
                                    </form>
                                </div>
        </div> 

      </div>    
    </div>  
  </div>

  <section class="content-header">
     <div class="container-fluid">
      <div class="card">
        @if(isset ($_GET['kas']))

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
                                          @foreach($pemasukan_rutin as $t)
                                          <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-left">{{ $t->kode_pemasukan_rutin }}</td>
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
                                            <td class="text-left">{{ $t->kode_pengeluaran_rutin }}</td>
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
                                            <td class="text-left">{{ $t->kode_pemasukan_rutin }}</td>
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
              


        @endif
      </div>    
    </div>  
  </section>



@endsection


