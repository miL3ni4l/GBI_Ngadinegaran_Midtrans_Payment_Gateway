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
                                    <ol class="breadcrumb float-sm-right">
                                      <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                      <li class="breadcrumb-item"><a href="/transaksi">Pemasukan Rutin</a></li>
                                      <li class="breadcrumb-item active">{{$transaksi->kode_transaksi}}-{{$transaksi->detail_kategori->kategori}}</li>
                                    </ol>
                                  </div>
                              </div> 
                          </div>
                        </div>
  </div>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">

            <div class=" table-responsive col-md-12 col-sm-6 col-12">    
              <div class="card card-secondary">
                <div class="card-body">
                  <div class="col-md-12">
                  
                    <div class="card card-primary card-outline">
                      <div class="mailbox-read-info">
                        <h5>
                          <b>{{$transaksi->kode_transaksi}}-{{$transaksi->detail_kategori->kategori}} 
                                    @if($transaksi->status == '1')
                                        <i class="fa fa-check-square" style="color:green" ></i>
                                      @else
                                        <i class="fa fa-times" style="color:red"></i>
                                    @endif
                          </b>
                          <span class="mailbox-read-time float-right">{{ $transaksi->updated_at->diffForHumans() }}</span>
                        </h5>
                      </div>

                      <div class="mailbox-read-message">
                        <p>Hello <b><i>{{Auth::user()->name}}</i></b>,</p>

                        <p>
                          Pemasukan ini dilakukan pada tanggal <b>{{$transaksi->tanggal->format('d-M-Y')}}</b> dengan kategori <b>{{$transaksi->detail_kategori->kategori}}</b>
                          nominal <b>{{ "Rp.".number_format($transaksi->nominal).",-" }} </b>
                          dimasukan ke dalam <b>{{$transaksi->kas->kas}}</b>.
                        </p>

                        <p>
                          Keterangan :<i>{{$transaksi->keterangan}}</i> 
                        </p>

                        <p>Bukti Transaksi :</p>
                        <img width="270" height="270" @if($transaksi->cover) src="{{ asset('images/Transaksi/'.$transaksi->cover) }}" @endif /> 
                      </div>
                    </div>
      
                  </div>
                </div>
              </div>
                                
            </div>
          
      </div>
    </div>
  </section>

  
@endsection


