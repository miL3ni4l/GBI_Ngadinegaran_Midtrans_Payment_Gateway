<!DOCTYPE html>
<html>
<head>
  <title>Laporan Keuangan ASAL</title>
  <link rel="stylesheet" href="{{ asset('asset_admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">
</head>
<body>

  <center>
    <h4>LAPORAN KEUANGAN</h4>
  </center>

  <table>
    <tr>
      <td>DARI TANGGAL</td>
      <td>:</td>
      <td>{{ date('d-m-Y',strtotime($_GET['dari'])) }}</td>
    </tr>
    <tr>
      <td>SAMPAI TANGGAL</td>
      <td>:</td>
      <td>{{ date('d-m-Y',strtotime($_GET['sampai'])) }}</td>
    </tr>
    <tr>
      <td>KATEGORI</td>
      <td>:</td>
      <td>
        @php
        $id_kas = $_GET['kas'];
        @endphp

        @if($id_kas == "")
        @php
        $kat = "SEMUA KATEGORI";
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

  <table>
    <thead>
      <tr>
        <th rowspan="2">NO</th>
        <th rowspan="2">TANGGAL</th>
        <th rowspan="2">KATEGORI</th>
        <th rowspan="2">KAS</th>
        <th rowspan="2">KETERANGAN</th>
        <th colspan="2">JENIS</th>
      </tr>
      <tr>
        <th>PEMASUKAN</th>
        <th>PENGELUARAN</th>
      </tr>
    </thead>
    <tbody>
      @php
      $no = 1;
      $total_pemasukan = 0;
      $total_pengeluaran = 0;
      @endphp
      @foreach($transaksi as $t)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
        <td>{{ $t->detail_kategori->kategori }}</td>
        <td>{{ $t->kas->kas }}</td>
        <td>{{ $t->keterangan }}</td>
        <td>
          @if($t->jenis == "Pemasukan")
          {{ "Rp.".number_format($t->nominal).",-" }}
          @php $total_pemasukan += $t->nominal; @endphp
          @else
          {{ "-" }}
          @endif
        </td>
        <td>
          @if($t->jenis == "Pengeluaran")
          {{ "Rp.".number_format($t->nominal).",-" }}
          @php $total_pengeluaran += $t->nominal; @endphp
          @else
          {{ "-" }}
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4">TOTAL</td>
        <td>{{ "Rp.".number_format($total_pemasukan).",-" }}</td>
        <td>{{ "Rp.".number_format($total_pengeluaran).",-" }}</td>
      </tr>
    </tfoot>
  </table>

</body>
</html>
