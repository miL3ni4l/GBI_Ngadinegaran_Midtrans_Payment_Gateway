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
              <li class="breadcrumb-item active"><a href="/pemasukan_rutin">Pemasukan Khusus</a></li>
              <li class="breadcrumb-item active">{{$pemasukan_rutin->kode_persembahan_pengeluaran_khusus}} -{{$pemasukan_rutin->detail_kategori->kategori}}</li>
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

                <h5>Kode <b>{{$pemasukan_rutin->kode_persembahan_pengeluaran_khusus}} 
          
                            @if($pemasukan_rutin->status == '1')
                                <i class="fa fa-check-square" style="color:green" ></i>
                              @else
                                <i class="fa fa-times" style="color:red"></i>
                              @endif
             
                </b>
                  <span class="mailbox-read-time float-right">{{ $pemasukan_rutin->updated_at->diffForHumans() }}</span></h6>
                </h5>
               
               
              </div>

              <div class="mailbox-read-message">
                <p>Hello <b><i>{{Auth::user()->name}}</i></b>,</p>

                <p>
                          Pengeluaran ini dilakukan pada tanggal <b>{{$pemasukan_rutin->tanggal->format('d-M-Y')}}</b> dengan kategori <b>{{$pemasukan_rutin->detail_kategori->kategori}}</b>
                          nominal <b>{{ "Rp.".number_format($pemasukan_rutin->nominal).",-" }} </b>.
                        </p>

                <p>
                  Keterangan :
                  <i>
                  {{$pemasukan_rutin->keterangan}}
                  </i>
                </p>
              </div>

          

              
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">
            <p>Bukti pemasukan_rutin :</p>
            <img width="275" height="275" @if($pemasukan_rutin->cover) src="{{ asset('images/PengeluaranKhusus/'.$pemasukan_rutin->cover) }}" @endif />      
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


