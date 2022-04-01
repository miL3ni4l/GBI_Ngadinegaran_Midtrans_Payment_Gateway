@extends('layouts.utama2')
@section('title', '- Profil')
@section('breadcrumb')
    <a href="{{asset('utama/kegiatan')}}">Galeri Kegiatan</a> / Foto
@endsection
@section('content')
<div class="container" style="padding-bottom:30px">

<h3>Daftar Foto {{$kegiatan->nama_kegiatan}}</h3>
    <div class="gallery" id="gallery">
    @if($foto != null)        
    <div class="row-gallery">

    @foreach ($foto as $foto)
                <div class="column-gallery">
                    <a href="{{ asset('storage/'.$foto->foto_kegiatan)}}" target="_blank"><img src="{{ asset('storage/'.$foto->foto_kegiatan)}}" width="200cm" height="200cm"></a>
                </div>
    @endforeach



       
    </div>      
    @else
         <p>Tidak ada foto</p>
    @endif
    </div>
</div>
@endsection


