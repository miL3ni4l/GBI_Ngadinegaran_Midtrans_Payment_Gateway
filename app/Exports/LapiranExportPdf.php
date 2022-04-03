<?php

namespace App\Exports;

use App\pemasukan_rutin;
use App\Kas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Pdf\Concerns\FromView;

class LapiranExportPdf implements FromView
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
    	return view('lapiran.lapiran_pdf',['pemasukan_rutin' => $pemasukan_rutin, 'kas' => $kas]);
    	// return Kas::all();
    }
}
