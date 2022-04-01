@extends('layouts2.app')
@section('content')

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 350px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
</head>


<body>

<div class="card-body">
<div class="card">
                          @if($data->foto)
                            <img src="{{url('images/user', $data->foto)}}" alt="image" style="margin-right: 1px;" width="125" height="125" class="img-circle img-fluid" />
                          @else
                          <img src="{{url('/adminlte/img/avatar4.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"style="margin-right: 1px;" width="125" height="125" class="img-circle img-fluid">

                          @endif  
  

  <p class="title"><h4>{{ $data->name }}</h4></p>
  <p>{{ $data->level }}</p>
  <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <span class="description-text">USERNAME</span>
                    <h6 class="description-header">{{ $data->username }}</h6>
                      
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                     <span class="description-text">EMAIL</span> 
                    <h6 class="description-header">{{ $data->email }}</h6>
                      
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                 
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <button class="btn btn-white">
              <a href="{{ route('user.index') }} " class="btn btn-success  btn-fw col-lg-12" >Kembali</a>
              </button>

</div>
</div>
</body>
</html>




@endsection
