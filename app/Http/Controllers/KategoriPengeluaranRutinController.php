<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;

use App\Petugas;
use App\KategoriPengeluaranRutin;
use App\DetailPengeluaran;
use App\Transaksi;
use App\User;

use Hash;
use Auth;
use File;
use Session;

use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriPengeluaranRutinController extends Controller
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
          
            $kategoris= KategoriPengeluaranRutin::orderBy('updated_at','desc')->get();     
            $details= DetailPengeluaran::orderBy('updated_at','desc')->get();  
            $transaksi = Transaksi::all();
          
            return view('kategori_pengeluaran.index', compact('kategoris','details','transaksi'));

    }

    //MENAMBAHKAN DATA KATEGORI
    public function create(Request $req)
    {
            //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
            if(Auth::user()->petugas == null) 
            {
               Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
                Session::flash('message_type', 'danger');
                return redirect()->to('/');
            } 
             //CARA MEMBUAT KODE KATEGORI
                $getRow = KategoriPengeluaranRutin::orderBy('id', 'DESC')->get();      
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

            $kategoris = KategoriPengeluaranRutin::orderBy('updated_at','desc')->get();    
            return view('kategori_pengeluaran.create' , compact('kategoris','kode'));
   
          
    }
   
    //MENAMBAHKAN DATA KATEGORI
    public function store(Request $request)
    {   
           
           $count = KategoriPengeluaranRutin::where('kategori',$request->input('kategori'))->count();
           if($count>0){
               Session::flash('message', 'Nama KategoriPengeluaranRutin Sudah Ada !');
               Session::flash('message_type', 'danger');
               return redirect()->to('kategori_pengeluaran/create');
           }
   
           KategoriPengeluaranRutin::create($request->all());
           Session::flash('message', 'Berhasil ditambahkan!');
           Session::flash('message_type', 'success');
           return redirect()->route('detail_pengeluaran.index');
   
    }

    //FILTER DATA TRANSAKSI BERDASARKAN TANGGAL2
    public function kategori_pengeluaran_filter()
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
                       
        $kategoris = KategoriPengeluaranRutin::orderBy('updated_at','desc')->get();

        if($_GET['kategori'] == ""){
            $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status','1')
            ->get();
        }
        else{
            $transaksi = Transaksi::where('kategori_id',$_GET['kategori'])
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status','1')
            ->get();     
        }  
        return view('kategori_pengeluaran.index',['transaksi' => $transaksi, 'kategoris'=>$kategoris]);


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
        $data  = KategoriPengeluaranRutin::findOrFail($id);
        $data = KategoriPengeluaranRutin::orderBy('created_at','desc')->findOrFail($id);


        return view('kategori_pengeluaran.edit', compact('data','nama', 'users', 'petugas', 'data'));
    }

 
    public function update(Request $request, $id)
    {   
        $kategori = KategoriPengeluaranRutin::findOrFail($id);
        $kategori->update();
        $kategori->save();

        KategoriPengeluaranRutin::find($id)->update($request->all());
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('detail_pengeluaran');
    }
   
    //MENGHAPUS KATEGORI
    public function destroy($id)
    {
        $kategori = KategoriPengeluaranRutin::find($id);
        $kategori->delete();

        $tt = DetailPengeluaran::where('kategori_id',$id)->get();

        if($tt->count() > 0){
            $transaksi = DetailPengeluaran::where('kategori_id',$id)->first();
            $transaksi->kategori_id = "1";
            $transaksi->save();
        }
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect('detail_pengeluaran')->with('success','KategoriPengeluaranRutin telah dihapus');
    }
    
    
}
    