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
              <li class="breadcrumb-item active">{{$pemasukan_rutin->detail_kategori->kategori}}</li>
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

                <h5>Kode pemasukan_rutin <b>{{$pemasukan_rutin->kode_pemasukan_rutin}} </b></h5>
                <h6>petugas : {{ $pemasukan_rutin->detail_kategori->petugas['nama'] }}
                  <span class="mailbox-read-time float-right">{{ $pemasukan_rutin->updated_at->diffForHumans() }}</span></h6>
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
                  pemasukan_rutin ini dilakukan pada tanggal {{$pemasukan_rutin->tanggal->format('d-M-Y')}} dengan jenis {{$pemasukan_rutin->jenis}} sebesar <b>   {{ "Rp.".number_format($pemasukan_rutin->nominal).",-" }} </b>
                  kategori pemasukan_rutin <b>{{$pemasukan_rutin->detail_kategori->kategori}}</b> dimasukan ke dalam  <b>{{$pemasukan_rutin->kas->kas}}</b>.
                </p>


                <p>
                  Keterangan :
                  <i>
                  {{$pemasukan_rutin->keterangan}}
                  </i>
                </p>

                <p>Thanks,<br> {{ $pemasukan_rutin->detail_kategori->petugas['nama'] }}</p>
              </div>

          

              
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">
            <p>Bukti pemasukan_rutin :</p>
            <img width="275" height="275" @if($pemasukan_rutin->cover) src="{{ asset('images/pemasukan_rutin/'.$pemasukan_rutin->cover) }}" @endif />      
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


