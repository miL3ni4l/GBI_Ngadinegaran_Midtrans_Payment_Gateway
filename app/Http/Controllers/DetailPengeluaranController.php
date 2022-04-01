<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;

use App\Petugas;
use App\Kategori;
use App\KategoriPengeluaranRutin;
use App\DetailPengeluaran;
use App\PengeluaranRutin;
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

class DetailPengeluaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
        
           //Akses Dari Luar 
            if(Auth::user()->level == 'bendahara') {
                Session::flash('message', 'Anda dilarang masuk ke area ini.');
                Session::flash('message_type', 'danger');
                return redirect()->to('login');
            } 
            
            //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
            if(Auth::user()->petugas == null) 
            {
                Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
                Session::flash('message_type', 'danger');
                return redirect()->to('/');
            } 

            
            //SUDAH TERDAFTAR SEBAGAI PETUGAS
            if(Auth::user()->level == 'bendahara')
            { 
                $datas = DetailPengeluaran::orderBy('updated_at','desc')->where('petugas_id', Auth::user()->petugas->id)->get();                        
                $kategoris =  DetailPengeluaran::orderBy('updated_at','desc')->where('petugas_id', Auth::user()->petugas->id)->get();  
            } 
            else 
            {               
                $datas = DetailPengeluaran::orderBy('updated_at','desc')->get();
                $kategoris = DetailPengeluaran::orderBy('updated_at','desc')->get();   
            }

            $transaksis = Transaksi::all();
            $kategori = DetailPengeluaran::get();
            $transaksi = Transaksi::get();
            $kategori_pengeluaran= KategoriPengeluaranRutin::orderBy('updated_at','desc')->get();    
            $seluruh_pemasukan = DB::table('transaksi')->select(DB::raw('SUM(nominal) as total'))
            ->where('status','1')
            ->first();

            $total = $seluruh_pemasukan->total;

            
            return view('detail_pengeluaran.index', compact('datas','kategori', 'kategoris', 'transaksis','transaksi', 'total' , 'seluruh_pemasukan','kategori_pengeluaran'));

    }

    public function show($id)
    {
         
            //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
            if(Auth::user()->petugas == null) 
            {
                Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
                Session::flash('message_type', 'danger');
                return redirect()->to('/');
            } 
            
            //SUDAH TERDAFTAR SEBAGAI PETUGAS
  
            $details = KategoriPengeluaranRutin::orderBy('id','desc')->findOrFail($id);
            $detail = KategoriPengeluaranRutin::orderBy('updated_at','desc')->get();
            
            
            return view('detail_pengeluaran.show', compact('details', 'detail'));

       
    }
    
    //MENAMBAHKAN DATA KATEGORI
    public function create(Request $req)
    {
         //Akses Dari Luar 
         if(Auth::user()->level == 'bendahara') {
            Session::flash('message', 'Anda dilarang masuk ke area ini.');
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


           

                //CARA MEMBUAT KODE KATEGORI
                $getRow = DetailPengeluaran::orderBy('id', 'DESC')->get();      
                $rowCount = $getRow->count(); 
                $lastId = $getRow->first();
                $kode = "001";
                if ($rowCount > 0) { 
                    if ($lastId->id < 9) {
                            $kode = "00".''.($lastId->id + 1);
                    } else if ($lastId->id < 99) {
                            $kode = "0".''.($lastId->id + 1);
                    } else {
                            $kode = "".''.($lastId->id + 1);
                    }
                }
         

            if(Auth::user()->level == 'bendahara')
            {
                $nama = Auth::user()->petugas->id;
                $kategori = DetailPengeluaran::orderBy('updated_at','desc')->where('petugas_id',  $nama)->get();      
                $users = User::orderBy('level','desc')->get();
                $petugas = Petugas::orderBy('updated_at','desc')->get();
    
            } else {            
                $nama = Auth::user()->petugas->id;   
                $users = User::orderBy('level','desc')->get();
                $petugas = Petugas::orderBy('updated_at','desc')->get(); 
            }
            $kategoris = KategoriPengeluaranRutin::get(); 

         return view('detail_pengeluaran.create' , compact('kategoris','kode','nama', 'users', 'petugas'));

       
    }

    //MENAMBAHKAN DATA KATEGORI
    public function store(Request $request)
    {   
        
        $count = DetailPengeluaran::where('kategori',$request->input('kategori'))->count();
        if($count>0){
            Session::flash('message', 'Nama Detail Pengeluaran Sudah Ada !');
            Session::flash('message_type', 'danger');
            return redirect()->to('detail_pengeluaran/create');
        }

        DetailPengeluaran::create($request->all());    

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('detail_pengeluaran.index');

    }

       
    //FILTER DATA TRANSAKSI BERDASARKAN TANGGAL2
    public function rutin_pengeluaran()
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
        
        //SUDAH TERDAFTAR SEBAGAI PETUGAS
        if(Auth::user()->level == 'bendahara')
        { 
            $datas = DetailPengeluaran::orderBy('updated_at','desc')->where('petugas_id', Auth::user()->petugas->id)->get();                         
        } 
        else 
        {               
            $datas = DetailPengeluaran::orderBy('updated_at','desc')->get();
        }

        $details = Kategori::orderBy('updated_at','desc')->get(); 
        $kategoris = DetailPengeluaran::all(); 
        $kategori = DetailPengeluaran::orderBy('kategori','asc')->get();
        $kategori_pengeluaran= KategoriPengeluaranRutin::orderBy('updated_at','desc')->get();    
        $transaksi = Transaksi::all();
        $transaksis  = Transaksi::count(); 

        if($_GET['kategori'] == ""){
            $transaksi = PengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
        }
        else{
            $transaksi = PengeluaranRutin::where('detail_pengeluaran',$_GET['kategori'])
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();     
        }  
        return view('detail_pengeluaran.index',['transaksi' => $transaksi, 'kategori' => $kategori, 'datas' => $datas,'details' => $details,'kategoris'=>$kategoris ,'transaksis'=>$transaksis, 'kategori_pengeluaran'=> $kategori_pengeluaran]);


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
        $data  = DetailPengeluaran::findOrFail($id);
        $data = DetailPengeluaran::orderBy('created_at','desc')->findOrFail($id);


        return view('detail_pengeluaran.edit', compact('data','nama', 'users', 'petugas', 'data'));
    }

    public function update(Request $request, $id)
    {   
        $kategori = DetailPengeluaran::findOrFail($id);
        $kategori->update();
        $kategori->save();

        DetailPengeluaran::find($id)->update($request->all());
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('detail_pengeluaran');
    }

    //MENGHAPUS KATEGORI
    public function destroy($id)
    {
        $kategori = DetailPengeluaran::find($id);
        $kategori->delete();

        $tt = PengeluaranRutin::where('kategori_id',$id)->get();

        if($tt->count() > 0){
            $transaksi = PengeluaranRutin::where('kategori_id',$id)->first();
            $transaksi->kategori_id = "1";
            $transaksi->save();
        }
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect('detail_pengeluaran')->with('success','DetailPengeluaran telah dihapus');
    }
    
}
    