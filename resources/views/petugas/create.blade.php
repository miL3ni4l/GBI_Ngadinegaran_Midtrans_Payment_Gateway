@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            "iDisplayLength": 10
        });

    });
</script>
@stop
@extends('layouts2.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-6">
                <h4>Tambah Petugas</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/petugas">Petugas</a></li>
                    <li class="breadcrumb-item active">Tambah Petugas</li>
                </ol>
            </div>
            <div class=" table-responsive col-md-12 col-sm-6 col-12">
                <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
                    <div class="align-items-center">


                        <div class="col-lg-6 mx-auto">
                            <form method="POST" action="{{ route('petugas.store') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group{{ $errors->has('kode_petugas') ? ' has-error' : '' }}">

                                                <label for="kode_petugas" class="col-md-7 control-label">Kode Petugas <b style="color:Tomato;">*</b> </label>
                                                <div class="col-md-12">
                                                    <input id="kode_petugas" type="text" class="form-control" name="kode_petugas" value="{{ $kode }}" readonly="">
                                                    @if ($errors->has('kode_petugas'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('kode_petugas') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="container  col-md-12">
                                                <label>Akun <b style="color:Tomato;">*</b></label>
                                                <select required="required" name="user_id" class="custom-select mb-3">
                                                    <option value="">-- Pilih Akun --</option>
                                                    @php
                                                    $no = 1;
                                                    @endphp

                                                    @foreach($users as $u)
                                                    <option value="{{$u->id}}"> {{ $no++ }}. [{{$u->level}}]-{{$u->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                                <label for="nama" class="col-md-12 control-label">Nama Petugas <b style="color:Tomato;">*</b> </label>
                                                <div class="col-md-12">
                                                    <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Petugas . . ." required>
                                                    @if ($errors->has('nama'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('nama') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="container  col-md-12">
                                                <label>Jenis Kelamin <b style="color:Tomato;">*</b></label>
                                                <select required="required" name="jk" class="custom-select mb-3">
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                                                <label for="alamat" class="col-md-12 control-label">Alamat <b style="color:Tomato;">*</b> </label>
                                                <div class="col-md-12">
                                                    <input id="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat Petugas . . ." required>
                                                    @if ($errors->has('alamat'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('alamat') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group col-md-12">
                                                <label>No Telp <i>(kosongkan jika tidak ada)</i> </label>
                                                <input type="number" class="form-control" name="no_telp" autocomplete="off" placeholder="Masukkan No Telp . . .">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success col-md-4 float-right" id="submit">Submit </button>
                                                &nbsp;
                                                <button type="reset" class="btn btn-danger col-md-2 float-left"> Reset </button>
                                            </div>
                                        </div>

                                        <!-- <div class="col-12">
                                <div class="form-group col-md-12">
                    
                                    <button type="submit" class="btn btn-success col-md-4 float-right" id="submit" >
                                                        Simpan
                                    </button>
                                    &nbsp;
                                    <button type="reset" class="btn btn-danger col-md-2 float-left">
                                                                Reset
                                    </button>
                                    
                                    <a href="{{route('petugas.index')}}" class="btn btn-black mb1 black bg-gray pull-right col-md-4">Back</a>
                                </div>
                            </div> -->

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection