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
              <li class="breadcrumb-item active"><a href="/riwayat">Riwayat</a></li>
              <li class="breadcrumb-item active">{{$transaksi->detail_kategori->kategori}}</li>
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

                <h5>Kode Transaksi <b>{{$transaksi->kode_transaksi}} </b></h5>
                <h6>petugas : {{ $transaksi->detail_kategori->petugas['nama'] }}
                  <span class="mailbox-read-time float-right">{{ $transaksi->updated_at->diffForHumans() }}</span></h6>
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
                <p>Hello <b><i>{{Auth::user()->name}}</i></b>,</p>

                <p>
                  Transaksi ini dilakukan pada tanggal {{$transaksi->tanggal->format('d-M-Y')}} dengan jenis {{$transaksi->jenis}} sebesar <b>   {{ "Rp.".number_format($transaksi->nominal).",-" }} </b>
                  kategori transaksi <b>{{$transaksi->detail_kategori->kategori}}</b> dimasukan ke dalam  <b>{{$transaksi->kas->kas}}</b>.
                </p>


                <p>
                  Keterangan :
                  <i>
                  {{$transaksi->keterangan}}
                  </i>
                </p>

                <p>Thanks,<br> {{ $transaksi->detail_kategori->petugas['nama'] }}</p>
              </div>

          

              
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">
            <p>Bukti Transaksi :</p>
            <img width="275" height="275" @if($transaksi->cover) src="{{ asset('images/Transaksi/'.$transaksi->cover) }}" @endif />      
              <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                <!-- <li>
                  <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a>
                        <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                  </div>
                </li> -->
                

                             
              </ul>
            </div>
            <!-- /.card-footer -->
            <!-- <div class="card-footer">
              <div class="float-right">
                <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
              </div>
              <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
              <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
            </div> -->
            <!-- /.card-footer -->
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


