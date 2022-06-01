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
                                                      <a href="{{ route('ibadah.create') }}"  type="button" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                                    </div>

                                                    <!-- <div class="btn-group">
                                                      <button  data-toggle="modal" data-target="#modal-filter"  type="button" class="btn btn-success">
                                                      <i class="fas fa-filter  text-center"></i>
                                                      </button>
                                                    </div> -->
                                            
                                                    <div class="btn-group">
                                                      <a  href="{{route('ibadah.index')}}" type="button" class="btn btn-warning">
                                                      <i class="fas fa-undo"></i>
                                                      </a>
                                                    </div>
                                              
                                                    <ol class="breadcrumb float-sm-right">
                                                      <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                                      <li class="breadcrumb-item active">Ibadah</li>
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
                                  <a class="close" data-dismiss="alert" class="btn btn-danger btn-sm" ><i style="color:red" class="fas fa-times"></i></a>  
                                </button>
                              </div>
          
                      </div>
                    </section>
                  @endif

   
                  @if(isset ($_GET['ibadah']))
                    <section class="content-header">
                      <div class="container-fluid">
                          
                                        <div class="card">

                                          <div class="card-header pt-4">
                                            <h3 class="card-title">Laporan Keuangan Per Ibadah</h3>
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
                                                                  <th width="175">IBADAH</th>
                                                                  <th width="2%" class="text-left">:</th>
                                                                  <td  class="text-left">
                                                                    @php
                                                                    $id_ibadah = $_GET['ibadah'];
                                                                    @endphp

                                                                    @if($id_ibadah == "")
                                                                      @php
                                                                      $kat = "SEMUA IBADAH";
                                                                      @endphp
                                                                    @else
                                                                      @php
                                                                        $katt = DB::table('ibadah')->where('id',$id_ibadah)->first();
                                                                        $kat = $katt->ibadah
                                                                      @endphp
                                                                    @endif
                                                          
                                                                    {{$kat}}
                                                                  </td>
                                                              </tr>

                                                              <tr>
                                                                <th width="175">KAS</th>
                                                                <th width="2%" class="text-left">:</th>
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
                                                            <th class="text-center">IBADAH</th>
                                                            <th class="text-center">KATEGORI</th>
                                                            <th class="text-center">KAS</th>
                                                            <th class="text-center">KETERANGAN</th>                                 
                                                            <th class="text-center">NOMINAL</th>
                                                          </tr>
                                                        </thead>

                                                        <tbody>
                                                              @php
                                                              $no = 1;
                                                              $total_pemasukan_rutin = 0;
                                                              $total_pemasukan_khusus = 0;
                                                              $total_pengeluaran = 0;
                                                              @endphp

                                                              @foreach($pemasukan_rutin as $t)
                                                              
                                                              <tr>
                                                                    <td class="text-center">{{ $no++ }}</td>

                                                                    <td class="text-left">{{ $t->kode_pemasukan_rutin }}</td>

                                                                    <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>

                                                                    <td class="text-left">{{ $t->nama_ibadah->ibadah }}</td>
                                                                    <td>{{ $t->detail_kategori->kategori }}</td>
                                                                    <td>{{ $t->kas->kas }}</td>

                                                                    @if($t->keterangan  == null)
                                                                          <td class ="text-center"> -</td>
                                                                    @else
                                                                          @if($t->jenis  == "Pengeluaran")
                                                                            <td> 
                                                                              <b  style="color:red"><i>{{ $t->keterangan }}</i></b>
                                                                            </td>
                                                                          @else
                                                                          <td> 
                                                                              <i>{{ $t->keterangan }}</i>
                                                                            </td> 
                                                                          @endif
                                                                    @endif
                                                                    
                                                                    <td class="text-right">                              
                                                                      {{ "Rp.".number_format($t->nominal).",-" }}
                                                                      @php $total_pemasukan_rutin += $t->nominal; @endphp
                                                                    </td>
                                                                  </tr>
                                                                
                                                              @endforeach

                                                              @foreach($pemasukan_khusus as $t)
                                                                <tr>
                                                                  <td class="text-center">{{ $no++ }}</td>
                                                                  <td class="text-left">{{ $t->kode_pemasukan_khusus }}</td>
                                                                  <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                                                                  <td class="text-left">{{ $t->nama_ibadah->ibadah }}</td>
                                                                  <td class="text-left">{{ $t->detail_kategori->kategori }}</td>
                                                                  <td class="text-left">{{ $t->kas->kas }}</td>
                                                                  @if($t->keterangan  == null)
                                                                          <td class ="text-center"> -</td>
                                                                    @else
                                                                          @if($t->jenis  == "Pengeluaran")
                                                                            <td> 
                                                                              <b  style="color:red"><i>{{ $t->keterangan }}</i></b>
                                                                            </td>
                                                                          @else
                                                                          <td> 
                                                                              <i>{{ $t->keterangan }}</i>
                                                                            </td> 
                                                                          @endif
                                                                    @endif
                                                                    <td class="text-right">  {{ "Rp.".number_format($t->nominal).",-" }}</td>
                                                                      @php $total_pemasukan_khusus += $t->nominal; @endphp
                                                                    <td class="text-left"></td>
                                                                </tr>
                                                              @endforeach
                                                        </tbody>

                                                        <tfoot class="bg-info text-white font-weight-bold">
                                                            <tr>
                                                              <td colspan="6" class="text-bold text-left bg-secondary">TOTAL PEMASUKAN </td>
                                                              <td class="bg-primary"></td>
                                                              <td class="text-right bg-primary">{{ "Rp.".number_format($total_pemasukan_rutin += $total_pemasukan_khusus).",-" }}</td>
                                                              
                                                              
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
                                    <h3 class="card-title">Data Ibadah</h3>
                                  </div>

                                  <div class=" table-responsive col-md-12 col-sm-6 col-12">
                                            <table id="example1" class="table table-striped">
                                                <thead> 
                                                  <tr>
                                                  <th width="1%">NO</th>
                                                  @if(Auth::user()->level == 'admin')
                                                                            <th class="text-center col-md-1" >CONFIRM </th>
                                                                            @endif
                                                  <th class="text-center">KODE</th>
                                                  <th class="text-center">IBADAH</th>
                                                  <th class="text-center">JAM</th>
                                                  <th class="text-center">KETERANGAN</th>
                                                  <th class="text-center">STATUS</th>
                                                  <th class="text-center">UPDATED</th>
                                                  @if(Auth::user()->level == 'admin')
                                                  <th class="text-center col-md-2" width="10%">OPSI</th>
                                                  @endif
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  @php
                                                  $no = 1;
                                                  @endphp
                                                  @foreach($ibadah as $k)
                                                  <tr>
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    @if(Auth::user()->level == 'admin')
                                                                              <td>
                                                                                  @if($k->status == '1')
                                                                                  <a href="{{ url('ibadah/status/'.$k->id) }}" class="btn btn-sm btn-danger">PRIVATE</a>
                                                                                  @else
                                                                                  <a href="{{ url('ibadah/status/'.$k->id) }}" class="btn btn-sm btn-success">PUBLIC</a>
                                                                                  @endif
                                                                              </td>
                                                                              @endif
                                                    <td class="text-left">{{ $k->kode_ibadah }}</td>                    
                                                    <td>{{ $k->ibadah }}</td>
                                                    <td class="text-center">{{ $k->jam }}</td>
                                                    @if($k->keterangan  == null)
                                                          <td class =" text-center">-</td>
                                                          @else
                                                          <td>{{ $k->keterangan }}</td>
                                                    @endif
                                                    <td  class="text-center">
                                                                                @if($k->status == '1')
                                                                                  <i class="fa fa-check-square" style="color:green" ></i>
                                                                                @else
                                                                                  <i class="fa fa-times" style="color:red"></i>
                                                                                @endif
                                                    </td>



                                                    <td class="text-left">{{ $k->updated_at->diffForHumans() }}</td>
                                                  
                                                    @if(Auth::user()->level == 'admin')
                                                      <td class="text-center col-md-1">    

                                                        <a href="{{route('ibadah.edit', $k->id)}}" class="btn btn-secondary btn-sm col-md-2 text-center">
                                                          <i class="fas fa-edit  text-center"></i>
                                                        </a>
                                                        <a  data-toggle="modal" data-target="#modalDelete_{{ $k->id }}" class="btn btn-danger btn-sm col-md-2 text-center">
                                                          <i class="fas fa-trash  text-center"></i>
                                                        </a>
                                                        
                                                        <form action="{{ route('ibadah.destroy', $k->id)}}" method="post">
                                                              <div class="modal fade" id="modalDelete_{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                    <div class="modal-header  bg-danger">
                                                                      <h4 class="modal-title">Peringatan</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    {{ csrf_field() }}
                                                                                    {{ method_field('delete') }}

                                                                                    <p>Apakah anda yakin ingin menghapus data <b>{{$k->kode_ibadah}} - {{$k->ibadah}}</b> ?</p>

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
            <h4 class="modal-title" id="modal-title-notification">Filter Ibadah</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
 
          <div class="modal-body">
            
                <form method="GET" action="{{ route('ibadah_filter') }}">
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
                            <label>Cari Ibadah</label>
                            <select class="form-control" name="ibadah">
                            <!-- <option value="">-- SEMUA IBADAH --</option> -->
                              @foreach($ibadah as $k)
                              <option <?php 
                              if(isset($_GET['ibadah']))
                              { if($_GET['ibadah'] == $k->id){echo "selected='selected'";} } ?> value="{{ $k->id }}">{{ $k->ibadah }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="form-group col-md-12">
                          <div class="form-group">
                            <label>Cari Kas</label>
                            <select class="form-control" name="kas">
                            <!-- <option value="">-- SEMUA KAS --</option> -->
                              @foreach($kas as $k)
                              <option <?php if(isset($_GET['kas'])){ if($_GET['kas'] == $k->id){echo "selected='selected'";} } ?> value="{{ $k->id }}">{{ $k->kas }}</option>
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
