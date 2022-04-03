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
                                    <a href="{{ route('pengeluaran_rutin.create') }}"  type="button" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                  </div>
                              
                                  <div class="btn-group">
                                    <button  data-toggle="modal" data-target="#modal-filter"  type="button" class="btn btn-success">
                                    <i class="fas fa-filter  text-center"></i>
                                    </button>
                                  </div>

                                  <div class="btn-group">
                                    <a href="{{ route('konfirmasi_rutin') }}" type="button" class="btn btn-danger">
                                      <i class="fas fa-inbox"></i>
                                    </a> 
                                  </div>

                                  <div class="btn-group">
                                    <a   href="{{ route('pengeluaran_rutin.index') }}"  type="button" class="btn btn-warning">
                                    <i class="fas fa-undo"></i>
                                    </a>
                                  </div>
                             
                              <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                <li class="breadcrumb-item active">Pengeluaran Rutin</li>
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

                  @if(isset ($_GET['kategori_pengeluaran']))
                    <section class="content-header">
                      <div class="container-fluid">
                                        <div class="card">
                                          <div class="card-header pt-4">
                                            <h3 class="card-title">Filter Pengeluaran Rutin</h3>
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
                                                                          <td class="text-left">
                                                                            @php
                                                                              $id_kategori = $_GET['kategori_pengeluaran'];
                                                                              @endphp

                                                                              @if($id_kategori == "")
                                                                                @php
                                                                                $kat = "SEMUA KATEGORI PENGELUARAN";
                                                                                @endphp
                                                                              @else
                                                                                @php
                                                                                  $katt = DB::table('detail_pengeluaran')->where('id',$id_kategori)->first();
                                                                                  $kat = $katt->kategori
                                                                                @endphp
                                                                            @endif
                                                                            {{$kat}}
                                                                          </td>
                                                              </tr>
                                                              <tr>
                                                                <th width="175">KAS</th>
                                                                <th width="2%" class="text-left">:</th>
                                                                          <td class="text-left">
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
                                                        <th class="text-center">DARI KATEGORI</th>
                                                        <th class="text-center">KATEGORI</th>
                                                        <th class="text-center">KAS</th>
                                                        
                                                        
                                                        <th class="text-center">KETERANGAN</th>
                                                        
                                                        <th class="text-center">NOMINAL</th>

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

                                                            <td class="text-left">{{ $t->kode_pemasukan_rutin }}</td>

                                                            <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                                                            <td>{{ $t->nama_kategori->kategori }}</td>
                                                            <td>{{ $t->kategori_pengeluaran->kategori }}</td>
                                                            <td>{{ $t->kas->kas }}</td>
                                                            


                                                          

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
                                                      <td colspan="7" class="text-bold text-left bg-secondary">TOTAL PEMASUKAN </td>
                                                      <td class="text-right bg-primary"><b>{{ "Rp.".number_format($total_pemasukan).",-" }}</b></td>
                                                      <td class="text-left bg-primary"></td>
                                                      
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
                                    <h3 class="card-title">Data Pengeluaran Rutin</h3>
                                  </div>

                                  <div class="card">
                                  </div>
                                  
                                  <!-- BUKA TABEL -->
                                  <div class=" table-responsive col-md-12 col-sm-6 col-12">
                                      <!--area diisi-->
                                    <table class="table table-striped" id="example1">
                                                      <thead>
                                                        <tr>
                                                          <th width="1%">NO</th>
                                                          @if(Auth::user()->level == 'admin')
                                                          <th class="text-center col-md-1" >CONFIRM </th>
                                                          @endif
                                                          <th class="text-center col-md-1" >KODE</th>
                                                          <th class="text-center" >TANGGAL</th>
                                                          <th class="text-center col-md-2" >DARI KATEGORI</th>
                                                          <th class="text-center col-md-2" >KATEGORI</th>
                                                          <th class="text-center col-md-1" >KAS</th>
                                                          <th class="text-center col-md-2 ">NOMINAL</th>
                                                          <th class="text-center ">STATUS</th>
                                                          <th class="text-center ">UPDATE</th>
                                                          <th class="text-center col-md-2">OPSI</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        @php
                                                        $no = 1;
                                                        @endphp
                                                        @foreach($pemasukan_rutin as $t)
                                                        <tr>
                                                          <td class="text-center">{{ $no++ }}</td>
                                                          @if(Auth::user()->level == 'admin')
                                                          <td>
                                                              @if($t->status == '1')
                                                              <a href="{{ url('pengeluaran_rutin/status/'.$t->id) }}" class="btn btn-sm btn-danger">BELUM</a>
                                                              @else
                                                              <a href="{{ url('pengeluaran_rutin/status/'.$t->id) }}" class="btn btn-sm btn-success">SUDAH</a>
                                                              @endif
                                                          </td>
                                                          @endif
                                                          <td class="text-left" >
                                                                                        
                                                                                  {{ $t->kode_pemasukan_rutin }}

                                                          </td>
                                                          <td class="text-center">
                                                          {{$t->tanggal->format('d-M-y')}}
                                                          </td>                     
                                                          <td  class="text-left"> {{ $t->nama_kategori->kategori }}</td>
                                                          <td  class="text-left"> {{ $t->kategori_pengeluaran->kategori }}</td>
                                                          <td class="text-left">{{ $t->kas->kas }}</td>                                     
                                                          <td class="text-right">
                                                          
                                                            {{ "Rp.".number_format($t->nominal ).",-" }}
                                                          
                                                          </td>
                                                          <td  class="text-center">
                                                            @if($t->status == '1')
                                                              <i class="fa fa-check-square" style="color:green" ></i>
                                                            @else
                                                              <i class="fa fa-times" style="color:red"></i>
                                                            @endif
                                                            <!-- {{ $t->keterangan }} -->
                                                          </td>
                                                          <td class="text-left">{{ $t->updated_at->diffForHumans() }}</td>
                                                          <td class="text-left col-md-1">   

                                                              @if($t->status == '1')
                                                              <a href="{{route('pengeluaran_rutin.show', $t->id)}}" class="btn btn-info btn-sm  text-center" tooltip >
                                                                  <i class="fa fa-eye text-center"></i>
                                                              </a>
                                                              <a href="{{ route('pengeluaran_rutin.laporan', $t->id) }}" class="btn btn-success btn-sm  text-center" tooltip >
                                                                <i class="fa fa-download text-center"></i>
                                                              </a>  
                                                              @endif                    
                                                                
                                                              
                                                              @if($t->status == '0')
                                                                <a href="{{route('pengeluaran_rutin.show', $t->id)}}" class="btn btn-info btn-sm  text-center" tooltip >
                                                                  <i class="fa fa-eye text-center"></i>
                                                                </a>      
                                                                <a href="{{route('pengeluaran_rutin.edit', $t->id)}}" class="btn btn-secondary btn-sm text-center">
                                                                  <i class="fas fa-edit  text-center"></i> 
                                                                </a>
                                                                <a  data-toggle="modal" data-target="#modalDelete_{{ $t->id }}" class="btn btn-danger btn-sm text-center">
                                                                  <i class="fas fa-trash  text-center"></i>
                                                                </a>
                                                              @endif
                                                                
                                                      

                                      
                                                                      
                                                                      <!-- Modal -->
                                                                      <form action="{{ route('pengeluaran_rutin.destroy', $t->id)}}" method="post">
                                                                        <div class="modal fade" id="modalDelete_{{ $t->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">

                                                                              <div class="modal-header bg-danger">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>

                                                                              <div class="modal-body">


                                                                              {{ csrf_field() }}
                                                                                {{ method_field('delete') }}

                                                                                <p>Apakah anda yakin ingin menghapus data <b>{{$t->kode_pemasukan_rutin}}</b> ?</p>

                                                                              </div>

                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                                                                                
                                                                                
                                                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash m-r-5"></i> Hapus</button>
                                                                                                      
                                                                                </div>
                                                                        

                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </form>
                                                              

                                                          </td>
                                                        
                                                        
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
            <h4 class="modal-title" id="modal-title-notification">Filter Pengeluaran Rutin</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
 
          <div class="modal-body">
            
                <form method="GET" action="{{ route('periode_rutin') }}">                                         
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
                          <label>Kategori Pengeluaran</label>
                          <select class="form-control" name="kategori_pengeluaran">
                          <!-- <option value="">-- SEMUA KATEGORI --</option> -->
                            @foreach($kategori_pengeluaran as $k)
                            <option 
                            <?php 
                            if(isset($_GET['kategori_pengeluaran']))
                            { if($_GET['kategori_pengeluaran'] == $k->id){echo "selected='selected'";} } ?> value="{{ $k->id }}">{{ $k->kategori }}
                            </option>
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

