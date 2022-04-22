<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <h2>LAPORAN KEUANGAN</h2>
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
    <tr>
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
    </tr>
  </table>

  <br>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th rowspan="1" class="text-center" width="1%">NO</th>
        <th rowspan="1" class="text-center" width="9%">KODE</th>
        <th rowspan="2" class="text-center" width="9%">TANGGAL</th>
        <th rowspan="2" class="text-center">KATEGORI</th>
        <th rowspan="2" class="text-center">KAS</th>
        <th class="text-center">PEMASUKAN</th>
        <th class="text-center">PENGELUARAN</th>
      </tr>
    </thead>
    <tbody>

      @php
      $no = 1;
      $total_pemasukan_rutin = 0;
      $total_pemasukan_khusus = 0;
      $total_pengeluaran_rutin = 0;
      $total_pengeluaran_khusus = 0;
      @endphp
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
        <td class="text-right">{{ "Rp.".number_format($total_pemasukan_rutin += $total_pemasukan_khusus ).",-" }}</td>
        <td class="text-right">{{ "Rp.".number_format($total_pengeluaran_rutin += $total_pengeluaran_khusus).",-" }}</td>
      </tr>
    </tfoot>
  </table>

  <script type="text/javascript">
    window.print();
  </script>

</body>
</html>
