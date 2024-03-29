@extends('layouts2.utama')

@section('header')
<section id="">
    <div class="intro-text">
        <div class="intro-lead-in">Selamat Datang di</div>
        <div class="">
          <h4>GEREJA BAPTIS INDONESIA</h4>
          <h4>NGADINEGARAN</h4>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <a class="js-scroll-trigger" href="#ibadah">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-calendar-alt fa-stack-1x fa-inverse"></i>
            </a>
          </span>
          <h4 class="service-heading">Jadwal Ibadah</h4>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <a class="js-scroll-trigger" href="#warta">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-newspaper fa-stack-1x fa-inverse"></i>
            </a>
          </span>
          <h4 class="service-heading">Warta Gereja</h4>
        </div>
       
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <a class="js-scroll-trigger"  href="#contact">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-phone fa-stack-1x fa-inverse"></i>
            </a>            
          </span>
          <h4 class="service-heading">Kontak</h4>
        </div>
    </div>
</section>
@endsection

@section('content')

  <section id="profil_grj">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h4 class="section-heading text-uppercase">Profil</h4><br>
        </div>
      </div>

      <div class="container">
        <div class="row">
                @foreach($profil as $p)
                        <div class="col-lg-12">
                                  
                      
                                      <div class="card bg-light d-flex flex-fill">
                                        <div style="padding-top:2%" class="col-md-12">
                                          <img id="img-n" width="150" height="150" style="display:block; margin:auto;"src="utama/img/gbi.png" />  
                                        </div>
             
                                        <div class="card-body text-muted border-bottom-0">
                                          <h5> {{ $p->nama_gereja }} </h5>
                                        </div>

                                        <div class="card-body pt-0">
                                          <div class="row">

                                            <div class="col-12">
                                              <h4 class="lead"><b></b></h4>
                                              <p class="text-muted text-sm">

                                              
                                              </p>
                                              <ul class="ml-0 mb-0 fa-ul text-muted">
                                                <li class="small">  <h6> SEJARAH </h6></li>
                                                <li class="small"></i></span>  {{ $p->sejarah_gereja }}</li>
                                                </br>
                                                <li class="small">  <h6>VISI</h6></li>
                                                <li class="small"></i></span>  {{ $p->visi_gereja }}</li>
                                                </br>
                                                <li class="small">  <h6>MISI</h6></li>
                                                <li class="small"></i></span>  {{ $p->misi_gereja }}</li>
                                                </br>
                                                <li class="small">  <h6> TELP </h6></li>
                                                <li class="small"></span>{{ $p->tlp_gereja }}</li>
                                                </br>
                                                <li class="small">  <h6>ALAMAT</h6></li>
                                                <li class="small"></i></span> {{ $p->alamat_gereja }}
                                                </li>
                                               
                                              </ul>
                                            </div>

                                            <div class="col-5 text-center">
                                            </div>

                                          </div>
                                        </div>

                                        <!-- <div class="card-footer">
                                          <div class="text-right">
                                            <a href="#" class="btn btn-sm bg-teal">
                                              <i class="fas fa-comments"></i>
                                            </a>
                                            
                                            <a href="#" class="btn btn-sm btn-primary">
                                              <i class="fas fa-user"></i> View Profile
                                            </a>
                                          </div>
                                        </div>
                                      </div> -->
                              
                        </div>      
                  @endforeach
        </div>
      </div>
    
    </div>
  </section>

  <section id="profil_pdt">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h4 class="section-heading text-uppercase">PENDETA</h4><br>
        </div>
      </div>

      @foreach($pendeta as $p)
      <div class="container">
        <div class="row">
                     
                        <div class="col-lg-12">
                                  
                      
                                      <div class="card bg-light d-flex flex-fill">

                                        <div style="padding-top:2%" class="col-md-12">
                                          <img id="img-n"  width="150" height="150" style="display:block; margin:auto;" @if($p->cover) src="{{ asset('images/Pendeta/'.$p->cover) }}" @endif /> 
                                         
                                        </div>
             
                                        <div class="card-body text-muted border-bottom-0">
                                           <h5> {{ $p->nama_pendeta }} </h5>
                                        </div>

                                        <div class="card-body pt-0">
                                          <div class="row">

                                            <div class="col-12">
                                              <h4 class="lead"><b></b></h4>
                                              <p class="text-muted text-sm">
                                              </p>
                                              <ul class="ml-0 mb-0 fa-ul text-muted">
                                               
                                                <li class="small">  <h6>NAMA PANGGILAN</h6></li>
                                                <li class="small"></i></span>  {{ $p->alias }}</li>
                                                </br>
                                                <li class="small">  <h6>ISTRI</h6></li>
                                                <li class="small"></i></span> {{ $p->istri }}
                                                </li>
                                         
                                                </br>
                                                <li class="small">  <h6>Tempat & Tanggal Lahir</h6></li>
                                                <li class="small"></i></span>  {{ $p->tempat_lahir }}, {{ date('d-M-Y', strtotime($p->tgl_lahir )) }}</li>
                                                </br>
                                               
                                                <li class="small">  <h6>Pendidikan</h6></li>
                                                <li class="small"></i></span> {{ $p->pendidikan }}
                                                </li>
                                                </br>
                                                <li class="small">  <h6>Karir</h6></li>
                                                <li class="small"></i></span> {{ $p->karir }}
                                                </li>
                                                </br>
                                                <li class="small">  <h6>Biografi</h6></li>
                                                <li class="small"></i></span> {{ $p->biografi }}
                                                </li>
                                                
                                               
                                              </ul>

                                            </div>
                                            
                                            <div class="col-5 text-center">
                                            </div>

                                          </div>
                                        </div>

                              
                        </div>      
                 
        </div>
      </div>
      @endforeach
    
    </div>
  </section>

  <section id="ibadah">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h4 class="section-heading text-uppercase">JADWAL IBADAH</h4><br>
        </div>
      </div>

      <div class="container">
        <div class="row">
                
                     
                        <div class="col-lg-12">

                                  <table id="example1" class="table table-bordered table-striped">
                                      <thead> 
                                        <tr>
                                        <th width="1%">NO</th>
                                        <th class="text-center">IBADAH</th>
                                        <th class="text-center">JAM</th>
                                        </tr>
                                      </thead>
                                    <tbody>
                                      @php
                                      $no = 1;
                                      @endphp
                                      @foreach($ibadah as $k)
                                      <tr>
                                        <td class="text-center">{{ $no++ }}</td>               
                                        <td class="text-left">{{ $k->ibadah }}</td>
                                        <td class="text-center">{{ $k->jam }}</td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                  

                              
                        </div>      
        </div>
      </div>
    
    </div>
  </section>

  <section id="warta">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h4 class="section-heading text-uppercase">WARTA</h4><br>
        </div>
      </div>

      <div class="container">
        <div class="row">
                
            @foreach($profil as $p)         
            <div id="owl-carousel-1" class="owl-carousel owl-theme center-owl-nav">

                <div class="col-md-12">
                    <div class="alert alert-secondary center-block">
                      <table id="example1" class="table table-bordered table-striped">
                        

                                <div class="card-body text-muted border-bottom-0">
                                  <h6> {{ $p->nama_gereja }} </h6>
                                </div>

                                <div class="card-body pt-0">
                                  <div class="row">

                                    <div class="col-12">
                                      
                                      <ul class="ml-0 mb-0 fa-ul text-muted">
                                      
                                        <li class="small">  <h6>Nama Gereja</h6></li>
                                        <li class="small"></i></span>  {{ $p->nama_gereja }}</li>
                                        </br>
                                        <li class="small">  <h6>Telp</h6></li>
                                        <li class="small"></i></span> {{ $p->tlp_gereja }}
                                        </li>
                                        </br>
                                        <li class="small">  <h6>Alamat</h6></li>
                                        <li class="small"></i></span> {{ $p->alamat_gereja }}
                                        </li>
                                        
                                      
                                      </ul>

                                    </div>
                                    
                                    <div class="col-5 text-center">
                                    </div>

                                  </div>
                                
                           
                      </table>
                    </div>
                </div>
            @endforeach

            
            </div>    


        </div>
      </div>
    
    </div>
  </section>

  <section id="persembahan">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h4 class="section-heading text-uppercase">Persembahan</h4><br>
        </div>
      </div>

      <div class="container">
        <div class="row">
                @foreach($profil as $p)
                        <div class="col-lg-12">
                                  
                      
                                      <div class="card bg-light d-flex flex-fill">
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
                                                                        atau dapat melakukan pembayaran
                                                                        
                                                                    <a  href="/donation"  class="btn btn-warning btn-sm text-center">
                                                                            <i class="fas fa-credit-card  text-center"></i> klik disini
                                                                    </a>
                                                                    <!-- <a  data-toggle="modal" data-target="#modalDelete"  class="btn btn-warning btn-sm text-center">
                                                                            <i class="fas fa-credit-card  text-center"></i> klik disini
                                                                    </a> -->
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
                  @endforeach
        </div>
      </div>
    
    </div>
  </section>

    <!--Warta Gereja-->
    <!-- <section id="warta">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 text-center">
            <h4 class="section-heading text-uppercase">Warta Gereja</h4><br>
          </div>
        </div>
        
        <div class="section">
          <div class="container">
            <div class="row">
              <div class="col-md-12">

                <div class="section-title">
                  <h4 class="title">Berita Terkini</h4>
                </div>
            
                
                <div id="owl-carousel-2" class="owl-carousel owl-theme">        

                  <article class="article thumb-article" width="50px" height="50px">
                    <div class="article-img">
                    <img> 
                    </div>
                    <div class="article-body">
                      <ul class="article-info">
                      </ul>
                      <h3 class="article-title"><a >judul</a></h3>
                      <ul class="article-meta">
                        <li><i></i>warta</li>
                      </ul>
                    </div>
                  </article>
                
                </div>

          <div class="col-lg-12 text-center">
              <a href="/utama/2"><h4>Read More >></h4></a>
          </div>


    </section> -->

  <section id="contact">
    <div class="container">
        
          <div class="row text-center">
              
              <div class="col-md-6">
                
                <h6 class="section-heading text-uppercase">QR PERSEMBAHAN  
                <p>
                  @foreach($profil as $p)
                      {{ $p->nama_gereja }}
                  @endforeach 
                </p>
                
                </h6>      
                <img id="img-n" width="256" height="256" style="display:block; margin:auto;" src="img/qris_erickunto.jpeg"/>  
                </br>

              </div>
            
              <div class="col-md-6">
                <h6 class="section-heading text-uppercase">Kontak </h6>      
                @foreach($profil as $p)
                  <p class="section-heading text-uppercase">
                  <a href=" https://api.whatsapp.com/send/?phone=6287870552929&text&app_absent=0">
                    <u>{{ $p->tlp_gereja }}</u>
                    </a>
                  </p>
                @endforeach 
                @foreach($profil as $p)
                <h6 class="section-heading text-uppercase">Alamat </h6>  
                  <p class="section-heading text-uppercase">  
                    <a href="https://www.google.com/maps/place/GBI+Ngadinegaran+Yogyakarta/@-7.8164518,110.3604728,17z/data=!3m1!4b1!4m5!3m4!1s0x2e7a579626e75bb1:0x1ad47bead0f679d!8m2!3d-7.8164518!4d110.3626615">
                    <u>{{ $p->alamat_gereja }}</u>
                    </a>
                  </p>
                @endforeach 
               
                <h6 class="section-heading text-uppercase">Sosial Media</h6>    
                <ul class="list-inline social-buttons">
                  <li class="list-inline-item">
                    <a href="https://www.youtube.com/c/GerejaBaptisIndonesiaNgadinegaran/featured">
                      <i class="fab fa-youtube"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://www.facebook.com/gbingadinegaran">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://www.instagram.com/gbingadinegaran/">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://www.twitter.com/gbingadinegaran/">
                      <i class="fab fa-twitter"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href=" https://api.whatsapp.com/send/?phone=6287870552929&text&app_absent=0">
                      <i class="fab fa-whatsapp"></i>
                    </a>
                  </li>
                </ul>
              </div>

        </div>

        <!-- <div class="col-lg-12 text-center">

          <h6 class="section-heading text-uppercase">SQAN QR CODE </h6>      
          <h6 class="section-heading">atau <a href="https://www.youtube.com/c/GerejaBaptisIndonesiaNgadinegaran/featured"><u>KLIK LINK</u></a></h6> 
          <img id="img-n" width="307" height="437" style="display:block; margin:auto;" src="img/qris_erickunto.jpeg"/>  
          </br>
          <h4 class="section-heading text-uppercase">Hubungi Kami :</h4>
           <p class="section-heading text-uppercase">Telp : BELUM TERSEDIA </p>

        </div> -->

        <!-- <div class="col-md-12 text-center">
        <h4 class="section-heading text-uppercase">Kontak :</h4>
                <p class="section-heading text-uppercase">Telp : BELUM TERSEDIA </p>
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="https://www.youtube.com/c/GerejaBaptisIndonesiaNgadinegaran/featured">
                <i class="fab fa-youtube"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.facebook.com/gbingadinegaran">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.instagram.com/gbingadinegaran/">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
          </ul>
        </div> -->
        
    </div>
    
  </section>


    



@endsection
