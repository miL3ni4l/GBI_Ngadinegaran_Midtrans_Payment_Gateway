<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;
use App\Kategori;
use App\DetailKategori;
use App\Kas;
use App\Transaksi;
use App\PemasukanKhusus;
use App\PengeluaranKhusus;
use App\PengeluaranRutin;
use App\User;

use Hash;
use Auth;
use File;
use Session;


use App\Exports\LapiranExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class LaporanKasController extends Controller
{

    //LAPORAN
    public function lapiran()
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
            return redirect()->to('/home');
        } 

        $kas = kas::all();
        $kategori = Kategori::all();
        $transaksi = Transaksi::all();
        $transaksis  = Transaksi::count(); 
        $pengeluaran_khususs  = PengeluaranKhusus::count(); 
        $pengeluaran_rutins  = PengeluaranRutin::count(); 

        $seluruh_pemasukan = DB::table('transaksi')->select(DB::raw('SUM(nominal) as total'))
        ->where('status', '1')
        ->first();

        $seluruh_pengeluaran = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status', '1')
        ->first();

        if(isset($_GET['kas']))
        {
            $kas = kas::orderBy('kas','asc')->get();
            // $kategori = detailkategori::orderBy('kategori','asc')->get();
            if($_GET['kas'] == ""){
                $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
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
            }   
             return view('app.lapiran',['transaksi' => $transaksi, 'pengeluaran_khusus' => $pengeluaran_khusus, 'pengeluaran_rutin' => $pengeluaran_rutin,
             'kas' => $kas, 
             'pemasukan_khusus' => $pemasukan_khusus,  
             'seluruh_pemasukan' => $seluruh_pemasukan,  
             'seluruh_pengeluaran' => $seluruh_pengeluaran,
             'transaksis'=>$transaksis]);


        }else{
            $kategori = kategori::orderBy('kategori','asc')->get();
            return view('app.lapiran',['transaksi' => array(), 'kas' => $kas,
            'pengeluaran_khususs' => $pengeluaran_khususs, 'pengeluaran_rutins' => $pengeluaran_rutins,
            'transaksis'=>$transaksis]);
        
        }



    }


    //CARA PRINT LAPORAN
    public function lapiran_print()
    {       
    

        $kas = kas::all();
        $kategori = Kategori::all();
        $transaksi = Transaksi::all();
        $transaksis  = Transaksi::count(); 
        $pengeluaran_khususs  = PengeluaranKhusus::count(); 
        $pengeluaran_rutins  = PengeluaranRutin::count(); 

        $seluruh_pemasukan = DB::table('transaksi')->select(DB::raw('SUM(nominal) as total'))
        ->where('status', '1')
        ->first();

        $seluruh_pengeluaran = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('status', '1')
        ->first();

        if(isset($_GET['kas']))
        {
            $kas = kas::orderBy('kas','asc')->get();
            // $kategori = detailkategori::orderBy('kategori','asc')->get();
            if($_GET['kas'] == ""){
                $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
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
                $transaksi = Transaksi::where('kas_id',$_GET['kas'])
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
             return view('app.lapiran_print',['transaksi' => $transaksi, 'pengeluaran_khusus' => $pengeluaran_khusus, 'pengeluaran_rutin' => $pengeluaran_rutin,
             'kas' => $kas, 
             'pemasukan_khusus' => $pemasukan_khusus,  
             'seluruh_pemasukan' => $seluruh_pemasukan,  
             'seluruh_pengeluaran' => $seluruh_pengeluaran,
             'transaksis'=>$transaksis]);


        }
            else{
            $kategori = kategori::orderBy('kategori','asc')->get();
            return view('app.lapiran_print',['transaksi' => array(), 'kas' => $kas,
            'pengeluaran_khususs' => $pengeluaran_khususs, 'pengeluaran_rutins' => $pengeluaran_rutins,
            'transaksis'=>$transaksis]);
        
        }


    }

    //COMPOSER REQUIRED composer require maatwebsite/excel:^3.0.1
    public function lapiran_excel()
    {
        return Excel::download(new LapiranExport, 'Laporan.xlsx');
    }

    //AKHIR TAMBAHAN SKRIPSI

    
}
    