<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <h2>LAPORAN PERSEMBAHAN ONLINE</h2>
    <link rel="stylesheet" href="{{ asset('asset_admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">
</head>

<body>



    <table class="col-12 float-right">
        <h4>
            <div class="col-12">
                <div class="invoice-col">
                    <tr>
                        <th width="175">DARI TANGGAL</th>
                        <th width="2%" class="text-left">:</th>
                        <td class="text-left">{{ date('d-m-Y',strtotime($_GET['dari'])) }}</td>
                    </tr>
                    <tr>
                        <th width="175">SAMPAI TANGGAL</th>
                        <th width="2%" class="text-left">:</th>
                        <td class="text-left">{{ date('d-m-Y',strtotime($_GET['sampai'])) }}</td>
                    </tr>
                    <tr>
                        <th width="175">KATEGORI</th>
                        <th width="2%" class="text-left">:</th>
                        <td class="text-left">
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

                </div>
            </div>
        </h4>
    </table>

    <br>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">NO</th>
                <th class="text-center">KODE</th>
                <th class="text-center">TANGGAL</th>
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

            @foreach($pemasukan_rutin as $t)

            <tr>
                <td class="text-center">{{ $no++ }}</td>

                <td class="text-left">{{ $t->kode_persembahan_pengeluaran_khusus }}</td>

                <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>

                <td>{{ $t->detail_kategori->kategori }}</td>






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
                <td colspan="5" class="text-bold text-left bg-secondary">TOTAL PEMASUKAN </td>
                <td class="text-right bg-primary"><b>{{ "Rp.".number_format($total_pemasukan).",-" }}</b></td>
            </tr>
        </tfoot>

    </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>