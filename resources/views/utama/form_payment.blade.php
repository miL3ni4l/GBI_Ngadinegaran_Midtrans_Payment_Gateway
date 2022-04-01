@extends('layouts2.utama')
@section('title', '- Profil')

@section('content') 
<br/>
<section >
    <div class="container">
        <div class="row">
                          
                                                <div class="col-lg-12 mx-auto">
                                                    <div class="invoice p-3 mb-3">

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h4>
                                                                    <i class="fas fa-globe"></i> Gerak Bersama
                                                                </h4>
                                                            </div>
                                                        </div>

                                                        <p class="section-heading text-uppercase">Dalam merespon situasi tanggap darurat COVID-19, GBI Ngadinegaran akan memberikan paket bahan pangan kepada mereka yang terdampak situasi tersebut, khususnya warga lansia dan kelompok rentan lainnya.</p>
                                                        <h6 class="section-heading text-uppercase">saudara dapat bertapisipasi dengan :</h6>
                                                    
                                                        <div class="row invoice-info">
                                                            <div class="col-sm-6 invoice-col">
                                                                <address>
                                                                    <!-- <strong>Admin, Inc.</strong><br> -->
                                                                    <p class="section-heading">Membawa barang isi paket bahan pangan berupa: Beras 5 Kg, Kacang Hijau 1 Kg, Minyak Goreng 1 lt, Gula, Mie Kering, Kecap, Garam, dan diserahkan ke Kantor Gereja.</p>
                                                                </address>
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-6 invoice-col">
                                                                <address>
                                                                    <p class="section-heading">Memberikan dana pengadaan paket bahan pangan seharga Rp 100.000,00 per paket. Dana dikirimkan ke rekening BCA a/n Marthinus Sumendi atau Sardjono No Rek: 4451096448</p>
                                                                    <p class="section-heading">
                                                                        atau dapat menekan tombol ini
                                                                    <a  data-toggle="modal" data-target="#modalDelete"  class="btn btn-warning btn-sm text-center">
                                                                            <i class="fas fa-credit-card  text-center"></i>
                                                                    </a>
                                                                    </p>
                                                                </address>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Modal -->
                                                <form action="/payment" method="GET">
                                                        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">

                                                                  <div class="modal-header bg-warning">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                  </div>

                                                                  <div class="modal-body">
                                                                    {{ csrf_field() }}

                                                                    <div class="form-group{{ $errors->has('uname') ? ' has-error' : '' }}">
                                                                        <label class="label">Nama <b style="color:Tomato;">*</b> </label>
                                                                        <div class="input-group">
                                                                            <input id="uname" type="text" class="form-control"  placeholder="Masukan nama . . . ." name="uname" value="{{ old('uname') }}" required autofocus>
                                                                            
                                                                        </div>
                                                                            @if ($errors->has('uname'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('uname') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                    </div>

                                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                                        <label class="label">Email <b style="color:Tomato;">*</b> </label>
                                                                        <div class="input-group">
                                                                            <input id="email" type="text" class="form-control"  placeholder="Masukan email . . . ."  name="email" value="{{ old('email') }}" required autofocus>
                                                                            
                                                                        </div>
                                                                            @if ($errors->has('email'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                    </div>

                                                                    <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                                                                        <label class="label">Telp <b style="color:Tomato;">*</b> </label>
                                                                        <div class="input-group">
                                                                            <input id="number" type="number" class="form-control"  placeholder="Masukan no telp . . . ."  name="number" required>
                                                                            
                                                                            @if ($errors->has('number'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('number') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <button class="btn btn-warning submit-btn btn-block" type="submit">Simpan</button>
                                                                    </div>

                                                                  </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                </form>

                                                @if(session('alert-success'))
                                                <script>alert("{{session('alert-success')}}")</script>
                                                @elseif(session('alert-failed'))
                                                <script>alert("{{session('alert-failed')}}")</script>
                                                @endif
    
        </div>              
    </div>
</section>



@endsection