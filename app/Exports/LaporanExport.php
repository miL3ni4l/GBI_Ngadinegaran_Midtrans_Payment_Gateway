<?php

namespace App\Exports;

use App\pemasukan_rutin;
use App\DetailKategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$kategori = DetailKategori::orderBy('kategori','asc')->get();
    	if($_GET['kategori'] == ""){
    		$pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
    		->whereDate('tanggal','<=',$_GET['sampai'])
    		->get();
    	}else{
    		$pemasukan_rutin = pemasukan_rutin::where('kategori_id',$_GET['kategori'])
    		->whereDate('tanggal','>=',$_GET['dari'])
    		->whereDate('tanggal','<=',$_GET['sampai'])
    		->get();
    	}
            // $pemasukan_rutin = pemasukan_rutin::orderBy('id','desc')->get();
    	return view('laporan.laporan_excel',['pemasukan_rutin' => $pemasukan_rutin, 'kategori' => $kategori]);
    	// return Kategori::all();
    }
}
