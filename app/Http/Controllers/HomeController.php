<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//skripsi
use App\DetailKategori;
use App\DetailPengeluaran;
use App\kas;
use App\Donation;
use App\pemasukan_rutin;
use App\User;

use Hash;
use Auth;
use File;
use Session;


use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {
        
        //TAMBAHAN SKRIPSI
        $categories= [];
        $data= [];
        $user      = User::get();
        $kategori = DetailKategori::all();
        $jenis_kategori_khusus = DetailKategori::all(); 
        $kas = kas::all();
        $persembahan = Donation::all();
        $pemasukan_rutin = pemasukan_rutin::all();
        $tanggal = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');
        $kategori = DetailKategori::all();
        $kategori_user = DetailKategori::all();
        $pemasukan_rutin = pemasukan_rutin::all();
        $tanggal = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');

        $pemasukan_bulan_ini = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereMonth('tanggal',$bulan)
        ->whereYear('tanggal',$tahun)
        ->first();

        $pemasukan_tahun_ini = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereYear('tanggal',$tahun)
        ->first();

        $seluruh_pemasukan = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();

        $pengeluaran_bulan_ini = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereMonth('tanggal',$bulan)
        ->whereYear('tanggal',$tahun)
        ->first();

        $pengeluaran_tahun_ini = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->whereYear('tanggal',$tahun)
        ->first();

        //GRAFIK
        $semua_pemasukan_midtrans = DB::table('persembahan')->select(DB::raw('SUM(amount) as total'))
        ->where('status','success')
        ->first();

        $semua_pemasukan = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();
        
        $semua_pengeluaran = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();


        // PEMASUKAN_KHUSUS
        $midtrans = DB::table('persembahan')->select(DB::raw('SUM(amount) as total'))
        ->where('status','success')
        ->first();

        $pemasukan_rutin = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();
        $pemasukan_khusus = DB::table('pemasukan_khusus')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();

        $seluruh_pemasukan = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();
        $seluruh_pemasukan_khusus = DB::table('pemasukan_khusus')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();

        // PENGELUARAN
        $pengeluaran_rutin = DB::table('pengeluaran_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();
        $pengeluaran_khusus = DB::table('pengeluaran_khusus')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();

        $seluruh_pengeluaran_rutin = DB::table('pengeluaran_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();
        $seluruh_pengeluaran_khusus = DB::table('pengeluaran_khusus')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();

        $seluruh_pengeluaran_rutin_midtrans = DB::table('persembahan_pengeluaran_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();
        $seluruh_pengeluaran_khusus_midtrans = DB::table('persembahan_pengeluaran_khusus')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->first();

        $total_pemasukan = $seluruh_pemasukan->total  += $seluruh_pemasukan_khusus->total += $midtrans->total ;
        $total_pengeluaran =  $seluruh_pengeluaran_rutin->total +=  $seluruh_pengeluaran_khusus->total += $seluruh_pengeluaran_rutin_midtrans->total +=  $seluruh_pengeluaran_khusus_midtrans->total ;
        $total_saldo =  $total_pemasukan -=  $total_pengeluaran ; 
        
        

        return view('layouts2.dashboard',
            [
                'data' => $data,
                'categories' => $categories, 
                'user' => $user,
                'pemasukan_bulan_ini' => $pemasukan_bulan_ini,
                'pemasukan_tahun_ini' => $pemasukan_tahun_ini,
                'seluruh_pemasukan' => $seluruh_pemasukan,
                'semua_pemasukan_midtrans' => $semua_pemasukan_midtrans,
                'semua_pemasukan' => $semua_pemasukan,
                'pengeluaran_bulan_ini' => $pengeluaran_bulan_ini,
                'pengeluaran_tahun_ini' => $pengeluaran_tahun_ini,
                'seluruh_pengeluaran_khusus' => $seluruh_pengeluaran_khusus,
                'seluruh_pemasukan_khusus' => $seluruh_pemasukan_khusus,
                'seluruh_pengeluaran_rutin' => $seluruh_pengeluaran_rutin,
                'semua_pengeluaran' => $semua_pengeluaran,
                'kategori' => $kategori,
                'jenis_kategori_khusus'=>$jenis_kategori_khusus ,
                'kategori_user' => $kategori_user,
                'kas' => $kas,
                'persembahan' => $persembahan,
                'total_pemasukan' => $total_pemasukan,
                'total_pengeluaran' => $total_pengeluaran,
                'pemasukan_rutin' => $pemasukan_rutin,
                'midtrans' => $midtrans,
                'pemasukan_rutin' => $pemasukan_rutin,
                'pemasukan_khusus' => $pemasukan_khusus,   
                'pengeluaran_rutin' => $pengeluaran_rutin,
                'pengeluaran_khusus' => $pengeluaran_khusus,  
                'total_saldo' => $total_saldo,
                'seluruh_pengeluaran_rutin_midtrans' => $seluruh_pengeluaran_rutin_midtrans,
                'seluruh_pengeluaran_khusus_midtrans' => $seluruh_pengeluaran_khusus_midtrans
            ]
        );
    }

}
    