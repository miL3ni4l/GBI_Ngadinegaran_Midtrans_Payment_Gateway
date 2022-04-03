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
use App\pemasukan_rutin;
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

   
    //pemasukan_rutin
    //MENAMPILKAN DATA pemasukan_rutin
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
            $pemasukan_rutin = pemasukan_rutin::orderBy('tanggal','desc')
            ->where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status','1')
            ->whereMonth('tanggal',$bulan)
            ->get();
        } else {                  
            $pemasukan_rutin = pemasukan_rutin  ::orderBy('tanggal','desc')
            ->whereMonth('tanggal',$bulan)
            ->where('status','1')
            ->get();
        }
        return view('riwayat.index',['pemasukan_rutin' => $pemasukan_rutin, 'kategori' => $kategori, 'user'=>$user ]);
    }
  
    // FILTER RIWAYAT pemasukan_rutin PER USER
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
        $pemasukan_rutin = pemasukan_rutin::all();
        $pemasukan_rutin = pemasukan_rutin::orderBy('tanggal','desc');
        $pemasukan_rutins  = pemasukan_rutin::count(); 

        if(Auth::user()->level == 'bendahara')
        {
                if(isset($_GET['user']))
                {
                    $user = Petugas::orderBy('nama','asc')->get();
                    if($_GET['user'] == ""){
                        $pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
                        ->where('nama_pengguna', Auth::user()->petugas->id)
                        ->whereDate('tanggal','<=',$_GET['sampai'])
                        ->orderBy('tanggal','desc')
                        ->where('status','1')
                        ->get();
                    }else{
                        $pemasukan_rutin = pemasukan_rutin::where('nama_pengguna',$_GET['user'])
                        ->where('nama_pengguna', Auth::user()->petugas->id)
                        ->whereDate('tanggal','>=',$_GET['dari'])
                        ->whereDate('tanggal','<=',$_GET['sampai'])
                        ->orderBy('tanggal','desc')
                        ->where('status','1')
                        ->get();
                    }    
                    return view('riwayat.index',['pemasukan_rutin' => $pemasukan_rutin, 
                    'user' => $user,            
                    'pemasukan_rutins'=>$pemasukan_rutins]);
                }
                else{
                    return view('riwayat.index',['pemasukan_rutin' => array(), 'user' => $user, 'pemasukan_rutins'=>$pemasukan_rutins]);
                
                }
        }else{
                if(isset($_GET['user']))
                {
                    $user = Petugas::orderBy('nama','asc')->get();
                    if($_GET['user'] == ""){
                        $pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])     
                        ->whereDate('tanggal','<=',$_GET['sampai'])
                        ->orderBy('tanggal','desc')
                        ->where('status','1')
                        ->get();
                    }else{
                        $pemasukan_rutin = pemasukan_rutin::where('nama_pengguna',$_GET['user'])
                        ->whereDate('tanggal','>=',$_GET['dari'])
                        ->whereDate('tanggal','<=',$_GET['sampai'])
                        ->orderBy('tanggal','desc')
                        ->where('status','1')
                        ->get();
                    }    
                    return view('riwayat.index',['pemasukan_rutin' => $pemasukan_rutin, 
                    'user' => $user, 
                    'pemasukan_rutins'=>$pemasukan_rutins]);
                }
                else{
                
                    return view('riwayat.index',['pemasukan_rutin' => array(), 'user' => $user, 'seluruh_pemasukan' => $seluruh_pemasukan,  'seluruh_pengeluaran' => $seluruh_pengeluaran,'pemasukan_rutins'=>$pemasukan_rutins]);
                
                }
        }
    }

    //show data pemasukan_rutin
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
          
        $pemasukan_rutin = pemasukan_rutin::findOrFail($id);
        return view('riwayat.show', compact('pemasukan_rutin'));
    }

    
}