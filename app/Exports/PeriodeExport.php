<?php

namespace App\Exports;

use App\pemasukan_rutin;
use App\Kas;
use App\DetailKategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PeriodeExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$kas = Kas::orderBy('kas','asc')->get();
    	if($_GET['kas'] == ""){
    		$pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
    		->whereDate('tanggal','<=',$_GET['sampai'])
    		->get();
    	}else{
    		$pemasukan_rutin = pemasukan_rutin::where('kas_id',$_GET['kas'])
    		->whereDate('tanggal','>=',$_GET['dari'])
    		->whereDate('tanggal','<=',$_GET['sampai'])
    		->get();
    	}
            // $pemasukan_rutin = pemasukan_rutin::orderBy('id','desc')->get();
    	return view('laporan.lapiran_excel',['pemasukan_rutin' => $pemasukan_rutin, 'kas' => $kas]);
    	// return Kas::all();
    }
}
