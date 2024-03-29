

@extends('layouts2.utama')
@section('title', '- Profil')

@section('content') 

<section class="content-header">
    <div class="container-fluid">
        <div class="row">

                <div class="col-lg-12 text-center">
                    <h4 class="section-heading text-uppercase">PERSEMBAHAN</h4><br>
                </div>



                <div class=" table-responsive col-md-12 col-sm-12 col-12">
                    <div class="card card-solid" class="alert alert-secondary center-block">

     


                                        <div class="col-lg-4 mx-auto">
                                            <div class="row">

                                                    <div class="container">
                                                        <form action="#" id="donation_form">

                                                                <div class="row">

                                                                    <!-- <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Nama</label>
                                                                            <input type="text" name="donor_name" class="form-control" id="donor_name">
                                                                        </div>
                                                                    </div> -->

                                                                    <div class="col-12">
                                                                        <div class="form-group{{ $errors->has('donor_name') ? ' has-error' : '' }}">
                                                                                <label for="donor_name" class="control-label">Nama <b style="color:Tomato;">*</b> </label>
                                                                            
                                                                                    <input id="donor_name" type="text" class="form-control" name="donor_name" value="{{ old('donor_name') }}" placeholder="Masukkan nama . . ."required>
                                                                                    @if ($errors->has('donor_name'))
                                                                                        <span class="help-block">
                                                                                            <strong>{{ $errors->first('donor_name') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                    
                                                                        </div>
                                                                    </div>


                                                                    <!-- <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">E-Mail</label>
                                                                            <input type="email" name="donor_email" class="form-control" id="donor_email">
                                                                        </div>
                                                                    </div> -->

                                                                    <div class="col-12">
                                                                        <div class="form-group{{ $errors->has('donor_email') ? ' has-error' : '' }}">
                                                                                <label for="donor_email" class="control-label">Email <b style="color:Tomato;">*</b> </label>
                                                                        
                                                                                    <input id="donor_email" type="text" class="form-control" name="donor_email" value="{{ old('donor_email') }}" placeholder="Masukkan email . . ."required>
                                                                                    @if ($errors->has('donor_email'))
                                                                                        <span class="help-block">
                                                                                            <strong>{{ $errors->first('donor_email') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                        
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                    
                                                                        <label>Jenis Persembahan <b style="color:Tomato;">*</b></label>
                                                                                                    <!-- <select required="required" name="jk" class="custom-select mb-3" > -->
                                                                                                    <select name="donation_type" class="form-control" id="donation_type"  class="custom-select mb-3">
                                                                                                       
                                                                                                        <option value="">-- Pilih Jenis Persembahan --</option>  
                                                                                                    <!-- @foreach($kategoris as $k)
                                                                                                        <option value="{{$k->id = $k->kategori }}">{{$k->kategori}}</option>
                                                                                                      
                                                                                                    @endforeach -->
                                                                                                        <!-- <option value="Kolekte">Kolekte</option> -->
                                                                                                   
                                                                                                    </select>
                                                                                        
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                                                                <label for="amount" class="control-label">Nominal <b style="color:Tomato;">*</b> </label>
                                                                            
                                                                                    <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="Masukkan nominal . . ."required>
                                                                                    @if ($errors->has('amount'))
                                                                                        <span class="help-block">
                                                                                            <strong>{{ $errors->first('amount') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                            
                                                                        </div>
                                                                    </div>


                                                                </div>


                                                                <div class="row">
                                                                    <!-- <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Jumlah</label>
                                                                            <input type="number" name="amount" class="form-control" id="amount">
                                                                        </div>
                                                                    </div> -->



                                                                    <div class="form-group col-md-12 ">
                                                                        <label for="email" class="control-label">Keterangan <i>(kosongkan jika tidak ada)</label>
                                                                    
                                                                            <textarea id="inputDescription"  name="keterangan" class="form-control col-md-12"  placeholder="Masukkan keterangan . . ." rows="3"></textarea>

                                                                    </div>
                                                                                                    

                                                                    <div class="form-group col-md-12">
                                                                        
                                                                            <button type="submit" class="btn btn-success col-md-12 float-right" id="submit" >Kirim </button>     
                                                                    </div>


                                                                </div>

                                                                <!-- <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <button class="btn btn-primary" type="submit">Kirim</button>
                                                                        </div>
                                                                    </div>
                                                                </div> -->

                                                        </form>
                                                    </div>



                                                <script src="https://code.jquery.com/jquery-3.4.1.min.js">
                                                </script>
                                                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js">
                                                </script>
                                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js">
                                                </script>
                                                <script src="{{
                                                    !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
                                                    data-client-key="{{ config('services.midtrans.clientKey')
                                                }}"></script>
                                                <script>
                                                    $("#donation_form").submit(function(event) {
                                                        event.preventDefault();

                                                        $.post("/api/donation", {
                                                            _method: 'POST',
                                                            _token: '{{ csrf_token() }}',
                                                            donor_name: $('input#donor_name').val(),
                                                            donor_email: $('input#donor_email').val(),
                                                            donation_type: $('select#donation_type').val(),
                                                            amount: $('input#amount').val(),
                                                            note: $('textarea#note').val(),
                                                        },

                                                        function (data, status) {
                                                            console.log(data);
                                                            snap.pay(data.snap_token, {
                                                                // Optional
                                                                onSuccess: function (result) {
                                                                    console.log(JSON.stringify(result, null, 2));
                                                                    location.replace('/');
                                                                },
                                                                // Optional
                                                                onPending: function (result) {
                                                                    console.log(JSON.stringify(result, null, 2));
                                                                    location.replace('/');
                                                                },
                                                                // Optional
                                                                onError: function (result) {
                                                                    console.log(JSON.stringify(result, null, 2));
                                                                    location.replace('/');
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                    })
                                                </script>

                                            </div>              
                                        </div>  
 
                    </div>              
                </div>
        </div>              
    </div>
</section>


@endsection
