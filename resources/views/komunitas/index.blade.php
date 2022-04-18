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
                                      <a href="{{ route('komunitas.create') }}"  type="button" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                    </div>

                                    <div class="btn-group">
                                      <button  data-toggle="modal" data-target="#modal-filter"  type="button" class="btn btn-success">
                                      <i class="fas fa-filter  text-center"></i>
                                      </button>
                                    </div>
                            
                                    <div class="btn-group">
                                      <a  href="{{route('komunitas.index')}}" type="button" class="btn btn-warning">
                                      <i class="fas fa-undo"></i>
                                      </a>
                                    </div>
                              
                                <ol class="breadcrumb float-sm-right">
                                  <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                  <li class="breadcrumb-item active">komunitas</li>
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

   

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
              
                  <div class="card-header">
                    <h3 class="card-title">Data komunitas</h3>
                  </div>

                  <div class="card">
                  </div>

                  <div class=" table-responsive col-md-12 col-sm-6 col-12">
                            <table id="example1" class="table table-striped">
                                <thead> 
                                  <tr>
                                  <th width="1%">NO</th>
                                  @if(Auth::user()->level == 'admin')
                                                            <th class="text-center col-md-1" >CONFIRM </th>
                                                            @endif
                                
                                  <th class="text-center">KOMUNITAS</th>
                                  <th class="text-center">PJ</th>
                                  <th class="text-center">DESKRIPSI</th>
                                  <th class="text-center">KONTAK</th>
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
                                @foreach($komunitas as $k)
                                <tr>
                                  <td class="text-center">{{ $no++ }}</td>
                                  @if(Auth::user()->level == 'admin')
                                                            <td>
                                                                @if($k->status == '1')
                                                                <a href="{{ url('komunitas/status/'.$k->id) }}" class="btn btn-sm btn-danger">NON AKTIF</a>
                                                                @else
                                                                <a href="{{ url('komunitas/status/'.$k->id) }}" class="btn btn-sm btn-success">AKTIF</a>
                                                                @endif
                                                            </td>
                                                            @endif
                                      
                                  <td>{{ $k->nama_komunitas }}</td>
                                  <td class="text-center">{{ $k->pj }}</td>
                                  <td class="text-left  ">{{ $k->deskripsi }}</td>
                                  <td class="text-center">{{ $k->kontak }}</td>
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

                                      <a href="{{route('komunitas.edit', $k->id)}}" class="btn btn-secondary btn-sm col-md-2 text-center">
                                        <i class="fas fa-edit  text-center"></i>
                                      </a>
                                      <a  data-toggle="modal" data-target="#modalDelete_{{ $k->id }}" class="btn btn-danger btn-sm col-md-2 text-center">
                                        <i class="fas fa-trash  text-center"></i>
                                      </a>
                                      
                                      <form action="{{ route('komunitas.destroy', $k->id)}}" method="post">
                                            <div class="modal fade" id="modalDelete_{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header  bg-danger">
                                                    <h4 class="modal-title">Peringatan</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                  {{ csrf_field() }}
                                                                  {{ method_field('delete') }}

                                                                  <p>Apakah anda yakin ingin menghapus data <b>{{$k->nama_komunitas}}</b> ?</p>

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
            <h4 class="modal-title" id="modal-title-notification">Filter komunitas</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
 
          <div class="modal-body">
            
          <form method="GET" action="{{ route('komunitas_filter') }}">
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
                            <label>Cari komunitas</label>
                            <select class="form-control" name="komunitas">
                            <!-- <option value="">-- SEMUA komunitas --</option> -->
                              @foreach($komunitas as $k)
                              <option <?php 
                              if(isset($_GET['komunitas']))
                              { if($_GET['komunitas'] == $k->id){echo "selected='selected'";} } ?> value="{{ $k->id }}">{{ $k->komunitas }}</option>
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
