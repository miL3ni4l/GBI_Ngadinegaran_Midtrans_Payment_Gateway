@extends('layouts.utama2')
@section('title', '- Profil')
@section('breadcrumb','Galeri Kegiatan')
@section('content')
<div class="container" style="padding-top:10%;padding-bottom:30px">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="section-heading">Daftar Kegiatan 
      <br>Gereja GKJ Samirono Baru</h1>
    </div>
  </div>
</div>
<section id="ibadah">
    <div class="container">
        <div class="row text-center">
            
            @foreach($kegiatan as $kegiatan)
            <div class="col-md-4 border-rounded">
            <div class="alert alert-warning">
                <h5 class="service-heading"><a href="/utama/foto/{{$kegiatan->id}}">{{$kegiatan->nama_kegiatan}}</h5>
            </div>
            </div>
            @endforeach

        </div>
        </div>
    </div>


</section>
@endsection

