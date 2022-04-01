<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;


//skripsi
use Illuminate\Support\Facades\DB;
use App\DetailKategori;
use App\kas;
use App\Transaksi;
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
        $transaksi = Transaksi::all();
        $transaksis  = Transaksi::count(); 
             
        $seluruh_pemasukan = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status', '1')
        ->first();

        $seluruh_pengeluaran = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status', '1')
        ->first();
        
        if(isset($_GET['kategori']))
        {
            $kategori = DetailKategori::orderBy('kategori','asc')->get();
            if($_GET['kategori'] == ""){
                $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }else{
                $transaksi = Transaksi::where('kategori_id',$_GET['kategori'])
                ->where('status', '1')
                ->whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }    
             return view('laporan.laporan',['transaksi' => $transaksi, 
             'kategori' => $kategori, 
             'seluruh_pemasukan' => $seluruh_pemasukan,  
             'seluruh_pengeluaran' => $seluruh_pengeluaran,
             'transaksis'=>$transaksis]);
        }
     
        else{
            $kategori = DetailKategori::orderBy('kategori','asc')->get();
            return view('laporan.laporan',['transaksi' => array(), 
                                            'kategori' => $kategori, 
                                            'seluruh_pemasukan' => $seluruh_pemasukan,  
                                            'seluruh_pengeluaran' => $seluruh_pengeluaran,
                                            'transaksis'=>$transaksis]);
        
        }
    }


    //CARA PRINT LAPORAN
    public function laporan_print()
    {       
        
        if(isset($_GET['kategori'])){
            $kategori = DetailKategori::orderBy('kategori','asc')->get();
            if($_GET['kategori'] == ""){
                $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }else{
                $transaksi = Transaksi::where('kategori_id',$_GET['kategori'])
                ->where('status', '1')
                ->whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }
            return view('laporan.laporan_print',['transaksi' => $transaksi, 'kategori' => $kategori]);
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
            $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
            ->where('status', '1')
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
        }else{
            $transaksi = Transaksi::where('kategori_id',$_GET['kategori'])
            ->where('status', '1')
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
        }
        return view('laporan.laporan_pdf',['transaksi' => $transaksi, 'kategori' => $kategori]);
    }   
    }

}
    