@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 10
    });

} );
</script>
@stop
@extends('layouts2.app')

@section('content')


<div class="content-header">
      <div class="container-fluid">
        <div class="row">

        <div class="col-md-12 col-sm-12 col-12">
            <div class="col-sm-12">
            <a href="{{ route('kategori.create') }}" class="btn btn-primary  btn-fw col-lg-2"><i class="fa fa-plus"></i> Tambah Kategori</a>  
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Kategori</li>
              
            </ol>
            </div>
        </div>    


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>




<section class="content-header">
      <div class="container-fluid">
        <div class="row">



<h1>TIDAK ADA PESAN !!!</h1>


        </div>
        </div>
        </div>
      </div><!-- /.container-fluid -->
</section>





@endsection


