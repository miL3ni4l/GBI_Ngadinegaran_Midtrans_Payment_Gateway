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


<section class="content-header">
      <div class="container-fluid">
        <div class="row">

                <div class="col-sm-6">
                  <h4>Filter Laporan Kategori</h4> 
                </div>

                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Filter Laporan Kategori</li>
                  </ol>
                </div>
                
                  <div class=" table-responsive col-md-12 col-sm-6 col-12">
                            
                              
                              <!--area ditambah-->   
                  <!--area diisi-->         
                    <div class="card card-secondary">
                      <div class="card-body">
                        
                        <form method="GET" action="{{ route('laporan') }}">
                              {{ csrf_field() }}

                          <!--area ditambah   -->
                          <div class="row col-md-12">

                                  <div class="form-group col-md-4">
                                    <div class="form-group">
                                      <label>Dari Tanggal</label>
                                      <input class="form-control datepicker2" placeholder="Dari Tanggal" type="date" required="required" name="dari" value="<?php if(isset($_GET['dari'])){echo $_GET['dari'];} ?>">
                                    </div>
                                  </div>

                                  <div class="form-group col-md-4">
                                    <div class="form-group">
                                      <label>Sampai Tanggal</label>
                                      <input class="form-control datepicker2" placeholder="Sampai Tanggal" type="date" required="required" name="sampai" value="<?php if(isset($_GET['sampai'])){echo $_GET['sampai'];} ?>">
                                    </div>
                                  </div>

                                  <div class="form-group col-md-4">
                                    <div class="form-group">
                                      <label>Cari Kategori</label>
                                      <select class="form-control" name="kategori">
                                        <option value="">SEMUA KATEGORI</option>
                                        @foreach($kategori as $k)
                                        <option <?php 
                                        if(isset($_GET['kategori']))
                                        { if($_GET['kategori'] == $k->id){echo "selected='selected'";} } ?> value="{{ $k->id }}">{{ $k->kategori }}</option>
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


                    
                              @if(isset ($_GET['kategori']))


                              <!--HASIL CETAK DARI FILTER-->
                              <div class="card">

                                <div class="card-header pt-4">
                                  <h3 class="card-title">Data Laporan Keuangan</h3>
                                </div>





                                <div class="card-body">
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-info"></i> Note :</h5>
                                    Halaman ini telah ditingkatkan untuk pencetakan. Klik tombol cetak di sebelah kanan.
                                </div>
                                
                                  <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">

                                      <div class="col-12">
                                        <h4>
                                        <img src="/adminlte/dist/img/credit/gbi.png" alt="Visa">
                                          &nbsp; GBI Ngadinegaran Yogyakarta
                                          <a target="_BLANK" href="{{ route('laporan_print',['kategori' => $_GET['kategori'], 'dari' => $_GET['dari'], 'sampai' => $_GET['sampai']]) }}"  class="btn btn-default float-right bg-primary col-md-2 text-center"><i class="fa fa-print "></i> &nbsp; Print</a>
                                          <a target="_BLANK" href="{{ route('laporan_excel',['kategori' => $_GET['kategori'], 'dari' => $_GET['dari'], 'sampai' => $_GET['sampai']]) }}" class="btn btn-default float-right bg-success col-md-2 text-center" ><i class="fa fa-file-excel"></i></i> &nbsp; Cetak Excel</a>           
                                        
                                        <!-- title row
                                          <a target="_BLANK" href="{{ route('laporan_pdf',['kategori' => $_GET['kategori'], 'dari' => $_GET['dari'], 'sampai' => $_GET['sampai']]) }}" class="btn btn-default float-right bg-danger col-md-2 text-center" ><i class="fas fa-print"></i></i> &nbsp; Cetak PDF</a>           
                                        -->
                                        </h4>
                                      </div>
                                      <br>  <br>  <br>
                                <table class="col-12 float-right">
                                  <h4>
                                      <div class="col-12">
                                        <div class="invoice-col">

                                        <tr>
                                        <th width="175">DARI TANGGAL</th>
                                        <th width="2%" class="text-left">:</th>
                                        <td  class="text-left">{{ date('d-m-Y',strtotime($_GET['dari'])) }}</td>
                                        </tr>
                                    
                                      <tr >
                                        <th width="175">SAMPAI TANGGAL</th>
                                        <th width="2%" class="text-left">:</th>
                                        <td class="text-left">{{ date('d-m-Y',strtotime($_GET['sampai'])) }}</td>
                                      </tr> 

                                      
                                      <tr>
                                        <th width="175">NAMA KATEGORI</th>
                                        <th width="2%" class="text-left">:</th>
                                        <td  class="text-left">
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
                                  </h4>

                                </table>
                                    </div>


                                      
                                      <!-- /.col -->
                                    </div>
                                    <!-- info row -->

                                    <!-- info row -->
                                    <div class="col-sm-12 row invoice-info">
                                      <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    <br>
                                    <!-- Table row -->
                                    <div class="row">
                                      <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                          <thead>
                                          <tr>
                                            <th class="text-center">NO</th>
                                            <th class="text-center">KODE pemasukan_rutin</th>
                                            <th class="text-center">TANGGAL</th>
                                            <th class="text-center">NAMA KATEGORI</th>
                                            <th class="text-center">KETERANGAN</th>
                                            <th class="text-center">PEMASUKAN</th>
                                            <th class="text-center">PENGELUARAN</th>
                                          </tr>
                                          </thead>

                                          <tbody>
                                          @php
                                          $no = 1;
                                          $total_pemasukan = 0;
                                          $total_pengeluaran = 0;
                                          @endphp
                                        @foreach($pemasukan_rutin as $t)
                                        <tr>
                                          <td class="text-center">{{ $no++ }}</td>
                                          <td class="text-center">{{ $t->kode_pemasukan_rutin }}</td>
                                          <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                                          <td>{{ $t->detail_kategori->kategori }}</td>

                                                @if($t->keterangan  == null)
                                                <td class ="text-center"> -</td>
                                                @else
                                                <td>{{ $t->keterangan }}</td>
                                                @endif
                                          
                                          <td class="text-right">
                                            @if($t->jenis == "Pemasukan")
                                            {{ "Rp.".number_format($t->nominal).",-" }}
                                            @php $total_pemasukan += $t->nominal; @endphp
                                            @else
                                            {{ "-" }}
                                            @endif
                                          </td>
                                          <td class="text-right">
                                            @if($t->jenis == "Pengeluaran")
                                            {{ "Rp.".number_format($t->nominal).",-" }}
                                            @php $total_pengeluaran += $t->nominal; @endphp
                                            @else
                                            {{ "-" }}
                                            @endif
                                          </td>
                                        </tr>
                                        @endforeach
                                      </tbody>

                                      <tfoot class="bg-info text-white font-weight-bold">
                                        <tr>
                                          <td colspan="5" class="text-bold text-left bg-secondary">TOTAL PEMASUKAN </td>
                                          <td class="text-left bg-primary">{{ "Rp.".number_format($total_pemasukan).",-" }}</td>
                                          <td class="text-left bg-primary"></td>
                                          
                                        </tr>
                                        <tr>
                                          <td colspan="5" class="text-bold text-left bg-secondary">TOTAL PENGELUARAN</td>
                                          <td class="text-left bg-primary">{{ "Rp.".number_format($total_pengeluaran).",-" }}</td>
                                          <td class="text-left bg-primary"></td>
                                        </tr>
                                      </tfoot>

                                        </table>
                                      </div>
                                      <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                      <!-- accepted payments column -->
                                      <div class="col-6">
                                        <p class="lead"><b>Pembayaran Via BANK BCA :</b></p>
                                        
                                        <img src="/adminlte/dist/img/credit/visa.png" alt="Visa">
                                        <!-- accepted payments column
                                        <img src="/adminlte/dist/img/credit/mastercard.png" alt="Mastercard">
                                        <img src="/adminlte/dist/img/credit/american-express.png" alt="American Express">
                                        <img src="/adminlte/dist/img/credit/paypal2.png" alt="Paypal">
                                        -->
                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                          Kas BCA GBI NGADINEGARAN
                                          </br>
                                          No Rekening :<b> 445 1096 448</b>
                                          </br>
                                          <b>a/n Marthinus Sumendi S.Th atau Sardjono</b>
                                        </p>
                                      </div>
                                      <!-- /.col -->

                                      <div class="col-6">
                                        

                                        <div class="table-responsive">
                                            <p class="lead"><b>Saldo Akhir :</b></p>
                                          <table class="table">

                                            <!--SALDOAKHI -->
                                              <tr> 
                                                  <th width="65%">
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

                                                  </th>
                                              
                                                  <th width="1%" class="text-left">:</th>

                                          

                                              <!--CARA MENGHHITUNG TOTAL SALDO AKHIR -->
                                              <td class="text-left">
                                              <h5 class="info-box-number text-danger"> <b>{{ "Rp.".number_format($total_pemasukan - $total_pengeluaran).",-" }}</b></h5>
                                              </td>
                                              
                                              </tr>
                                  
                                        
                                          </table>
                                        </div>

                                      </div>
                                      <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- this row will not appear when printing -->
                                  
                                  </div>

                                </div>

                              </div>
                              @endif


                      
                        </div>
                                        
                    </div>
                  </div>

        </div>
      </div><!-- /.container-fluid -->
</section>

@endsection


