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
                
                  <a href="{{ route('kategori.create') }}" class="btn btn-primary  btn-fw col-lg-2"><i class="fa fa-plus"></i> Kategori</a>    
                  <!-- &nbsp
                  <a  data-toggle="modal" data-target="#modal-filter" class="btn btn-success btn-fw col-lg-2">
                                    <i class="fas fa-filter  text-center"></i> Filter Tanggal
                  </a> -->
                  &nbsp    
                  <a href="{{route('kategori.index')}}" class="btn btn-warning btn-filter  btn-fw col-lg-1"><i class="fas fa-undo"></i> Refresh</a> 
            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Kategori</li>
              </ol>
            </div>
        </div> 

        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>


  <!-- FILTER -->
  <!-- <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
                        <form method="GET" action="{{ route('kategori_filter') }}">
                              {{ csrf_field() }}

            
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
                                        @foreach($kategoris as $k)
                                        <option <?php 
                                        if(isset($_GET['kategori']))
                                        { if($_GET['kategori'] == $k->id){echo "selected='selected'";} } ?> value="{{ $k->id }}">{{ $k->kategori }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group col-md-4">
                                    <div class="form-group">
                                      <label color="white">5</label>
                                      <input class="form-control" type="submit" class="btn btn-success" value="Tampilkan" style="margin-top: 25px col-md-5">
                                    </div>
                                  </div>

                                  <div class="form-group col-md-4">
                                    <div class="form-group">

                                  <div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
                                                                <label for="kategori" class="col-md-12 control-label">Nama Kategori </label>
                                                                <div class="col-md-12">
                                                                    <input id="kategori" type="hidden" class="form-control" name="kategori" value="" placeholder="Masukkan Nama Detail Kategori . . ." required>
                                                            
                                                                    
                                                                    @if ($errors->has('kategori'))
                                                                        <span class="help-block text-danger">
                                                                            <strong>{{ $errors->first('kategori') }}</strong>
                                                                        </span>
                                                                    @endif

                                                                </div>
                                                </div>

                                                </div>
                                  </div>



                                  
                      
                                 
                          </div>                   
                        </form>
          </div>
        </div>
      </div>
  </div> -->

  
  <section class="content-header">

    <div class="container-fluid">
                    <div class="row">

                      <!-- MODAL NOTIFIKASI -->
                      <div class="col-lg-12">
                      @if (Session::has('message'))
                      <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                      @endif
                      </div>
                    </div>
            
                    @if(isset ($_GET['kategori']))
                    <div class="card">

                      <div class="card-header pt-4">
                        <h3 class="card-title">Laporan Keuangan Per Kategori</h3>
                      </div>

                      <div class="card-body">
                        <div class="invoice p-3 mb-3">
                          <!-- title row -->
                          <div class="row">

                            <div class="col-12">
                              <h4>
                              <img src="/adminlte/dist/img/credit/gbi.png" alt="Visa">
                                &nbsp; GBI Ngadinegaran Yogyakarta
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

                            
                            <!-- <tr>
                              <th width="175">NAMA KATEGORI</th>
                              <th width="2%" class="text-left">:</th>
                              <td  class="text-left">
                                @php
                                $id_kategori = $_GET['kategori'];
                                @endphp

                                @if($id_kategori == "")
                                  @php
                                  $kat = "SEMUA PERSEMBAHAN";
                                  @endphp
                                @else
                                  @php
                                    $katt = DB::table('kategori')->where('id',$id_kategori)->first();
                                    $kat = $katt->kategori
                                  @endphp
                                @endif
                      
                                {{$kat}}
                              </td>
                            </tr> -->

                        


                          
                          



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
                                  <th class="text-center">KODE</th>
                                  <th class="text-center">TANGGAL</th>
                                  <th class="text-center">KATEGORI</th>
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

                                @foreach($transaksi as $t)
                                
                                <tr>
                                      <td class="text-center">{{ $no++ }}</td>

                                      <td class="text-center">{{ $t->kode_transaksi }}</td>

                                      <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>

                                      <td>{{ $t->detail_kategori->kategori }}</td>

                                      @if($t->keterangan  == null)
                                            <td class ="text-center"> -</td>
                                      @else
                                             <td> 
                                                <i>{{ $t->keterangan }}</i>
                                              </td> 
                                      @endif
                                      
                                      <td class="text-right">
   
                                        {{ "Rp.".number_format($t->nominal).",-" }}
                                        @php $total_pemasukan += $t->nominal; @endphp

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
                                          $kat = "SEMUA PERSMBAHAN RUTIN";
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







            <!-- BUKA TABEL -->
      
            <div class=" table-responsive col-md-12 col-sm-6 col-12">
            <!-- ISI TABEL -->
            <table class="table table-striped" id="example1">
                                        <thead>
                                        <tr>
                                                    <th width="1%">NO</th>                                                       
                                                    <th class="text-center">KATEGORI</th>
                                                    <th class="text-center">DETAIL KATEGORI</th>
                                                    
                                                    <th class="text-center" >UPDATE</th>   
                                                    <!-- <th class="text-center">SALDO</th> -->
                                                   
                                                    @if(Auth::user()->level == 'admin')
                                                    <th class="text-center col-md-2" width="10%">OPSI</th>
                                                    @endif
                                          </tr>
                                        </thead>
                                        <tbody>
                                                      @php
                                                      $no = 1;
                                                      @endphp
                                                      @foreach($kategoris as $k)
                                                      
                                                      <tr>
                                                          <td class="text-left">{{ $no++ }}</td> 

                                                          <td>{{ $k->kategori }}</td>
                                                        
                                                          <td>
                                                          @php
                                                          $nmr = 1;
                                                          @endphp
                                                            @foreach ($k->detail_kategori as $dk)
                                                            <ol>
                                                          
                                                               {{ $nmr++ }}. {{$dk->kode_kategori}} - {{$dk->kategori}} 
                                                            </ol>
                                                                                           
                                                            @endforeach
                                                          </td>
                                                          
                                                          <td class="text-left">{{ $k->updated_at->diffForHumans() }}</td>  

                                                          <!-- SALDO -->
                                                          <!-- <td>
                                                            @foreach ($k->detail_kategori as $dk)
                                                              <?php 
                                                                $id_kategori = $dk->id;
                                                                $pemasukan_perkategori = DB::table('transaksi')
                                                                ->select(DB::raw('SUM(nominal) as total'))
                                                                ->where('kategori_id',$id_kategori)
                                                                ->where('status','1')
                                                                ->first();
                                                            

                                                                $total = $pemasukan_perkategori->total;    
                                                                
                                                                $sisa = DB::table('transaksi')
                                                                ->where('status','1')
                                                                ->sum('nominal');                                    
                                                              ?>
                                                            {{ "Rp. ".number_format($total)." ," }}
                                                            @endforeach
                                                          </td> -->


                                                          @if(Auth::user()->level == 'admin')
                                                          <td class="text-center col-md-1">    
                                                            <a href="{{route('kategori.edit', $k->id)}}" class="btn btn-secondary btn-sm col-md-2 text-center">
                                                              <i class="fas fa-edit  text-center"></i>
                                                            </a>
                                                            <a  data-toggle="modal" data-target="#modalDelete_{{ $k->id }}" class="btn btn-danger btn-sm col-md-2 text-center">
                                                              <i class="fas fa-trash  text-center"></i>
                                                            </a>
                                                          
                                                            <!-- Modal -->
                                                            <form method="POST" action="{{ route('kategori.destroy',['id' => $k->id]) }}">
                                                              <div class="modal fade" id="modalDelete_{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                                                  <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header  bg-danger">
                                                                        <h4 class="modal-title">Peringatan</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                      {{ csrf_field() }}
                                                                                      {{ method_field('delete') }}

                                                                                      <p>Apakah anda yakin ingin menghapus data kategori kategori <b>{{$k->kategori}}</b> ?</p>
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

            <!-- TUTUP TABEL -->

      </div>
    </div><!-- /.container-fluid -->

  </section>




  <!-- MODAL FILTER -->
  <div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-white">
 
          <div class="modal-header">
            <h4 class="modal-title" id="modal-title-notification">Filter Tanggal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
 
          <div class="modal-body">
            
          <form method="GET" action="{{ route('kategori_filter') }}">
                    {{ csrf_field() }}


                    <div class="box-body">
                    

                                            
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
                          <label>Cari Kategori</label>
                          <select class="form-control" name="kategori">
                          <option value="">SEMUA KATEGORI RUTIN</option>
                            @foreach($kategoris as $k)
                            <option <?php 
                            if(isset($_GET['kategori']))
                            { if($_GET['kategori'] == $k->id){echo "selected='selected'";} } ?> value="{{ $k->id }}">{{ $k->kategori }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
                                                                <!-- <label for="kategori" class="col-md-12 control-label">Nama Detail Kategori  <b style="color:Tomato;">*</b> </label> -->
                                                                <div class="col-md-12">
                                                                    <input id="kategori" type="hidden" class="form-control" name="kategori" value="" >
                                                            
                                                                    
                                                                    @if ($errors->has('kategori'))
                                                                        <span class="help-block text-danger">
                                                                            <strong>{{ $errors->first('kategori') }}</strong>
                                                                        </span>
                                                                    @endif

                                                                </div>
                      </div>
      
                      <div class="form-group col-md-12 ">
                        <div class="form-group float-right">
                            <input type="submit" class="btn btn-success" value="Tampilkan" style="margin-top: 25px col-md-5">
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
        })
 
    })
</script>
 
@endsection

