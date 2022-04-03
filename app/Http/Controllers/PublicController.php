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


use PDF;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class PublicController extends Controller
{

    public function index()
    {
        $ibadah = Ibadah::orderBy('updated_at','desc')->get();
        $petugas = Petugas::orderBy('updated_at','desc')->get();
        $profil = Profil::orderBy('updated_at','desc')->get();
        $pendeta = Pendeta::orderBy('updated_at','desc')->get();
     
     
        return view('utama.1',array('ibadah' => $ibadah,'petugas' => $petugas,'profil' => $profil,'pendeta' => $pendeta));

    }

    
    public function warta()
    {
        $ibadah = Ibadah::orderBy('updated_at','desc')->get();
        $petugas = Petugas::orderBy('updated_at','desc')->get();
        $profil = Profil::orderBy('updated_at','desc')->get();
        $pendeta = Pendeta::orderBy('updated_at','desc')->get();
     
     
        return view('utama.2',array('ibadah' => $ibadah,'petugas' => $petugas,'profil' => $profil,'pendeta' => $pendeta));

    }


    public function form_payment()
    {

        // return view('utama.profil_grj',array('ibadah' => $ibadah));
        return view('utama.form_payment');

    }


  


    
}