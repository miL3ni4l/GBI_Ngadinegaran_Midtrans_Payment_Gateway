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


      </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active"><a href="/detail_kategori">Kategori Pemasukan</a></li>
              <li class="breadcrumb-item active">{{$details->kategori}}</li>
            </ol>
          </div>
          


     
          <div class=" table-responsive col-md-12 col-sm-6 col-12">
          
            
             <!--area ditambah-->   
<!--area diisi-->         
          <div class="card card-secondary">
            <div class="card-body">
            <div class="col-md-12">
          <div class="card card-primary card-outline">
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">

                <h5>Kategori Pemasukan <b>{{$details->kategori}} 
          
                   
             
                </b>
                  <span class="mailbox-read-time float-right">{{ $details->updated_at->diffForHumans() }}</span></h6>
                </h5>
               
               
              </div>

              <!-- /.mailbox-read-info -->
              <!-- <div class="mailbox-controls with-border text-center"> -->
                <!-- <div class="btn-group">
                <button type="button" class="btn btn-default"><i class="far  fa-edit "></i> Edit</button>  
                </div> -->
                <!-- /.btn-group -->
                <!-- <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Hapus</button>  
              </div> -->

              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <!-- <p>Hello <b><i>{{Auth::user()->name}}</i></b>,</p> -->

                    
                                                        <!-- <td>
                                                          @php
                                                          $nmr = 1;
                                                          @endphp
                                                            @foreach ($details->detail_kategori as $dk)
                                                            <ol>
                                                          
                                                               {{ $nmr++ }}. {{$dk->kode_kategori}} - {{$dk->kategori}} 
                                                            </ol>
                                                                                           
                                                            @endforeach
                                                        </td>
                                                         -->
         
              </div>

                 <!--area diisi-->
                 <table class="table table-striped" id="example1">
                                        <thead>
                                        <tr>
                                                    <th width="1%">NO</th>
                                                    <th class="text-center">KODE</th>
                                                    @if(Auth::user()->level == 'admin')
                                                    <th class="text-center">PETUGAS</th>
                                                    @endif
                                                    <th class="text-center">KATEGORI</th>                                                         
                                                    <th class="text-center">DETAIL KATEGORI</th>
                                                    
                                                    <th class="text-center">KETERANGAN</th>

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
                                                      @foreach ($details->detail_kategori as $k)
                                                      <tr>
                                                        <td class="text-left">{{ $no++ }}</td>
                                                        <td class="text-left" >
                                                      
                                                                      <a class="text-blue"> 
                                                                                    <b>                           
                                                                                      {{ $k->kode_kategori }}
                                                                                    </b>
                                                                                  
                                                                      </a> 
                                                          </td>
                                                          @if(Auth::user()->level == 'admin')
                                                          <td>{{ $k->petugas->nama }}</td>  
                                                          @endif
                                                          <td>{{ $k->nama_kategori->kategori }}</td>                
            
                                                          <td>{{ $k->kategori }}</td> 
                                                      

                                                          @if($k->keterangan  == null)
                                                                <td class ="text-danger text-center"> Tidak Ada Keterangan !!!</td>
                                                                @else
                                                                <td>{{ $k->keterangan }}</td>
                                                          @endif

                                                          <td class="text-left">{{ $k->updated_at->diffForHumans() }}</td>
                                                          
                            
                                                          
                                                          @if(Auth::user()->level == 'admin')
                                                          <td class="text-center col-md-1">    
                                                            <a href="{{route('detail_kategori.edit', $k->id)}}" class="btn btn-secondary btn-sm col-md-2 text-center">
                                                              <i class="fas fa-edit  text-center"></i>
                                                            </a>
                                                            <a  data-toggle="modal" data-target="#modalDelete_{{ $k->id }}" class="btn btn-danger btn-sm col-md-2 text-center">
                                                              <i class="fas fa-trash  text-center"></i>
                                                            </a>
                                                          
                                                            <!-- Modal -->
                                                            <form method="POST" action="{{ route('detail_kategori.destroy',['id' => $k->id]) }}">
                                                              <div class="modal fade" id="modalDelete_{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                                                  <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header  bg-danger">
                                                                        <h4 class="modal-title">Peringatan</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                      {{ csrf_field() }}
                                                                                      {{ method_field('delete') }}

                                                                                      <p>Apakah anda yakin ingin menghapus data kategori <b>{{$k->kategori}}</b> ?</p>
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
          <!-- /.card -->
        </div>
            </div>
          </div>
                              
</div>
</div>

        


        </div>
      </div><!-- /.container-fluid -->
    </section>

@endsection


