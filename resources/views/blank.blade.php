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

<h4>Form Tambah Transaksi</h4> 
      </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active"><a href="/transaksi">Data Transaksi</a></li>
              <li class="breadcrumb-item active">Tambah Data Transaksi</li>
            </ol>
          </div>
          


     
          <div class=" table-responsive col-md-12 col-sm-6 col-12">
          
            
             <!--area ditambah-->   
<!--area diisi-->         
<div class="card card-secondary">
  <div class="card-body">
    
  <form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
  {{ csrf_field() }}

    <!--area ditambah   -->
    

    

    <div class="form-group col-md-12">
     
      <button type="submit" class="btn btn-success col-md-2 float-right" id="submit" >
                          Submit
      </button>
      &nbsp;
      <button type="reset" class="btn btn-danger col-md-1 float-left">
                                    Reset
      </button>
      <a href="{{route('transaksi.index')}}" class="btn btn-light pull-right col-md-1">Back</a>
    </div>
    
                      
  </form>
</div>
</div>
                     
</div>
</div>

        


        </div>
      </div><!-- /.container-fluid -->
    </section>

@endsection



<!--index-->
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

<a href="{{ route('transaksi.create') }}" class="btn btn-primary  btn-fw col-lg-3"><i class="fa fa-plus"></i> Tambah Transaksi</a>         
      </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
              
            </ol>
          </div>
          


     
          <div class=" table-responsive col-md-12 col-sm-6 col-12">
            

             </br>
             <!--area diisi-->
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th width="1%">NO</th>
                  <th class="text-center col-md-1" width="11%">TANGGAL</th>
                  <th class="text-center col-md-2" >KATEGORI</th>
                  <th class="text-center col-md-2">KETERANGAN</th>
                  <th class="text-center col-md-2">PEMASUKAN</th>
                  <th class="text-center col-md-2">PENGELUARAN</th>
                  <th class="text-center col-md-1">UPDATE</th>
                  <th class="text-center col-md-2" width="10%">OPSI</th>
                  </tr>
                  </thead>
                  <tbody>
              @php
              $no = 1;
              @endphp
              @foreach($transaksi as $t)
              <tr>
                <td class="text-left">{{ $no++ }}</td>
              
                <td class="text-left">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                <td class="text-left">{{ $t->kategori->kategori }}</td>
                <td class="text-center">{{ $t->keterangan }}</td>
                <td class="text-left">
                  @if($t->jenis == "Pemasukan")
                  {{ "Rp.".number_format($t->nominal).",-" }}
                  @else 
                  {{ "-" }}
                  @endif
                </td>
                <td class="text-left">
                  @if($t->jenis == "Pengeluaran")
                  {{ "Rp.".number_format($t->nominal).",-" }}
                  @else
                  {{ "-" }}
                  @endif
                </td>
                <td class="text-left">{{ $t->updated_at }}</td>

                <td class="text-center ">    

                <a href="{{route('transaksi.edit', $t->id)}}" class="btn btn-secondary btn-sm col-md-5 text-center">
                  <i class="fas fa-edit  text-center"></i> Edit
                </a>
                <a  data-toggle="modal" data-target="#modalDelete_{{ $t->id }}" class="btn btn-danger btn-sm col-md-5 text-center">
                  <i class="fas fa-trash  text-center"></i> Hapus
                </a>
                
                  <!-- 
                    <a href="{{route('transaksi.edit', $t->id)}}" class="btn btn-secondary  btn-sm"><i class="fa fa-cog"></i> </a>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete_{{ $t->id }}"><i class="fa fa-trash"></i></button>
                  -->
               
                  
                  <!-- Modal -->
                  <form method="POST" action="{{ route('transaksi.destroy',['id' => $t->id]) }}">
                    <div class="modal fade" id="modalDelete_{{ $t->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">


                          {{ csrf_field() }}
                            {{ method_field('delete') }}

                            <p>Apakah anda yakin ingin menghapus data <b>{{$t->transaksi}}</b> ?</p>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Hapus</button>
                                                   
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
             <!-- </div>
               /.card-body -->
            </div>


      
  

            
            
</div>
</div>


        </div>
      </div><!-- /.container-fluid -->
    </section>

@endsection


