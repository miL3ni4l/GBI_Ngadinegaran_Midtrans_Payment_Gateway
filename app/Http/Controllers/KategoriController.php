<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;

use App\Petugas;
use App\Kategori;
use App\DetailKategori;
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

class KategoriController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //MENAMPILKAN KATEGORI
    public function index()
    {  
            if(Auth::user()->level == 'bendahara') {
                Session::flash('message', 'Anda dilarang masuk ke halaman detail kategori !');
                Session::flash('message_type', 'danger');
                return redirect()->to('/');
            }

            //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
            if(Auth::user()->petugas == null) 
            {
                Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
                Session::flash('message_type', 'danger');
                return redirect()->to('/');
            }            
          
            $kategoris= Kategori::orderBy('updated_at','desc')->get();     
            $details= DetailKategori::orderBy('updated_at','desc')->get();  
            $pemasukan_rutin = pemasukan_rutin::all();
          
            return view('kategori.index', compact('kategoris','details','pemasukan_rutin'));

    }

    //MENAMBAHKAN DATA KATEGORI
    public function create(Request $req)
    {
            if(Auth::user()->level == 'bendahara') {
                Session::flash('message', 'Anda dilarang masuk ke halaman detail kategori !');
                Session::flash('message_type', 'danger');
                return redirect()->to('/');
            }
            
            //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
            if(Auth::user()->petugas == null) 
            {
               Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
                Session::flash('message_type', 'danger');
                return redirect()->to('/');
            } 

            //CARA MEMBUAT KODE KATEGORI
            $getRow = Kategori::orderBy('id', 'DESC')->get();      
            $rowCount = $getRow->count(); 
            $lastId = $getRow->first();
            $kode = "KK01";
            if ($rowCount > 0) { 
                if ($lastId->id < 9) {
                        $kode = "KK0".''.($lastId->id + 1);
                } else {
                        $kode = "KK".''.($lastId->id + 1);
                }
            }

            $nama = Auth::user()->petugas->id;
            $kategoris = Kategori::orderBy('updated_at','desc')->get();    
            return view('kategori.create' , compact('kategoris','kode'));
   
          
    }
   
    //MENAMBAHKAN DATA KATEGORI
    public function store(Request $request)
    {   
           
           $count = Kategori::where('kategori',$request->input('kategori'))->count();
           if($count>0){
               Session::flash('message', 'Nama Kategori Sudah Ada !');
               Session::flash('message_type', 'danger');
               return redirect()->to('kategori/create');
           }
   
           Kategori::create($request->all());
           Session::flash('message', 'Berhasil ditambahkan!');
           Session::flash('message_type', 'success');
           return redirect()->route('detail_kategori.index');
   
    }

    //FILTER DATA pemasukan_rutin BERDASARKAN TANGGAL2
    public function kategori_filter()
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
                       
        $kategoris = Kategori::orderBy('updated_at','desc')->get();

        if($_GET['kategori'] == ""){
            $pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status','1')
            ->get();
        }
        else{
            $pemasukan_rutin = pemasukan_rutin::where('kategori_id',$_GET['kategori'])
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('kategori_id', $kategoris)
            ->where('status','1')
            ->get();     
        }  
        return view('kategori.index',['pemasukan_rutin' => $pemasukan_rutin, 'kategoris'=>$kategoris]);


    }

    //MENGUPADTE KATEGORI
    public function edit($id)
    {   
        //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
          if(Auth::user()->petugas == null) 
          {
              Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
              Session::flash('message_type', 'danger');
              return redirect()->to('/');
          } 
        
        $nama = Auth::user()->petugas->id;       
        $users = User::get();
        $petugas = Petugas::get();
        $data  = Kategori::findOrFail($id);
        $data = Kategori::orderBy('created_at','desc')->findOrFail($id);


        return view('kategori.edit', compact('data','nama', 'users', 'petugas', 'data'));
    }

 
    public function update(Request $request, $id)
    {   
        $kategori = Kategori::findOrFail($id);
        $kategori->update();
        $kategori->save();

        Kategori::find($id)->update($request->all());
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('detail_kategori');
    }
   
    //MENGHAPUS KATEGORI
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        $tt = DetailKategori::where('kategori_id',$id)->get();

        if($tt->count() > 0){
            $pemasukan_rutin = DetailKategori::where('kategori_id',$id)->first();
            $pemasukan_rutin->kategori_id = "1";
            $pemasukan_rutin->save();
        }
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect('detail_kategori')->with('success','Kategori telah dihapus');
    }
    
    
}
    