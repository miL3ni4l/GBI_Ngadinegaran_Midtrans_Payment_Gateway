<!DOCTYPE html>
<html>
<head>
  <title>Laporan Keuangan</title>
  <link rel="stylesheet" href="{{ asset('asset_admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">
</head>
<body>

  <table style="width: 40%">
    <tr>
      <td width="50%">DARI TANGGAL</td>
      <td width="5%" class="text-center">:</td>
      <td>{{ date('d-m-Y',strtotime($_GET['dari'])) }}</td>
    </tr>
    <tr>
      <td width="50%">SAMPAI TANGGAL</td>
      <td width="5%" class="text-center">:</td>
      <td>{{ date('d-m-Y',strtotime($_GET['sampai'])) }}</td>
    </tr>
    <!-- <tr>
      <td width="50%">KAS</td>
      <td width="5%" class="text-center">:</td>
      <td>
        @php
        $id_kas = $_GET['kas'];
        @endphp

        @if($id_kas == "")
        @php
        $kat = "SEMUA KAS";
        @endphp
        @else
        @php
        $katt = DB::table('kas')->where('id',$id_kas)->first();
        $kat = $katt->kas
        @endphp
        @endif

        {{$kat}}
      </td>
    </tr> -->
  </table>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th rowspan="1" class="text-center" width="1%">NO</th>
        <th rowspan="1" class="text-center" width="9%">KODE</th>
        <th rowspan="1" class="text-center" width="9%">TANGGAL</th>
        <th rowspan="1" class="text-center">KATEGORI</th>
        <th rowspan="1" class="text-center">KAS</th>
        <th class="text-center">PEMASUKAN</th>
        <th class="text-center">PENGELUARAN</th>
      </tr>
    </thead>
    <tbody>

      @php
      $no = 1;
      $total_pemasukan_midtrans = 0;
      $total_pengeluaran_midtrans_rutin = 0;
      $total_pengeluaran_midtrans_khusus = 0;
      $total_pemasukan_rutin = 0;
      $total_pemasukan_khusus = 0;
      $total_pengeluaran_rutin = 0;
      $total_pengeluaran_khusus = 0;
      @endphp

        @foreach($persembahan as $t)
                                          <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-left">{{ $t->transaction_id }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($t->updated_at )) }}</td>
                                            <td class="text-left">{{ $t->detail_kategori->kategori }}</td>
                                            <td class="text-left">Midtrans Payment</td>
                                            <td class="text-right">{{ "Rp.".number_format($t->amount).",-" }}</td>
                                            @php $total_pemasukan_midtrans += $t->amount; @endphp
                                            <td class="text-left"></td>
                                          </tr>
        @endforeach

        @foreach($pemasukan_rutin as $t)
          <tr>
            <td class="text-left">{{ $no++ }}</td>
            <td>{{ $t->kode_pemasukan_rutin }}</td>
            <td class="text-left">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
            <td>{{ $t->detail_kategori->kategori }}</td>
            <td>{{ $t->kas->kas }}</td>
            <td class="text-right">{{ "Rp.".number_format($t->nominal).",-" }}</td>
                  @php $total_pemasukan_rutin += $t->nominal; @endphp
            <td class="text-left"></td>
          </tr>
        @endforeach

        @foreach($pemasukan_khusus as $t)
                      <tr>
                        <td class="text-left">{{ $no++ }}</td>
                        <td class="text-left">{{ $t->kode_pemasukan_khusus }}</td>
                        <td class="text-left">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                        <td class="text-left">{{ $t->detail_kategori->kategori }}</td>
                        <td class="text-left">{{ $t->kas->kas }}</td>
                        <td class="text-right">{{ "Rp.".number_format($t->nominal).",-" }}</td>
                        @php $total_pemasukan_khusus += $t->nominal; @endphp
                        <td class="text-left"></td>
                      </tr>
        @endforeach

        @foreach($persembahan_pengeluaran_rutin as $t)
                                          <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-left">{{ $t->kode_persembahan_pengeluaran_rutin }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                                            <td class="text-left">{{ $t->kategori_pengeluaran->kategori }}</td>
                                            <td class="text-left">Midtrans Payment</td>
                                            <td class="text-left"></td>
                                            <td class="text-right">{{ "Rp.".number_format($t->nominal).",-" }}</td>
                                            @php $total_pengeluaran_midtrans_rutin += $t->nominal; @endphp
                                          </tr>
        @endforeach

        @foreach($pengeluaran_rutin as $t)
                      <tr>
                        <td class="text-left">{{ $no++ }}</td>
                        <td class="text-left">{{ $t->kode_pengeluaran_rutin }}</td>
                        <td class="text-left">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                        <td class="text-left">{{ $t->kategori_pengeluaran->kategori }}</td>
                        <td class="text-left">{{ $t->kas->kas }}</td>
                        <td class="text-left"></td>
                        <td class="text-right">{{ "Rp.".number_format($t->nominal).",-" }}</td>
                        @php $total_pengeluaran_rutin += $t->nominal; @endphp
                      </tr>
        @endforeach

        @foreach($persembahan_pengeluaran_khusus as $t)
                                          <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-left">{{ $t->kode_persembahan_pengeluaran_khusus }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                                            <td class="text-left">{{ $t->detail_kategori->kategori }}</td>
                                            <td class="text-left">Midtrans Payment</td>
                                            <td class="text-left"></td>
                                            <td class="text-right">{{ "Rp.".number_format($t->nominal).",-" }}</td>
                                            @php $total_pengeluaran_midtrans_khusus += $t->nominal; @endphp
                                          </tr>
        @endforeach

        @foreach($pengeluaran_khusus as $t)
                      <tr>
                        <td class="text-left">{{ $no++ }}</td>
                        <td class="text-left">{{ $t->kode_pemasukan_rutin }}</td>
                        <td class="text-left">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                        <td class="text-left">{{ $t->detail_kategori->kategori }}</td>
                        <td class="text-left">{{ $t->kas->kas }}</td>
                        <td class="text-left"></td>
                        <td class="text-right">{{ "Rp.".number_format($t->nominal).",-" }}</td>
                        @php $total_pengeluaran_khusus += $t->nominal; @endphp
                      </tr>
        @endforeach


    </tbody>
    <tfoot>
      <tr>
        <td colspan="5" class="text-bold text-right">TOTAL</td>
        <td class="text-right">{{ $total_pemasukan_rutin += $total_pemasukan_khusus += $total_pemasukan_midtrans }}</td>
        <td class="text-right">{{ $total_pengeluaran_rutin += $total_pengeluaran_khusus +=  $total_pengeluaran_midtrans_rutin +=  $total_pengeluaran_midtrans_khusus }}</td>
      </tr>
    </tfoot>
  </table>

</body>
</html>
