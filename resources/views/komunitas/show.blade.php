@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
        </script>
@stop

@extends('layouts2.app')

@section('content')

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Detail <b>{{$data->nama_acr}}</b> </h4>
                      <form class="forms-sample">

                        <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" @if($data->cover) src="{{ asset('images/acara/'.$data->cover) }}" @endif />
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nama_acr') ? ' has-error' : '' }}">
                            <label for="nama_acr" class="col-md-4 control-label">Acara</label>
                            <div class="col-md-6">
                                <input id="nama_acr" type="text" class="form-control" name="nama_acr" value="{{ $data->nama_acr }}" readonly="">
                                @if ($errors->has('nama_acr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_acr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group{{ $errors->has('nid') ? ' has-error' : '' }}">
                            <label for="tgl_acara" class="col-md-4 control-label">Tanggal Pelaksanaan</label>
                            <div class="col-md-6">
                                <input id="tgl_acara" type="text" class="form-control" name="tgl_acara" value="{{ $data->tgl_acara }}" readonly>
                                @if ($errors->has('tgl_acara'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_acara') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lokasi') ? ' has-error' : '' }}">
                            <label for="lokasi" class="col-md-4 control-label">Lokasi Acara</label>
                            <div class="col-md-6">
                                <input id="lokasi" type="text" class="form-control" name="lokasi" value="{{ $data->lokasi }}" readonly>
                                @if ($errors->has('lokasi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lokasi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        
                       <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                            <label for="ket" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-6">
                                <input id="ket" type="text" class="form-control" name="ket" value="{{ $data->ket }}" readonly>
                                @if ($errors->has('ket'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ket') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <a href="{{route('acara.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
@endsection