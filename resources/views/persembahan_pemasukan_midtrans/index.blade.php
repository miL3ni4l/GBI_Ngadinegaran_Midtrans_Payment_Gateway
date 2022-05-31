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
                                      <a  href="/persembahan_pemasukan_midtrans" type="button" class="btn btn-warning">
                                      <i class="fas fa-undo"></i>
                                      </a>
              </div>
              <div class="btn-group">
                                      <button  data-toggle="modal" data-target="#modal-filter"  type="button" class="btn btn-success">
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
                        
    <div class="content-header">
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
    </div>

    @if(isset ($_GET['kategori']))
                      <section class="content-header">
                        <div class="container-fluid">
                          <div class="card">

                                            <div class="card-header pt-4">
                                              <h3 class="card-title">Filter Kategori Pengeluaran</h3>
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
                                                                  <td  class="text-left">{{ date('d-m-Y',strtotime($_GET['dari'])) }}</td>
                                                                </tr>
                                                              
                                                                <tr >
                                                                  <th width="175">SAMPAI TANGGAL</th>
                                                                  <th width="2%" class="text-left">:</th>
                                                                  <td class="text-left">{{ date('d-m-Y',strtotime($_GET['sampai'])) }}</td>
                                                                </tr> 
                                                                
                                                                <tr>
                                                                  <th width="175">KATEGORI</th>
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


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Data Midtrans Payment</h3>
                    </div>
                    <div class="card">
                    </div>

                    <div class=" table-responsive col-md-12 col-sm-12 col-12">
                      <table  id="example1" class="table table-striped">
                          <thead> 
                          <tr>
                          <th width="1%">NO</th>
                          <th class="text-center">KODE</th>
                          <th class="text-center">TANGGAL</th>
                          <th class="text-center">NAMA</th>
                          <th class="text-center">EMAIL</th>
                          <th class="text-center">JENIS</th>
                          <th class="text-center">NOMINAL</th>
                          <th class="text-center" >STATUS</th>
                          <th class="text-center" >UPDATE</th>

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
                            
                                                              @if($k->status  == 'success')
                                                                <span class="badge bg-success col-md-8">{{ $k->status }}</span>
                                                              @elseif($k->status  == 'failed')
                                                                <span class="badge bg-danger col-md-8">{{ $k->status }}</span>    
                                                              @elseif($k->status  == 'pending')
                                                                <span class="badge bg-warning col-md-8">{{ $k->status }}</span>    
                                                              @else($k->status  == 'expired')
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
                                          <input class="form-control datepicker2"  value="{{ date('Y-m-d') }}" placeholder="Dari Tanggal" type="date" required="required" name="dari" value="<?php if(isset($_GET['dari'])){echo $_GET['dari'];} ?>">
                                        </div>
                                      </div>

                                      <div class="form-group col-md-12">
                                        <div class="form-group">
                                          <label>Sampai Tanggal</label>
                                          <input class="form-control datepicker2"  value="{{ date('Y-m-d') }}"  placeholder="Sampai Tanggal" type="date" required="required" name="sampai" value="<?php if(isset($_GET['sampai'])){echo $_GET['sampai'];} ?>">
                                        </div>
                                      </div>

                                      <div class="form-group col-md-12">
                                        <div class="form-group">
                                          <label>Cari Kategori</label>
                                          <select class="form-control" name="kategori">
                                          <option value="">-- SEMUA KATEGORI --</option>
                                            @foreach($kategori as $k)
                                            <option 
                                            <?php 
                                            if(isset($_GET['kategori']))
                                            { if($_GET['kategori'] == $k->id){echo "selected='selected'";} } ?> value="{{ $k->id }}">{{ $k->kategori }}
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
