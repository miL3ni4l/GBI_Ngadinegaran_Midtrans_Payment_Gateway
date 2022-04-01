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
              <div class="col-sm-12">
                    <div class="col-sm-12">
                  
                    <a  data-toggle="modal" data-target="#modal-filter" class="btn btn-success btn-fw col-lg-1">
                                      <i class="fas fa-filter  text-center"></i> Filter
                                    </a>

                              
                    &nbsp    
                    <a href="{{route('riwayat.index')}}" class="btn btn-warning btn-filter  btn-fw col-lg-1"><i class="fas fa-undo"></i> Refresh</a> 
                    
                    
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="/home">Home</a></li>
                      <li class="breadcrumb-item active">Riwayat Transaksi</li>
                      </ol>
                    </div>
              </div>  
                    &nbsp    
          </div> 
 

   
          @foreach($transaksi as $t)
   
                  @if($t->jenis == 'Pemasukan') 
                  <div class="col-md-12 col-sm-12 col-12">
                        <div class="info-box bg-light">
                  
                          <div class="info-box-content">
                            
                            <div class="user-block">
                              
                                      @if(Auth::user()->foto == '')
                                          <img src="{{asset('images/user/default.png')}}" alt="profile image">
                                      @else
                                          <img src="{{asset('images/user/'. Auth::user()->foto)}}" alt="profile image">
                                      @endif
                                      <span class="username">
                                        <a href="{{route('riwayat.show', $t->id)}}">{{ $t->detail_kategori->petugas->user['name'] }} 
                                        @if($t->status == '1')
                                          <i class="fa fa-check-square" style="color:green" ></i>
                                        @else
                                          <i class="fa fa-times" style="color:red"></i>
                                        @endif
                                        </a>
                                      </span>
                                      <span class="description">
                                      <a  class="link-black text-sm"> <i class="fas fa-calendar-alt"></i> {{ date('d-M-Y', strtotime($t->tanggal )) }}</a>  
                                     
                                    </span>
                                    
                            </div>
                                  
                          
                            <div class="progress">
                              <div class="progress-bar bg-success" style="width: 100%"></div>
                            </div>
                            <p>
                                [{{ $t->kode_transaksi }}] - Transaksi ini dilakukan pada tanggal <b>{{ date('d-M-Y', strtotime($t->tanggal )) }} </b> dengan kategori transaksi <b> {{ $t->detail_kategori->kategori }} </b> &  dimasukan dalam <b>{{ $t->kas->kas }}</b>.      
                                      {{ $t->keterangan}}
                            </p>
                            
                            <p>
                            <a  class="link-black text-sm"> <i class="fas fa-clock"></i> {{ $t->created_at->diffForHumans() }}</a>
                                  </p>
                          </div>
                      </div>
                  </div>  
                  @else
                  <div class="col-md-12 col-sm-12 col-12">
        
                        <div class="info-box">
                  
                        <div class="info-box-content">
                          
                        <div class="user-block">
                          
                                  @if(Auth::user()->foto == '')
                                      <img src="{{asset('images/user/default.png')}}" alt="profile image">
                                  @else
                                      <img src="{{asset('images/user/'. Auth::user()->foto)}}" alt="profile image">
                                  @endif
                                  <span class="username">
                                  <a href="{{route('riwayat.show', $t->id)}}">{{ $t->detail_kategori->petugas->user['name'] }}
                                        @if($t->status == '1')
                                          <i class="fa fa-check-square" style="color:green" ></i>
                                        @else
                                          <i class="fa fa-times" style="color:red"></i>
                                        @endif
                                  </a>
                                  </span>
                                  <span class="description">
                                  <a  class="link-black text-sm"> <i class="fas fa-calendar-alt"></i> {{ date('d-M-Y', strtotime($t->tanggal )) }}</a>  
                                  </span>
                                
                                </div>
                                
                        
                          <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 100%"></div>
                          </div>
                          <p>
                          [{{ $t->kode_transaksi }}]  Transaksi ini dilakukan pada tanggal <b>{{ date('d-M-Y', strtotime($t->tanggal )) }} </b> dengan kategori transaksi <b> {{ $t->detail_kategori->kategori }} </b> &  dimasukan dalam <b>{{ $t->kas->kas }}</b>.      
                                    {{ $t->keterangan}}
                          </p>
                          
                          <p>
                            
                                  <a  class="link-black text-sm"> <i class="fas fa-clock"></i> {{ $t->created_at->diffForHumans() }}</a>
                                </p>
                        </div>
                      </div>
                  </div>
                  @endif             

          @endforeach

    </div>
  </div>




  <!-- MODAL FILTER -->
  <div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-white">
 
          <div class="modal-header">
            <h4 class="modal-title" id="modal-title-notification">Filter Riwayat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
 
          <div class="modal-body">
            
          <form method="GET" action="{{ route('period') }}">
                    {{ csrf_field() }}


                    <div class="box-body">
                    

                                            
                      <div class="form-group col-md-12">
                        <div class="form-group">
                          <label>Dari Tanggal</label>
                          <input class="form-control datepicker2" value="{{ date('Y-m-d') }}"placeholder="Dari Tanggal" type="date" required="required" name="dari" value="<?php if(isset($_GET['dari'])){echo $_GET['dari'];} ?>">
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div class="form-group">
                          <label>Sampai Tanggal</label>
                          <input class="form-control datepicker2" value="{{ date('Y-m-d') }}" placeholder="Sampai Tanggal" type="date" required="required" name="sampai" value="<?php if(isset($_GET['sampai'])){echo $_GET['sampai'];} ?>">
                        </div>
                      </div>


                       
                      @if(Auth::user()->level == 'admin')
                      <div class="form-group col-md-12">
                        <div class="form-group">
                          <label>Cari Petugas</label>
                          <select class="form-control" name="user">
                            <option value="">SEMUA PETUGAS</option>
                            @foreach($user as $p)
                            <option <?php 
                            if(isset($_GET['user']))
                            { if($_GET['user'] == $p->id){echo "selected='selected'";} } ?> value="{{ $p->id }}"> {{ $p->nama}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      @else
               
                      <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">                                    
                                                    <div class="col-md-12">
                                                        <input  type="hidden" class="form-control" name="user" value="" readonly="">
                                                        @if ($errors->has('user'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('user') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                       </div>
                      @endif


                             

                     
                    </div>
                    <!-- /.box-body -->
      
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


