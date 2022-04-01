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
                                    <a href="{{ route('pendeta.create') }}"  type="button" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                  </div>

                                  <!-- <div class="btn-group">
                                    <button  data-toggle="modal" data-target="#modal-filter"  type="button" class="btn btn-success">
                                    <i class="fas fa-filter  text-center"></i>
                                    </button>
                                  </div> -->
                                  <div class="btn-group">
                                    <a  href="{{route('pendeta.index')}}" type="button" class="btn btn-warning">
                                    <i class="fas fa-undo"></i>
                                    </a>
                                  </div>
                             
                              <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                <li class="breadcrumb-item active">Petugas</li>
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

<section class="content-header">
      <div class="container-fluid">
        <div class="row">


                  <div class=" table-responsive col-md-12 col-sm-12 col-12">
                    <div class="card card-solid">
                      <div class="card-body pb-0">
                        <div class="row">

                          @foreach($pendeta as $p)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                              <div class="card bg-light d-flex flex-fill">
                                  <div class="card-header text-muted border-bottom-0">
                                        {{ $p->kode_pendeta }}

                                              <span class="badge bg-primary"> Editor</span>       
                                 
                                  </div>

                                  <div class="card-body pt-0">
                                    <div class="row">
                                      <div class="col-7">
                              
                                      
                                      <h2 class="lead"><b>{{ $p->nama }}</b> </h2>
                                        
                                        <p class="text-muted text-sm"><b>Last sign in : </b> {{ $p->updated_at->diffForHumans()  }}</p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                          @if($p->jk == 'L') 
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user-circle"></i></span> Laki-laki</li>
                                          @else
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user-circle"></i></span> Perempuan</li>
                                          @endif
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> E-mail : {{ $p->tlp_pendeta }}</li>
                                        
                                          <li class="small">
                                              <span class="fa-li"><i class="fas fa-lg fa-phone"></i>
                                              </span> 
                                              @if($p->no_telp == null)
                                              <td class ="text-danger text-center"> Phone : Tidak Ada Nomor !!!</td>
                                              @else
                                              <td class ="text-danger text-center"> Phone : {{ $p->no_telp }}</td>
                                              
                                              @endif
                                          </li>

                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-home"></i></span> Alamat : {{ $p->alamat }}</li>
                                        </ul>

                                      </div>
                                      <div class="col-5 text-center">
                                                <img  alt="image" style="margin-right: 1px;" width="125" height="125" class="img-circle img-fluid" @if($p->cover) src="{{ asset('images/Pendeta/'.$p->cover) }}" @endif/>
                                             
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card-footer float-right">
                                    <div>
                                           
                                                          <a href="{{route('pendeta.edit', $p->id)}}" class="btn btn-secondary btn-sm text-center">
                                                            <i class="fas fa-edit  text-center"></i> 
                                                          </a>
                                                          <a  data-toggle="modal" data-target="#modalDelete_{{ $p->id }}"  class="btn btn-danger btn-sm text-center">
                                                            <i class="fas fa-trash  text-center"></i>
                                                          </a>


                                                          <!-- Modal -->
                                                          <form method="POST" action="{{ route('pendeta.destroy',['id' => $p->id]) }}">
                                                            <div class="modal fade" id="modalDelete_{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
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

                                                                    <p>Apakah anda yakin ingin menghapus <b>{{ $p->nama }} </b>?</p>

                                                                  </div>
                                                                  
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                                                                    
                                                                    
                                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash m-r-5"></i> Hapus</button>
                                                                                          
                                                                    </div>
                                                            

                                                                </div>
                                                              </div>
                                                            </div>
                                                          </form>

                                                          

                                    </div>
                                  </div>

                              </div>
                            </div>
                          @endforeach

                          
                        </div>	
                      </div>
                    </div>
                  </div>

        </div>
      </div><!-- /.container-fluid -->
</section>

@endsection


