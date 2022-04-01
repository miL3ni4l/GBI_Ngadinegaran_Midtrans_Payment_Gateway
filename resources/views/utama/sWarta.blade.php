@extends('layouts.utama2')

@section('content')
<br/>
<div class="container">
    <div class="row">            
        <div class="col-md-4">
        <img src="{{ asset('storage/'.$warta->foto)}}" width="100%" height="auto">
        </div>
        <div class="col-md-8">
        <h1>{{$warta->judul}}</h1>
        <p style="font-style : italic">Penulis : {{$warta->keterangan}}</p><br/>
        <p>{{$warta->isi}}</p>
        </div>
    </div>
</div>
@endsection
