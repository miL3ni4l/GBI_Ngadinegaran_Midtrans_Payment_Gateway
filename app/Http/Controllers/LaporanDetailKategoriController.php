<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;


//skripsi
use Illuminate\Support\Facades\DB;
use App\DetailKategori;
use App\kas;
use App\pemasukan_rutin;
use App\User;

use Hash;
use Auth;
use File;

use PDF;
use Session;
  


use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class LaporanDetailKategoriController extends Controller
{


    public function laporan()
    {   
        //Akses Dari Luar 
        if(Auth::user() == '') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('login');
        } 

         //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
         if(Auth::user()->petugas == null) 
         {
            Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
             Session::flash('message_type', 'danger');
             return redirect()->to('/');
         } 

        $kategori = DetailKategori::all();
        $pemasukan_rutin = pemasukan_rutin::all();
        $pemasukan_rutins  = pemasukan_rutin::count(); 
             
        $seluruh_pemasukan = DB::table('pemasukan_rutin')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status', '1')
        ->first();

        $seluruh_pengeluaran = DB::table('pemasukan_rutin')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status', '1')
        ->first();
        
        if(isset($_GET['kategori']))
        {
            $kategori = DetailKategori::orderBy('kategori','asc')->get();
            if($_GET['kategori'] == ""){
                $pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }else{
                $pemasukan_rutin = pemasukan_rutin::where('kategori_id',$_GET['kategori'])
                ->where('status', '1')
                ->whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }    
             return view('laporan.laporan',['pemasukan_rutin' => $pemasukan_rutin, 
             'kategori' => $kategori, 
             'seluruh_pemasukan' => $seluruh_pemasukan,  
             'seluruh_pengeluaran' => $seluruh_pengeluaran,
             'pemasukan_rutins'=>$pemasukan_rutins]);
        }
     
        else{
            $kategori = DetailKategori::orderBy('kategori','asc')->get();
            return view('laporan.laporan',['pemasukan_rutin' => array(), 
                                            'kategori' => $kategori, 
                                            'seluruh_pemasukan' => $seluruh_pemasukan,  
                                            'seluruh_pengeluaran' => $seluruh_pengeluaran,
                                            'pemasukan_rutins'=>$pemasukan_rutins]);
        
        }
    }


    //CARA PRINT LAPORAN
    public function laporan_print()
    {       
        
        if(isset($_GET['kategori'])){
            $kategori = DetailKategori::orderBy('kategori','asc')->get();
            if($_GET['kategori'] == ""){
                $pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }else{
                $pemasukan_rutin = pemasukan_rutin::where('kategori_id',$_GET['kategori'])
                ->where('status', '1')
                ->whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }
            return view('laporan.laporan_print',['pemasukan_rutin' => $pemasukan_rutin, 'kategori' => $kategori]);
        }
    }

    //COMPOSER REQUIRED composer require maatwebsite/excel:^3.0.1
    public function laporan_excel()
    {
        return Excel::download(new LaporanExport, 'Laporan.xlsx');
    }

    public function laporan_pdf()
    {if(isset($_GET['kategori'])){
        $kategori = DetailKategori::orderBy('kategori','asc')->get();
        if($_GET['kategori'] == ""){
            $pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
            ->where('status', '1')
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
        }else{
            $pemasukan_rutin = pemasukan_rutin::where('kategori_id',$_GET['kategori'])
            ->where('status', '1')
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
        }
        return view('laporan.laporan_pdf',['pemasukan_rutin' => $pemasukan_rutin, 'kategori' => $kategori]);
    }   
    }

}
    