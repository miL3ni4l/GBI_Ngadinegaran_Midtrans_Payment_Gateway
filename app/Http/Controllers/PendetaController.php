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
use App\Petugas;
use App\Pendeta;
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

class PendetaController extends Controller
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

        $ibadah = Ibadah::orderBy('updated_at','desc')->get();
        $petugas = Petugas::orderBy('updated_at','desc')->get();
        $profil = Profil::orderBy('updated_at','desc')->get();
        $pendeta = Pendeta::orderBy('updated_at','desc')->get();
     
     
        return view('pendeta.index',array('ibadah' => $ibadah,'petugas' => $petugas,'profil' => $profil,'pendeta' => $pendeta));

    }

    // PENDETA
    public function create()
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
        
                //Selain admin dilarang akses 
                if(Auth::user()->level == 'bendahara') {
                        Session::flash('message', 'Oopss..', 'Anda dilarang masuk ke area ini.');
                        Session::flash('message_type', 'danger');
                    return redirect()->to('/home');
                } 
                
        $pendeta = Pendeta::orderBy('updated_at','desc')->get();
        return view('pendeta.create', compact('pendeta'));

    }
    public function store(Request $request)
    {   

        if($request->file('cover') == '') {
            $cover = NULL;
            } else {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/Pendeta", $fileName);
            $cover = $fileName;
        }

        $nama_pendeta = $request->input('nama_pendeta');
        $alias = $request->input('alias');
        $tempat_lahir = $request->input('tempat_lahir');
        $tgl_lahir = $request->input('tgl_lahir');
        $tlp_pendeta = $request->input('tlp_pendeta');
        $istri = $request->input('istri');
        $pendidikan = $request->input('pendidikan');
        $karir = $request->input('karir');
        $biografi = $request->input('biografi');
        $karir = $request->input('karir');
        $keterangan_pendeta = $request->input('keterangan_pendeta');

        Pendeta::create(
            [
            'nama_pendeta' =>  $nama_pendeta,
            'alias' => $alias,
            'tempat_lahir' => $tempat_lahir,
            'tgl_lahir' => $tgl_lahir,
            'tlp_pendeta' => $tlp_pendeta,
            'istri' => $istri,
            'pendidikan' => $pendidikan,
            'karir' => $karir,
            'biografi' => $biografi,
            'cover' => $cover,
            'keterangan_pendeta' => $keterangan_pendeta,

        ]);   
        // Pendeta::create($request->all());
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('pendeta.index');

    }

    
}