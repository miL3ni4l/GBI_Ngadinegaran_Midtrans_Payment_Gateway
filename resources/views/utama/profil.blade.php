@extends('layouts2.utama')

@section('content')

<section class="content-header">
      <div class="container-fluid">
        <div class="row">
                <div class="col-lg-12 text-center">
                    <h4 class="section-heading text-uppercase">Profil</h4><br>
                </div>

                
                <div class=" table-responsive col-md-12 col-sm-12 col-12">
                    <div class="card card-solid">
                      <div class="card-body pb-0">
                        <div class="row">
                          <div id="owl-carousel-4" class="owl-carousel owl-theme center-owl-nav">

                                    <div class="col-md-12 border-rounded">
                                        <div class="alert alert-secondary center-block">
                                          <table id="example1" class="table table-bordered table-striped">
                                               @foreach($profil as $p)

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
                                                    
                                                @endforeach
                                          </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12 border-rounded">
                                        <div class="alert alert-secondary center-block">
                                          <table id="example1" class="table table-bordered table-striped">
                                            @foreach($profil as $p)

                                                    <div class="card-body text-muted border-bottom-0">
                                                      <h6> {{ $p->nama_gereja }} </h6>
                                                    </div>

                                                    <div class="card-body pt-0">
                                                      <div class="row">

                                                        <div class="col-12">
                                                          
                                                          <ul class="ml-0 mb-0 fa-ul text-muted">
                                                          
                                                            <li class="small">  <h6>Nama Gereja</h6></li>
                                                            <li class="small"></i></span>m  </li>
                                                            </br>
                                                            <li class="small">  <h6>Telp</h6></li>
                                                            <li class="small"></i></span>m
                                                            </li>
                                                            </br>
                                                            <li class="small">  <h6>Alamat</h6></li>
                                                            <li class="small"></i></span> m
                                                            </li>
                                                            
                                                          
                                                          </ul>

                                                        </div>
                                                        
                                                        <div class="col-5 text-center">
                                                        </div>

                                                      </div>
                                                    
                                                @endforeach
                                          </table>
                                        </div>
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