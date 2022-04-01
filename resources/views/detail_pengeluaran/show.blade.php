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
              <li class="breadcrumb-item active"><a href="/detail_pengeluaran">Kategori Pengeluaran</a></li>
              <li class="breadcrumb-item active">{{$details->kategori}}</li>
            </ol>
          </div>
          


     
          <div class=" table-responsive col-md-12 col-sm-6 col-12">
 
          <div class="card card-secondary">
            <div class="card-body">
            <div class="col-md-12">
          <div class="card card-primary card-outline">

            <div class="card-body p-0">
              <div class="mailbox-read-info">

                <h5>Kategori Pengeluaran <b>{{$details->kategori}} 
          
                   
             
                </b>
                  <span class="mailbox-read-time float-right">{{ $details->updated_at->diffForHumans() }}</span></h6>
                </h5>
               
               
              </div>

              <div class="mailbox-read-message">
    
         
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
                                                      @foreach ($detail as $k)
                                                      <tr>
                                                        <td class="text-left">{{ $no++ }}</td>
                                                        <td class="text-left">{{ $k->kategori }}</td>
                                                        
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


