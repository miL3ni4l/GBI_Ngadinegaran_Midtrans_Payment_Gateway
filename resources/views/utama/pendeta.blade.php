@extends('layouts.utama2')

@section('content')
<div class="container">
  <div class ="row text-center">
    @foreach($pendeta as $pendeta)
    <div class="col-md-4"> <br><br>
         <div class="card">
            @if($pendeta->foto_pendeta !=null)
            <img class="card-img-top" src="{{ asset('storage/'.$pendeta->foto_pendeta)}}" alt="Card image cap">
            @else
            <img class="card-img-top" src="{{ asset('utama/img/user.png')}}" alt="Card image cap">
            @endif
            <div class="card-body"> 
               <h5 class="card-title border-bottom pb-3">{{ $pendeta ->nama_pendeta }} </h5>
               <p class="card-text"><strong>Nama : </strong>{{ $pendeta ->nama_pendeta }}</p>
               <p class="card-text"><strong>Jabatan : </strong>{{ $pendeta ->keterangan_pendeta }}</p>
               <p class="card-text"><strong>Telp : </strong>{{ $pendeta ->tlp_pendeta }}</p>
            </div>
         </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

