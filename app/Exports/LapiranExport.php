<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Kategori;
use App\DetailKategori;
use App\Kas;
use App\pemasukan_rutin;
use App\PemasukanKhusus;
use App\PengeluaranKhusus;
use App\PengeluaranRutin;
use App\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LapiranExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

		$kas = kas::all();
        $kategori = Kategori::all();
        $pemasukan_rutin = pemasukan_rutin::all();
        $pemasukan_rutins  = pemasukan_rutin::count(); 
        $pengeluaran_khususs  = PengeluaranKhusus::count(); 
        $pengeluaran_rutins  = PengeluaranRutin::count(); 

        $seluruh_pemasukan = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status', '1')
        ->first();

        $seluruh_pengeluaran = DB::table('pemasukan_rutin')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status', '1')
        ->first();

        if(isset($_GET['kas']))
        {
            $kas = kas::orderBy('kas','asc')->get();
            if($_GET['kas'] == ""){
                $pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('updated_at', 'desc')
                ->get();

                $pemasukan_khusus = PemasukanKhusus::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('updated_at', 'desc')
                ->get();

                $pengeluaran_khusus = PengeluaranKhusus::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('updated_at', 'desc')
                ->get();

                $pengeluaran_rutin = PengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('updated_at', 'desc')
                ->get();
            }else{
                $pemasukan_rutin = pemasukan_rutin::where('kas_id',$_GET['kas'])
                ->where('status', '1')
                ->whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('updated_at', 'desc')
                ->get();

                $pemasukan_khusus = PemasukanKhusus::where('kas_id',$_GET['kas'])
                ->where('status', '1')
                ->whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('updated_at', 'desc')
                ->get();

                $pengeluaran_khusus = PengeluaranKhusus::where('kas_id',$_GET['kas'])
                ->where('status', '1')
                ->whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('updated_at', 'desc')
                ->get();

                $pengeluaran_rutin = PengeluaranRutin::where('kas_id',$_GET['kas'])
                ->where('status', '1')
                ->whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('updated_at', 'desc')
                ->get();
            }    
             return view('app.lapiran_excel',['pemasukan_rutin' => $pemasukan_rutin, 'pengeluaran_khusus' => $pengeluaran_khusus, 'pengeluaran_rutin' => $pengeluaran_rutin,
             'kas' => $kas, 
             'pemasukan_khusus' => $pemasukan_khusus,  
             'seluruh_pemasukan' => $seluruh_pemasukan,  
             'seluruh_pengeluaran' => $seluruh_pengeluaran,
             'pemasukan_rutins'=>$pemasukan_rutins]);


        }
            else{
            $kategori = kategori::orderBy('kategori','asc')->get();
            return view('app.lapiran_excel',['pemasukan_rutin' => array(), 'kas' => $kas,
            'pengeluaran_khususs' => $pengeluaran_khususs, 'pengeluaran_rutins' => $pengeluaran_rutins,
            'pemasukan_rutins'=>$pemasukan_rutins]);
        
        }
		
    }
}
