<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <h2>LAPORAN PERSEMBAHAN ONLINE</h2>
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
        <td width="50%">KATEGORI</td>
                      <th width="5%" class="text-center">:</th>
                      <td>
                        @php
                        $id_kategori = $_GET['kategori_pengeluaran'];
                        @endphp

                        @if($id_kategori == "")
                        @php
                        $kat = "SEMUA KATEGORI";
                        @endphp
                        @else
                        @php
                        $katt = DB::table('detail_pengeluaran')->where('id',$id_kategori)->first();
                        $kat = $katt->kategori
                        @endphp
                        @endif

                        {{$kat}}
                      </td>
                    </tr>

    </table>

    <br>

    <table class="table table-striped">
              <thead>
                <tr>
                  <th class="text-center">NO</th>
                  <th class="text-center">KODE</th>
                  <th class="text-center">TANGGAL</th>
                  <th class="text-center">DARI KATEGORI</th>
                  <th class="text-center">KATEGORI</th>
                  <th class="text-center">KETERANGAN</th>

                  <th class="text-center">NOMINAL</th>

                </tr>
              </thead>

              <tbody>
                @php
                $no = 1;
                $total_pemasukan = 0;
                $total_pengeluaran = 0;
                @endphp

                @foreach($pengeluaran_rutin as $t)

                <tr>
                  <td class="text-center">{{ $no++ }}</td>

                  <td class="text-left">{{ $t->kode_persembahan_pengeluaran_rutin }}</td>

                  <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                  <td>{{ $t->nama_kategori->kategori }}</td>
                  <td>{{ $t->kategori_pengeluaran->kategori }}</td>





                  @if($t->keterangan == null)
                  <td class="text-center"> -</td>
                  @else
                  <td>
                    <i>{{ $t->keterangan }}</i>
                  </td>
                  @endif


                  <td class="text-right">
                    {{ "Rp.".number_format($t->nominal).",-" }}
                    @php $total_pemasukan += $t->nominal; @endphp

                  </td>
                </tr>

                @endforeach
              </tbody>

              <tfoot class="bg-info text-white font-weight-bold">
                <tr>
                  <td colspan="6" class="text-bold text-left bg-secondary">TOTAL PEMASUKAN </td>

                  <td class="text-right bg-primary"><b>{{ "Rp.".number_format($total_pemasukan).",-" }}</b></td>

                </tr>
              </tfoot>

            </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>