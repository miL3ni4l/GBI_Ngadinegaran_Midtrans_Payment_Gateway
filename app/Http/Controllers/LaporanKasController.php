<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;
use App\Kategori;
use App\DetailKategori;
use App\Kas;
use App\pemasukan_rutin;
use App\PemasukanKhusus;
use App\PengeluaranKhusus;
use App\PengeluaranRutin;
use App\User;
use App\Donation;
use App\PersembahanPengeluaranRutin;
use App\PersembahanPengeluaranKhusus;

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
            // $kategori = detailkategori::orderBy('kategori','asc')->get();
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

                $persembahan = Donation::whereDate('created_at','>=',$_GET['dari'])
                ->where('status', 'success')
                ->whereDate('created_at','<=',$_GET['sampai'])
                ->orderby('created_at', 'desc')
                ->get();

                $persembahan_pengeluaran_rutin = PersembahanPengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('tanggal', 'desc')
                ->get();

                
                $persembahan_pengeluaran_khusus = PersembahanPengeluaranKhusus::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('tanggal', 'desc')
                ->get();

            }   
             return view('app.lapiran',['pemasukan_rutin' => $pemasukan_rutin, 'pengeluaran_khusus' => $pengeluaran_khusus, 'pengeluaran_rutin' => $pengeluaran_rutin,
             'kas' => $kas, 
             'persembahan' => $persembahan, 
             'persembahan_pengeluaran_rutin' => $persembahan_pengeluaran_rutin, 
             'persembahan_pengeluaran_khusus' => $persembahan_pengeluaran_khusus, 
             'pemasukan_khusus' => $pemasukan_khusus,  
             'seluruh_pemasukan' => $seluruh_pemasukan,  
             'seluruh_pengeluaran' => $seluruh_pengeluaran,
             'pemasukan_rutins'=>$pemasukan_rutins]);


        }else{
            $kategori = kategori::orderBy('kategori','asc')->get();
            return view('app.lapiran',['pemasukan_rutin' => array(), 'kas' => $kas,
            'pengeluaran_khususs' => $pengeluaran_khususs, 'pengeluaran_rutins' => $pengeluaran_rutins,
            'pemasukan_rutins'=>$pemasukan_rutins]);
        
        }



    }


    //CARA PRINT LAPORAN
    public function lapiran_print()
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
            // $kategori = detailkategori::orderBy('kategori','asc')->get();
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

                $persembahan = Donation::whereDate('created_at','>=',$_GET['dari'])
                ->where('status', 'success')
                ->whereDate('created_at','<=',$_GET['sampai'])
                ->orderby('created_at', 'desc')
                ->get();

                $persembahan_pengeluaran_rutin = PersembahanPengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('tanggal', 'desc')
                ->get();

                
                $persembahan_pengeluaran_khusus = PersembahanPengeluaranKhusus::whereDate('tanggal','>=',$_GET['dari'])
                ->where('status', '1')
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->orderby('tanggal', 'desc')
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
             return view('app.lapiran_print',['pemasukan_rutin' => $pemasukan_rutin, 'pengeluaran_khusus' => $pengeluaran_khusus, 
             'pengeluaran_rutin' => $pengeluaran_rutin,'kas' => $kas, 
             'persembahan' => $persembahan, 
             'persembahan_pengeluaran_rutin' => $persembahan_pengeluaran_rutin, 
             'persembahan_pengeluaran_khusus' => $persembahan_pengeluaran_khusus, 
             'pemasukan_khusus' => $pemasukan_khusus,  
             'seluruh_pemasukan' => $seluruh_pemasukan,  
             'seluruh_pengeluaran' => $seluruh_pengeluaran,
             'pemasukan_rutins'=>$pemasukan_rutins]);


        }
            else{
            $kategori = kategori::orderBy('kategori','asc')->get();
            return view('app.lapiran_print',['pemasukan_rutin' => array(), 'kas' => $kas,
            'pengeluaran_khususs' => $pengeluaran_khususs, 'pengeluaran_rutins' => $pengeluaran_rutins,
            'pemasukan_rutins'=>$pemasukan_rutins]);
        
        }


    }

    //COMPOSER REQUIRED composer require maatwebsite/excel:^3.0.1
    public function lapiran_excel()
    {
        return Excel::download(new LapiranExport, 'Laporan.xlsx');
    }

    //AKHIR TAMBAHAN SKRIPSI

    
}
    