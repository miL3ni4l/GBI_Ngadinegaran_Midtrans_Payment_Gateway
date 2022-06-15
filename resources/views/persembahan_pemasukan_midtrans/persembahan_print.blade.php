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
                        $id_kategori = $_GET['kategori'];
                        @endphp

                        @if($id_kategori == "")
                        @php
                        $kat = "SEMUA KATEGORI";
                        @endphp
                        @else
                        @php
                        $katt = DB::table('detail_kategori')->where('id',$id_kategori)->first();
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
                  <th class="text-center">NAMA</th>
                  <th class="text-center">JENIS</th>
                  <th class="text-center">NOMINAL</th>
                </tr>
              </thead>

              <tbody>
                @php
                $no = 1;
                $total_pemasukan = 0;
                @endphp

                @foreach($persembahan as $t)

                <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td class="text-left">{{ $t->transaction_id }}</td>
                  <td class="text-center">{{ date('d-m-Y', strtotime($t->updated_at )) }}</td>
                  <td class="text-left">{{ $t->donor_name }}</td>
                  <td>{{ $t->detail_kategori->kategori }}</td>
                  <td class="text-right">
                    {{ "Rp.".number_format($t->amount).",-" }}
                    @php $total_pemasukan += $t->amount; @endphp
                  </td>

                </tr>

                @endforeach

              </tbody>

              <tfoot class="bg-info text-white font-weight-bold">
                <tr>
                  <td colspan="5" class="text-bold text-left bg-secondary">TOTAL PEMASUKAN </td>
                  <td class="text-right bg-primary">{{ "Rp.".number_format($total_pemasukan).",-" }}</td>


                </tr>

              </tfoot>


            </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>