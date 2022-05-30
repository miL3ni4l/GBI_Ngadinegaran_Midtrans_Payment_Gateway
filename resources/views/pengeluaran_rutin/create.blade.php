@section('js')

<script type="text/javascript">
            $(document).on('click', '.pilih', function (e) {
                document.getElementById("acara_judul").value = $(this).attr('data-acara_judul');
                document.getElementById("acara_id").value = $(this).attr('data-acara_id');
                $('#myModal').modal('hide');
            });

            $(document).on('click', '.pilih_kas', function (e) {
                document.getElementById("kas_id").value = $(this).attr('data-kas_id');
                document.getElementById("kas_nama").value = $(this).attr('data-kas_nama');
                $('#myModal2').modal('hide');
            });
          
             $(function () {
                $("#lookup, #lookup2").dataTable();
            });

</script>

@stop

@section('css')

@stop

@extends('layouts2.app')

@section('content')
<form method="POST" action="{{ route('pengeluaran_rutin.store') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<section class="content-header">
  <div class="container-fluid">
    <div class="row">


          
                <div class="container-fluid">
                  <div class="row mb-2">

                    <div class="col-sm-6">
                      <h1>Tambah Pengeluaran Rutin</h1>
                    </div>
                    
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="/home">Home</a></li>
                          <li class="breadcrumb-item active"><a href="/pengeluaran_rutin"> Pengeluaran Rutin</a></li>
                          <li class="breadcrumb-item active">Tambah  Pengeluaran Rutin</li>
                        </ol>
                    </div>

                  

                  </div>
                </div>

                    <!-- MODAL NOTIFIKASI -->
                   
                @if (Session::has('message'))
                <div class=" table-responsive col-md-12 col-sm-12 col-12" > 

                    <div class="alert alert-{{ Session::get('message_type') }}">
                    {{ Session::get('message') }}
                    </div>
     
                </div>
                @endif

              <div class=" table-responsive col-md-6 col-sm-12 col-12"> 
             
              <!--area ditambah-->   
              <!--area diisi-->         
                    <div class="card card-secondary">
                      <div class="card-body">
                  
                                <!--area ditambah   -->
                              
                                              
                                
                                              <div class="form-group{{ $errors->has('kode_pengeluaran_rutin') ? ' has-error' : '' }}">
                                                    
                                                    <label for="kode_pengeluaran_rutin" class="col-md-7 control-label">Kode Pengeluaran Rutin <b style="color:Tomato;">*</b> </label>
                                                    <div class="col-md-12">
                                                        <input id="kode_pengeluaran_rutin" type="text" class="form-control" name="kode_pengeluaran_rutin" value="{{ $kode }}" readonly="">
                                                        @if ($errors->has('kode_pengeluaran_rutin'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('kode_pengeluaran_rutin') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                              </div>

                                              <div class="form-group{{ $errors->has('nama_pengguna') ? ' has-error' : '' }}">
                                                    
                                                    <!-- <label for="nama_pengguna" class="col-md-7 control-label">Nama Pengguna <b style="color:Tomato;">*</b> </label> -->
                                                    <div class="col-md-12">
                                                        <input id="nama_pengguna" type="hidden" class="form-control" name="nama_pengguna" value="{{ $nama }}" readonly="">
                                                        @if ($errors->has('nama_pengguna'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('nama_pengguna') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                              <div class="form-group col-md-12">
                                                <label>Tanggal <b style="color:Tomato;">*</b></label>
                                                <input type="date"  class="form-control datepicker2" value="{{ date('Y-m-d') }}"  required="required" name="tanggal"  autocomplete="off" placeholder="Masukkan tanggal ..">
                                              </div>
                                          

                                              <div class="container  col-md-12">                               
                                                <label>Dari Kategori <b style="color:Tomato;">*</b></label>
                                                <select required="required" name="kategori" class="custom-select mb-3" >
                                                  <option value="">-- Pilih Kategori --</option>
                                                  @foreach($kategoris as $k)
                                                      <?php 
                                                          $id_kategori = $k->id;
                                                          // $pemasukan_persembahan = DB::table('persembahan')
                                                          // ->select(DB::raw('SUM(amount) as total'))
                                                          // ->where('donation_type',$id_kategori)
                                                          // ->where('status','success')
                                                          // ->first(); 

                                                          $pemasukan_perkategori = DB::table('pemasukan_rutin')
                                                          ->select(DB::raw('SUM(nominal) as total'))
                                                          ->where('kategori_id',$id_kategori)
                                                          ->where('status','1')
                                                          ->first();

                                                          $pengeluaran_perkategori_rutin = DB::table('pengeluaran_rutin')
                                                          ->select(DB::raw('SUM(nominal) as total'))
                                                          ->where('kategori_id',$id_kategori)
                                                          ->where('status','1')
                                                          ->first();

                                                      ?>
                                                      
                                                      <option value="{{ $k->id }}">
                                                       {{ $k->kategori }}
                                                       {{ "Rp. ".number_format( $pemasukan_perkategori->total -= $pengeluaran_perkategori_rutin->total)." ,-" }}
                                                      </option>
                                             
                                                  @endforeach 
                                                </select>
                                              </div>

                                              <div class="container  col-md-12">                               
                                                <label>Kategori Pengeluaran <b style="color:Tomato;">*</b></label>
                                                <select required="required" name="detail_pengeluaran" class="custom-select mb-3" >
                                                  <option value="">-- Pilih Kategori Pengeluaran --</option>
                                                  @foreach($detail_pengeluarans as $k) 

                                                      <option value="{{ $k->id }}">
                                                       {{ $k->kategori }}
                                                      </option>
                                             
                                                  @endforeach 
                                                </select>
                                              </div>
                                              
                                              <div class="col-md-12">                               
                                                <label>Kas <b style="color:Tomato;">*</b></label>
                                                <select required="required" name="kas" class="custom-select mb-3" >
                                                  <option value="">-- Pilih Kas --</option>
                                                  @foreach($kass as $k)

                                                  <?php 
                                                      $id_kas = $k->id;
                                                      $pemasukan_perkas = DB::table('pemasukan_rutin')
                                                      ->select(DB::raw('SUM(nominal) as total'))
                                                      ->where('kas_id',$id_kas)
                                                      ->where('status','1')
                                                      ->first();

                                                      $pengeluaran_perkas_rutin = DB::table('pengeluaran_rutin')
                                                      ->select(DB::raw('SUM(nominal) as total'))
                                                      ->where('kas_id',$id_kas)
                                                      ->where('status','1')
                                                      ->first();

                                                      

                                                  ?>

                                                  <option value="{{ $k->id }}">
                                                    {{ $k->kas }} 
                                                    {{ "Rp. ".number_format($pemasukan_perkas->total -= $pengeluaran_perkas_rutin->total)." ,-" }}
                                                  </option>

                                                  @endforeach

                                                 
                                                </select>
                                              </div>
                                           

                                              <div class="form-group col-md-12">
                                                <label>Nominal<b style="color:Tomato;">*</b></label>
                                                <input type="number" class="form-control" required="required" name="nominal" autocomplete="off" placeholder="Masukkan Nominal . . .">
                                              </div>

                                              <div class="container  col-md-12">                               
                                                <label>Status <b style="color:Tomato;">*</b></label>
                                                <select required="required" name="status" class="custom-select mb-3" >
                                                  <option value="">-- Pilih Status --</option>
                                                  <option value="0">Belum Diterima</option>
                                                  <option value="1">Sudah Diterima</option>
                                                </select>
                                              </div>
                                              

                      </div>
                    </div>

                    
              </div>

              <div class=" table-responsive col-md-6 col-sm-12 col-12"> 
             
              <!--area ditambah-->   
              <!--area diisi-->         
                    <div class="card card-secondary">
                      <div class="card-body">
                  
                                <!--area ditambah   -->
                              

                                              <div class="form-group col-md-12">
                                                        <label for="email" class="col-md-12 control-label">Bukti Pengeluaran Rutin <i>(kosongkan jika tidak ada)</i> </label>
                                                        
                                                        <div class="col-md-12">
                                                            <img width="300" height="300" />
                                                            <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
                                                        </div>
                                              </div>

                                              <div class="form-group col-md-12 ">
                                                <label for="email" class="col-md-12 control-label">Keterangan <i>(kosongkan jika tidak ada)</label>
                                                  <div class="col-md-12">
                                                    <textarea id="inputDescription"  name="keterangan" class="form-control col-md-12"  placeholder="Masukkan keterangan (Opsional) . . ." rows="3"></textarea>
                                                  </div>
                                              </div>

                                              <div class="form-group col-md-12">
                                                  <div class="col-md-12">
                                                    <button type="submit" class="btn btn-success col-md-2 float-right" id="submit" >Submit </button>     
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-danger col-md-4 float-left"> Reset </button>
                                                  </div>
                                              </div>
                                

                      </div>
                    </div>

                    
              </div>


    </div>
  </div><!-- /.container-fluid -->
</section>
</form>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Donatur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                  <th width="1%">NO</th>
                  <th class="text-center">METODE PEMBAYARAM</th>
                  <th class="text-center" >UPDATE</th>
              
                  </tr>
                      </thead>
                      <tbody>
              @php
              $no = 1;
              @endphp
              @foreach($kass as $k)
              <tr>
                <td class="text-left">{{ $no++ }}</td>
                <td>{{ $k->kas }}</td>
                <td class="text-left">{{ $k->updated_at }}</td>
               
              </tr>
              @endforeach
            </tbody>
                        </table>  
                  </div>
                </div>
            </div>
</div>           
  
@endsection


