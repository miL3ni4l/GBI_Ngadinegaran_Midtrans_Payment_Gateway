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
                                    <a href="{{ route('user.create') }}"  type="button" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                  </div>

                                  <div class="btn-group">
                                    <a   href="{{route('user.index')}}"  type="button" class="btn btn-warning">
                                    <i class="fas fa-undo"></i>
                                    </a>
                                  </div>
                             
                              <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                <li class="breadcrumb-item active">Akun</li>
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

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
              
                  <div class="card-header">
                    <h3 class="card-title">Data Akun</h3>
                  </div>

                  <div class="card">
                  </div>

                  <div class=" table-responsive col-md-12 col-sm-6 col-12">
                    <table class="table table-striped" id="example1">
                                                          <thead>
                                                          <tr>
                                                            <th width="1%">NO</th>
                                                            <th class="text-center col-md-1" width="11%">NAMA</th>
                                                            <th class="text-center col-md-1" width="11%">LEVEL</th>
                                                            <th class="text-center col-md-1">USERNAME</th>
                                                            <th class="text-center col-md-1">E-MAIL</th>
                                                            <th class="text-center col-md-1">LAST SIGN-IN</th>
                                                        
                                                            @if(Auth::user()->level == 'admin')
                                                            <th class="text-center col-md-1" width="10%">OPSI</th>
                                                            @endif
                                                          </tr>
                                                          </thead>
                                                          <tbody>
                                                            @php
                                                            $no = 1;
                                                            @endphp
                                                            @foreach($datas as $data)
                                                            <tr>
                                                              <td class="text-center">{{ $no++ }}</td>
                                                              <td class=" col-md-2 text-left">
                                                              @if($data->foto)
                                                                <img src="{{url('images/user', $data->foto)}}" alt="image"  style="margin-right: 1px;" width="50" height="50" class="img-circle img-fluid" />
                                                              @else
                                                                <img src="{{url('/adminlte/img/avatar4.png')}}" alt="image"  style="margin-right: 1px;" width="50" height="50" class="img-circle img-fluid" />
                                                              
                                                              @endif

                                                            
                                                                            {{ $data->name }}
                                                  
                                                            

                                                              </td>
                                                      
                                                          

                                                              <td>
                                                              
                                                                @if($data->level == 'admin')
                                                                  <span class="badge bg-success"> Admin</span> 
                                                                @else
                                                                      <span class="badge bg-warning"> Bendahara</span> 
                                                                      
                                                                @endif 
                                                              
                                                              </td>
                                                              <td>
                                                              
                                                              {{$data->username}}
                                                              
                                                              </td>

                                                              <td class=" col-md-1 text-left" >
                                                                {{$data->email}}
                                                              </td>

                                                            

                                                              <td class="text-left">{{ $data->updated_at->diffForHumans() }}</td>
                                                              
                                                              <td class="text-left col-md-1">   

                                                          
                                                                      <!-- <a href="{{route('user.show', $data->id)}}" class="btn btn-info btn-sm  text-center" tooltip >
                                                                        <i class="fa fa-eye text-center"></i>
                                                                      </a>   -->
                                                                      <a href="{{route('user.edit', $data->id)}}" class="btn btn-secondary btn-sm  text-center" tooltip >
                                                                        <i class="fa fa-edit text-center"></i>
                                                                      </a>  
                                                                                  
                                                                      <a  data-toggle="modal" data-target="#modalDelete_{{ $data->id }}" class="btn btn-danger btn-sm text-center">
                                                                        <i class="fas fa-trash  text-center"></i>
                                                                      </a>
                                                        
                                                                  
                                                                    
                                                          

                                          
                                                                          
                                                                          <!-- Modal -->
                                                                          <form method="POST" action="{{ route('user.destroy',['id' => $data->id]) }}">
                                                                            <div class="modal fade" id="modalDelete_{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
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
                                                                                      <p>Apakah anda yakin ingin menghapus data <b>{{$data->name}}</b>  ?</p>
                                                                                    
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

