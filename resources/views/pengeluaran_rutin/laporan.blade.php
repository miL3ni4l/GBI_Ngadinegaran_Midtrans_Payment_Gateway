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
	<title>Laporan Data Pengeluaran Rutin</title>
</head>
<body>

              <div style="Margin:0;box-sizing:border-box;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">

                      <table style="Margin:0;background:#f3f3f3;border-collapse:collapse;border-spacing:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;height:100%;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
                          <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                            <td align="center" valign="top" style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                              <center style="min-width:580px;width:100%">
                                <table style="Margin:0 auto;background:#fefefe;background-color:#fff;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px">
                                  <tbody>
                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                      <td style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                        <table style="border-collapse:collapse;border-spacing:0;border-top:6px solid #e6e6e6;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                          <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                              <th style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                  <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                      <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody>
                                                          <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="10px" style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;line-height:10px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&nbsp;</td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                      <h1 style="Margin:0;Margin-bottom:10px;color:inherit;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:42px;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">GBI NGADINEGARAN</h1>
                                                                                      <h3 style="Margin:0;Margin-bottom:10px;color:inherit;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:28px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">IDR  {{ "Rp.".number_format($pengeluaran_rutin->nominal).",-" }}</h3>
                                                      <p style="Margin:10px 0!important;Margin-bottom:10px;background-color:#d8d8d8;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;height:1px;line-height:19px;margin:10px 0!important;margin-bottom:10px;max-height:1px;max-width:200px;padding:0;text-align:left;width:200px"></p>
                                                      <h6 style="Margin:0;Margin-bottom:10px;color:inherit;display:inline-block;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:18px;font-style:italic;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;margin-right:15px;padding:0;text-align:left;word-wrap:normal">
                                                                                        {{ $pengeluaran_rutin->kas->kas }}
                                                                                          </h6>
                                                                                                                    </th>
                                                    <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;width:0"></th>
                                                  </tr>
                                                </tbody></table>
                                              </th>
                                            </tr>
                                          </tbody>
                                        </table>
                                                          <table align="center" style="background-color:#e6e6e6;border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                          <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                            <td style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                              <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top">
                                                <tbody>
                                                  <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td height="10px" style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;line-height:10px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&nbsp;</td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                              <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                                <tbody>
                                                  <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:10px;text-align:left;width:270px">
                                                      <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                                          <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                            <p style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">{{ $pengeluaran_rutin->tanggal->format('d-M-Y')}}</p>
                                                          </th>
                                                        </tr>
                                                      </tbody></table>
                                                    </th>
                                                    <th style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:10px;padding-right:20px;text-align:left;width:270px">
                                                      <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                                          <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                            <p style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:right">KODE TRANSAKSI : {{ $pengeluaran_rutin->kode_pengeluaran_rutin}}</p>
                                                          </th>
                                                        </tr>
                                                      </tbody></table>
                                                    </th>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody></table>
                                                          <table align="center" style="background-color:#4caf50;border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                          <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                            <td style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                              <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                                <tbody>
                                                  <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                                      <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                                          <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                            <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                              <tbody>
                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                  <td height="10px" style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;line-height:10px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&nbsp;</td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                            @if($pengeluaran_rutin->status == '1')
                                                            <p style="Margin:0;color:#fff;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0!important;padding:0;text-align:center">
                                                              <strong> 
                                                                                        TRANSAKSI BERHASIL
                                                              </strong>
                                                            </p>
                                                            @else
                                                            <p style="Margin:0;color:#FF0000;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0!important;padding:0;text-align:center">
                                                              <strong> 
                                                                                        SEDANG DALAM PROSES
                                                              </strong>
                                                            </p>
                                                            @endif
                                                          </th>
                                                          <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;width:0"></th>
                                                        </tr>
                                                      </tbody></table>
                                                    </th>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody></table>

                                                          <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                          <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                              <th style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                  <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                      <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody>
                                                          <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="30px" style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:30px;font-weight:400;line-height:30px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&nbsp;</td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                      <p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                        Petugas {{ $pengeluaran_rutin->kategori_pengeluaran->petugas['nama'] }},<br><br>
                                                        @if($pengeluaran_rutin->keterangan  == null)
                                                                                        -
                                                                                    @else
                                                                                        {{ $pengeluaran_rutin->keterangan }}
                                                                                    @endif                             </p>
                                                    </th>
                                                    <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;width:0"></th>
                                                  </tr>
                                                </tbody></table>
                                              </th>
                                            </tr>
                                          </tbody>
                                        </table>
                                    
                                        
                                                          <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                          <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                              <th style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                  <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                      <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody>
                                                          <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="10px" style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;line-height:10px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&nbsp;</td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                      <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                                          <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:19px;margin:0;padding:0;padding-bottom:10px;text-align:left">Deskripsi</th>
                                                          <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:19px;margin:0;padding:0;padding-bottom:10px;text-align:right">Harga</th>
                                                        </tr>
                                                        
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                          <td style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:19px;margin:0;padding:10px 0;text-align:left;vertical-align:top;word-wrap:break-word">{{ $pengeluaran_rutin->kategori_pengeluaran->kategori }}</td>
                                                          <td style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:19px;margin:0;padding:10px 0;text-align:right;vertical-align:top;word-wrap:break-word">{{ "Rp.".number_format($pengeluaran_rutin->nominal).",-" }}</td>
                                                        </tr>
                                                      </tbody></table>
                                                    </th>
                                                    <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;width:0"></th>
                                                  </tr>
                                                </tbody></table>
                                              </th>
                                            </tr>
                                          </tbody>
                                        </table>
                                    
                                        
                                        
                                        
                                        <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                          <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                              <td><table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top">
                                                <tbody>
                                                  <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td height="50px" style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:50px;font-weight:400;line-height:50px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&nbsp;</td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td></tr>
                                          </tbody>
                                        </table>

                                        <table align="center" style="background-color:#f3f3f3;border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                          <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                            <td style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                              <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                                <tbody>
                                                  <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                                      <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody><tr style="padding:0;text-align:left;vertical-align:top">
                                                          <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                            <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                              <tbody>
                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                  <td height="30px" style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:30px;font-weight:400;line-height:30px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&nbsp;</td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                            <p style="Margin:0;Margin-bottom:10px;color:#777;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:13px;font-weight:400;line-height:19px;margin:0;margin-bottom:10px;padding:0;text-align:center">Untuk informasi lebih lanjut , silahkan hubungi:<br>
                                                            email: <a href="mailto:gbingadinegaran.production@gmail.com" style="Margin:0;color:#00b4ed;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none" target="_blank">gbingadinegaran@<wbr>gmail.com</a> | phone: 0878-7055-2929</p>
                                                          </th>
                                                          <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;width:0"></th>
                                                        </tr>
                                                      </tbody></table>
                                                    </th>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody></table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center>
                            </td>
                          </tr>
                        </tbody>
                      </table>
            
               
              </div>

</body>
</html>

