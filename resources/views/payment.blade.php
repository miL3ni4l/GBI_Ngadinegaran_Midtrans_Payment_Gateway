@extends('layouts2.utama')
@section('title', '- Profil')

@section('content') 

<section class="content-header">
    <div class="container-fluid">
        <div class="row">


                <div class=" table-responsive col-md-12 col-sm-12 col-12">
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            <div class="row">


                                    
                                                    <head>
                                                      <meta name="viewport" content="width=device-width, initial-scale=1">
                                                      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
                                                      <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
                                                      <script type="text/javascript"
                                                        src="https://app.sandbox.midtrans.com/snap/snap.js"
                                                        data-client-key="SB-Mid-client-Ocug8xf5kY2S7JUN"></script>
                                                      <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
                                                      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                                                    </head>
                                                  
                                                    <div class="col-lg-4 mx-auto">
                                                        <div class="invoice p-3 mb-3">
                                                          <div class="row">
                                                          <button class="btn btn-warning submit-btn btn-block" id="pay-button">Lanjutkan Pembayaran</button>
                                                          </div> 
                                                          </br>
                                                          <div class="row float-right ">
                                                            <a  data-toggle="modal" data-target="#modalDelete"  class="btn btn-danger btn-sm text-center" >
                                                                <i class="fas fa-close text-center"></i> batal
                                                            </a>

                                                            <!-- Modal -->
                                                            <form action="/">
                                                                                              <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                                                                                  <div class="modal-dialog" role="document">
                                                                                                      <div class="modal-content">

                                                                                                        <div class="modal-header bg-warning">
                                                                                                          <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                                                                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                          </button>
                                                                                                        </div>

                                                                                                        <div class="modal-body">
                                                                                                        

                                                                                                          <div class="form-group">
                                                                                                              <label class="label">Apakah anda yakin batal melakuakan transaksi ?</label>
                                                                                                              
                                                                                                          </div>

                                                                                                          <div class="form-group">
                                                                                                            <div class="input-group">
                                                                                                              <button class="btn btn-primary submit-btn btn-block" type="submit">Ya</button>
                                                                                                        
                                                                                                              </div>
                                                                                                        
                                                                                                            </div>

                                                                                                        </div>
                                                                                                        
                                                                                                      </div>
                                                                                                  </div>
                                                                                              </div>
                                                                                      </form>





                                                          </div> 
                                                          </br>
                                                        </div>              
                                                    </div>



                                        
                                                    <!-- Modal -->
                                                    <!-- <form action="" id="submit_form" method="POST">
                                                    {{ csrf_field() }}
                                                        <input type="hidden" name="json" id="json_callback">
                                                    </form> -->
                                
                            
                            

                            </div>              
                        </div>  
                    </div>              
                </div>


        </div>              
    </div>
</section>


<script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snap_token}}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_to_form(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_to_form(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_to_form(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });

      function send_response_to_form(result){
        document.getElementById('json_callback').value = JSON.stringify(result);
        $('#submit_form').submit();
      }
    </script>
@endsection