<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
		    table {
    width: 100%;
    }
    
    img {
    	width: 298px;
    	height: 420px;
    	border-radius: 100%;
    }
    .center {
    	text-align: center;
    }
    .badge {
  display: inline-block;
  padding: 0.25em 0.4em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem; }
  .badge-warning {
  color: #212529;
  background-color: #ffaf00; }
  .badge-warning[href]:hover, .preview-list .preview-item .preview-thumbnail [href].badge.badge-busy:hover, .badge-warning[href]:focus, .preview-list .preview-item .preview-thumbnail [href].badge.badge-busy:focus {
    color: #212529;
    text-decoration: none;
    background-color: #cc8c00; }

.badge-success, .preview-list .preview-item .preview-thumbnail .badge.badge-online {
  color: #fff;
  background-color: #00ce68; }
  .badge-success[href]:hover, .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:hover, .badge-success[href]:focus, .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:focus {
    color: #fff;
    text-decoration: none;
    background-color: #009b4e; }
	</style>
  <link rel="stylesheet" href="">
	<title>Laporan Data pemasukan_rutin</title>
</head>
<body>


  
            <!-- ISI LAPORAN -->
            <div class="invoice p-3 mb-3">

              <div class="row invoice-info">

                <div class="col-sm-4 invoice-col" >
                    <table >
                        <tr>
                          <td width="50%"> Petugas  <b>{{ $pengeluaran_khusus->detail_kategori->petugas['nama'] }}</b> </td>
                        </tr>

                        <tr>
                          <td width="50%">Tanggal</td>
                          <td width="5%" class="text-center">:</td>
                          <td> <small class="float-right">  {{ $pengeluaran_khusus->tanggal->format('d-M-Y')}} </small></td>
                        </tr>

                        <!-- <tr>
                          <td width="50%">Data Input</td>
                          <td width="5%" class="text-center">:</td>
                          <td> <small class="float-right">  {{ $pengeluaran_khusus->updated_at->diffForHumans()}} </small></td>
                        </tr> -->


                        <tr>
                          <td width="50%">Kategori</td>
                          <td width="5%" class="text-center">:</td>
                          <td> <small class="float-right">  {{ $pengeluaran_khusus->detail_kategori->kategori }} </small></td>
                        </tr>
                        <tr>
                          <td width="50%">Pembayaran</td>
                          <td width="5%" class="text-center">:</td>
                          <td> <small class="float-right">  {{ $pengeluaran_khusus->kas->kas }} </small></td>
                        </tr>

                        <tr>
                          <td width="50%">Nominal</td>
                          <td width="5%" class="text-center">:</td>
                          <td> <small class="float-right">  {{ "Rp.".number_format($pengeluaran_khusus->nominal).",-" }} </small></td>
                        </tr>


                        <tr>
                          <td width="50%">Keterangan</td>
                          <td width="5%" class="text-center">:</td>
                          <td> 
                            <small class="float-right">  
                                                              @if($pengeluaran_khusus->keterangan  == null)
                                                                  -
                                                              @else
                                                                  {{ $pengeluaran_khusus->keterangan }}
                                                              @endif
                            </small>
                          </td>
                        </tr>

                        <tr>
                          <td width="50%">Status</td>
                          <td width="5%" class="text-center">:</td>
                          <td> 
                            <small class="float-right">  
                                                                @if($pengeluaran_khusus->status == '1')
                                                                  Telah dikonfirmasi
                                                                    @else
                                                                 Masih dalam proses
                                                                 @endif
                          </td>
                        </tr>


                    </table>

                </div>

              </div>

              <!-- <div class="row">
                  <div class="col-12">
                    <h4>
                      <table>
                        <tr>
                            <td width="50%"> 
                            <p class="lead"><b>Pembayaran Via Bank BCA :</b></p>    
                            </td>
                          
                        </tr>
                        <tbody>
                          <tr>
                              <td class="text-center">
                              <img id="img-n" width="450" height="450" style="display:block; margin:auto;" src="img/qris_erickunto.jpeg"/>  
                              </td>
                          </tr>
                        </tbody>
                      </table>
                    </h4>
                  </div>
              </div>
              -->


            </div>
  




</body>
</html>