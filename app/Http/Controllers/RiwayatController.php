<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;

use App\User;
use App\Petugas;
use App\DetailKategori;
use App\DetailPengeluaran;
use App\kas;
use App\Transaksi;
use Carbon\Carbon;
use Hash;
use Auth;
use File;
use Session;

use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RiwayatController extends Controller
{

   
    //TRANSAKSI
    //MENAMPILKAN DATA TRANSAKSI
    public function index()
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

        $user = Petugas::orderBy('updated_at','desc')->get();
        $nama = Auth::user()->petugas->id;   
        $kas = kas::orderBy('kas','asc')->get();
        $kategori = DetailKategori::orderBy('kategori','asc')->get();
        $bulan = date('m');

        //menampilkan riwayat berdasarkan userlogin
        if(Auth::user()->level == 'bendahara')
        {
            $transaksi = Transaksi::orderBy('tanggal','desc')
            ->where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status','1')
            ->whereMonth('tanggal',$bulan)
            ->get();
        } else {                  
            $transaksi = Transaksi  ::orderBy('tanggal','desc')
            ->whereMonth('tanggal',$bulan)
            ->where('status','1')
            ->get();
        }
        return view('riwayat.index',['transaksi' => $transaksi, 'kategori' => $kategori, 'user'=>$user ]);
    }
  
    // FILTER RIWAYAT TRANSAKSI PER USER
    public function period()
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

        $user = Petugas::all();
        $transaksi = Transaksi::all();
        $transaksi = Transaksi::orderBy('tanggal','desc');
        $transaksis  = Transaksi::count(); 

        if(Auth::user()->level == 'bendahara')
        {
                if(isset($_GET['user']))
                {
                    $user = Petugas::orderBy('nama','asc')->get();
                    if($_GET['user'] == ""){
                        $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
                        ->where('nama_pengguna', Auth::user()->petugas->id)
                        ->whereDate('tanggal','<=',$_GET['sampai'])
                        ->orderBy('tanggal','desc')
                        ->where('status','1')
                        ->get();
                    }else{
                        $transaksi = Transaksi::where('nama_pengguna',$_GET['user'])
                        ->where('nama_pengguna', Auth::user()->petugas->id)
                        ->whereDate('tanggal','>=',$_GET['dari'])
                        ->whereDate('tanggal','<=',$_GET['sampai'])
                        ->orderBy('tanggal','desc')
                        ->where('status','1')
                        ->get();
                    }    
                    return view('riwayat.index',['transaksi' => $transaksi, 
                    'user' => $user,            
                    'transaksis'=>$transaksis]);
                }
                else{
                    return view('riwayat.index',['transaksi' => array(), 'user' => $user, 'transaksis'=>$transaksis]);
                
                }
        }else{
                if(isset($_GET['user']))
                {
                    $user = Petugas::orderBy('nama','asc')->get();
                    if($_GET['user'] == ""){
                        $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])     
                        ->whereDate('tanggal','<=',$_GET['sampai'])
                        ->orderBy('tanggal','desc')
                        ->where('status','1')
                        ->get();
                    }else{
                        $transaksi = Transaksi::where('nama_pengguna',$_GET['user'])
                        ->whereDate('tanggal','>=',$_GET['dari'])
                        ->whereDate('tanggal','<=',$_GET['sampai'])
                        ->orderBy('tanggal','desc')
                        ->where('status','1')
                        ->get();
                    }    
                    return view('riwayat.index',['transaksi' => $transaksi, 
                    'user' => $user, 
                    'transaksis'=>$transaksis]);
                }
                else{
                
                    return view('riwayat.index',['transaksi' => array(), 'user' => $user, 'seluruh_pemasukan' => $seluruh_pemasukan,  'seluruh_pengeluaran' => $seluruh_pengeluaran,'transaksis'=>$transaksis]);
                
                }
        }
    }

    //show data transaksi
    public function show($id)
    {       
        //Akses Dari Luar 
        if(Auth::user() == '') 
        {
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
          
        $transaksi = Transaksi::findOrFail($id);
        return view('riwayat.show', compact('transaksi'));
    }

    
}