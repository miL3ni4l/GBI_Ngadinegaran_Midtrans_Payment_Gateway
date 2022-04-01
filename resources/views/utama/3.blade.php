@extends('layouts.utama2')
@section('title', '- Profil')

@section('content')
<div class="container" style="padding-top:10%;padding-bottom:30px">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1>Profil</h1> 
      <h3 class="section-heading">{{$profil->nama_gereja}}</h3>
    </div>
  </div>
</div>
<br><br>
<div class="container">
  <div class="row">
    <div class="col-md-5">
      <img src="utama/img/gkj.png" alt="">
    </div>
    <div class="col-md-5">
      <ul type="square">
        <br><br>
        <li style="padding:5px"> <strong> Nama Gereja : </strong> {{$profil->nama_gereja}}</li>
        <li style="padding:5px"> <strong> Berdiri pada tahun :</strong> 1999</li>
        <li style="padding:5px"> <strong> NO. SK  : </strong> XXXXXX-XX-XXXX</li>
        <li style="padding:5px"> <strong> Alamat  : </strong> {{ $profil-> alamat_gereja}} </li>
        <li style="padding:5px"> <strong> Email  : </strong> {{ $profil-> email_gereja}} </li>
        <!-- <li style="padding:5px"> <strong> No. Telp  : </strong> {{ $profil-> tlp_gereja}} </li> -->
      </ul>
    </div>
    <div class="col-md-2">

    </div>
  </div>
</div>
<br><br>


<div class="container-fluid">
  <h2>Sejarah GKJ Samironobaru</h2>     
  <p>{{ $profil-> sejarah_gereja}}</p>
</div>

<div class="container-fluid bg-grey">
  <h2>VISI DAN MISI</h2> <br>
  <h4>Visi : </h4> {{ $profil-> visi_gereja}} 
  <br><br>
  <h4>Misi : </h4> {{ $profil-> misi_gereja}} 
</div>


<div class="container-fluid">
  <h2>Kontak</h2>     
  <p><strong>Alamat :</strong> {{ $profil-> alamat_gereja}}
  <p><strong>Email :</strong> {{ $profil-> email_gereja}}
  <!-- <p><strong>Alamat :</strong> {{ $profil-> tlp_gereja}} -->
</div>

@endsection