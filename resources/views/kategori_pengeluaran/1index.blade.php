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
              
              <a href="{{ route('kategori.create') }}" class="btn btn-primary  btn-fw col-lg-2"><i class="fa fa-plus"></i> Kategori</a>   
                  &nbsp      
                  <a  data-toggle="modal" data-target="#modal-filter" class="btn btn-success btn-fw col-lg-1">
                                    <i class="fas fa-filter  text-center"></i> Filter
                                  </a>
                                  &nbsp      
              <a href="{{route('kategori.index')}}" class="btn btn-warning btn-filter  btn-fw col-lg-1"><i class="fas fa-undo"></i> Refresh</a> 
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Kategori</li>
              </ol>
            </div>
        </div> 

        @if (Session::has('message'))
        <div class="col-md-12 col-sm-12 col-12">
        <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
        </div> 
        @endif


        


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
  



  
  <section class="content-header">

    <div class="container-fluid">
      <div class="row">

                    <div class=" table-responsive col-md-12 col-sm-6 col-12">
                              
                        <!--area diisi-->
                      <table class="table table-striped" id="example1">
                                        <thead>
                                        <tr>
                                                    <th width="1%">NO</th>                                                       
                                                    <th class="text-center">KATEGORI</th>
                                                    <th class="text-center">DETAIL KATEGORI</th>
                                                    
                                                    <th class="text-center" >UPDATE</th>   
                                                    <th class="text-center">SALDO</th>   
                                                    <th class="text-center">SISA</th>                                                        
                                                              
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
                                                            @foreach ($k->detail_kategori as $dk)
                                                              {{$dk->kategori}} ,                                 
                                                            @endforeach
                                                          </td>
                                                          
                                                          <td class="text-left">{{ $k->updated_at->diffForHumans() }}</td>  

                                                          <!-- SALDO -->
                                                          <td>
                                                            @foreach ($k->detail_kategori as $dk)
                                                              <?php 
                                                                $id_kategori = $dk->id;
                                                                $pemasukan_perkategori = DB::table('pemasukan_rutin')
                                                                ->select(DB::raw('SUM(nominal) as total'))
                                                                ->where('kategori_id',$id_kategori)
                                                                ->where('status','1')
                                                                ->first();
                                                            
                                                                $id_kategori = $dk->id;
                                                                $pengeluaran_perkategori = DB::table('pemasukan_rutin')
                                                                ->select(DB::raw('SUM(nominal) as total'))
                                                                ->where('kategori_id',$id_kategori)
                                                                ->where('status','1')
                                                                ->first();

                                                                $total = $pemasukan_perkategori->total -= $pengeluaran_perkategori->total;    
                                                                
                                                                $sisa = DB::table('pemasukan_rutin')
                                                                ->where('status','1')
                                                                ->sum('nominal');                                    
                                                              ?>
                                                            {{ "Rp. ".number_format($total)." ," }}
                                                            @endforeach
                                                          </td>

                                                          <td>{{ $k->kategori }}</td>
                                                        


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
      </div>
    </div>

  </section>

  
  
@endsection

