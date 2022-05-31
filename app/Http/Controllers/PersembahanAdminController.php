<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Hash;
use Auth;
use File;
use Session;



use App\Anggota;
use App\User;
use App\Pendeta;
use App\Petugas;
use App\DetailKategori;
use App\DetailPengeluaran;
use App\Kategori;
use App\Kas;
use App\Ibadah;
use App\pemasukan_rutin;
use App\Profil;
use App\Donation;


use PDF;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PersembahanAdminController extends Controller
{

    public function index()
    {

                //Akses Dari Luar 
                if(Auth::user() == '') {
                    Session::flash('message', 'Oopss..', 'Anda dilarang masuk ke area ini.');
                    Session::flash('message_type', 'danger');
                    return redirect()->to('login');
                } 
                //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
                if(Auth::user()->petugas == null) 
                {
                    Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
                    Session::flash('message_type', 'danger');
                    return redirect()->to('/home');
                } 

                $tanggal = date('Y-m-d');
                $bulan = date('m');
                $tahun = date('Y');
        
                $pemasukan_bulan_ini = DB::table('persembahan')->select(DB::raw('SUM(amount) as total'))
                ->where('status','success')
                ->whereMonth('created_at',$bulan)
                ->whereYear('created_at',$tahun)
                ->first();
                $total_pemasukan_bulan_ini = $pemasukan_bulan_ini->total;
                
                $kategori = DetailKategori::orderBy('id', 'desc')->get();
                $ibadah = Ibadah::orderBy('updated_at','desc')->get();
                $petugas = Petugas::orderBy('updated_at','desc')->get();
                $profil = Profil::orderBy('updated_at','desc')->get();
                $pendeta = Pendeta::orderBy('updated_at','desc')->get();
                $persembahan = Donation::orderBy('updated_at','desc')->get();
            
                return view('persembahan_pemasukan_midtrans.index',array('total_pemasukan_bulan_ini' => $total_pemasukan_bulan_ini,'ibadah' => $ibadah,'petugas' => $petugas,'profil' => $profil,'pendeta' => $pendeta,'persembahan' => $persembahan, 'kategori' => $kategori));

    }

    public function filter_persembahan()
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

        $tanggal = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');
        $pemasukan_bulan_ini = DB::table('persembahan')->select(DB::raw('SUM(amount) as total'))
        ->where('status','success')
        ->whereMonth('created_at',$bulan)
        ->whereYear('created_at',$tahun)
        ->first();
        $total_pemasukan_bulan_ini = $pemasukan_bulan_ini->total;
        
        $kategori = DetailKategori::all();
        $kategori = DetailKategori::orderBy('id', 'desc')->get();

        $persembahan = Donation::all();
        $persembahan = Donation::orderBy('updated_at','desc')->get();
        $persembahans  = Donation::count(); 
   

        if($_GET['kategori'] == ""){
            $persembahan = Donation::whereDate('updated_at','>=',$_GET['dari'])
            ->whereDate('updated_at','<=',$_GET['sampai'])
            ->where('status','success')
            ->get();
        }
        else{
            $persembahan = Donation::whereDate('updated_at','>=',$_GET['dari'])
            ->whereDate('updated_at','<=',$_GET['sampai'])
            ->where('donation_type',$_GET['kategori'])
            ->where('status','success')
            ->get();     
        }  
        return view('persembahan_pemasukan_midtrans.index',['persembahan' => $persembahan,'persembahans' => $persembahans, 'kategori' => $kategori,
        'total_pemasukan_bulan_ini' => $total_pemasukan_bulan_ini,
    ]);


    }
    
}