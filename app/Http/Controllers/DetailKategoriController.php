<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;

use App\Petugas;
use App\Kategori;
use App\DetailKategori;
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

class DetailKategoriController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
        
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
                $datas = DetailKategori::orderBy('updated_at','desc')->where('petugas_id', Auth::user()->petugas->id)->get();  
                $details = Kategori::orderBy('updated_at','desc')->get();                       
                $kategoris =  DetailKategori::orderBy('updated_at','desc')->where('petugas_id', Auth::user()->petugas->id)->get();  
            } 
            else 
            {               
                $datas = DetailKategori::orderBy('updated_at','desc')->get();
                $details = Kategori::orderBy('updated_at','desc')->get();
                $kategoris = DetailKategori::orderBy('updated_at','desc')->get();   
            }
            $transaksis = Transaksi::all();
        
            $detail_kategoris = Kategori::orderBy('updated_at','desc')->where('kategori','id' )->get();
            $kategori = DetailKategori::get();
            
            $seluruh_pemasukan = DB::table('transaksi')->select(DB::raw('SUM(nominal) as total'))
            ->where('status','1')
            ->first();

            $total = $seluruh_pemasukan->total;
            $kategoris_pemasukan= Kategori::orderBy('updated_at','desc')->get();  
            
            return view('detail_kategori.index', compact('datas','kategori','details', 'kategoris','kategoris_pemasukan', 'transaksis','detail_kategoris', 'total' , 'seluruh_pemasukan'));

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
  
            $details = Kategori::orderBy('id','desc')->findOrFail($id);
            
            
            return view('detail_kategori.show', compact('details'));

       
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
                $getRow = DetailKategori::orderBy('id', 'DESC')->where('jenis', 'Rutin')->get();      
                $rowCount = $getRow->count(); 
                $lastId = $getRow->first();
                $kode = "KTGN-001";
                if ($rowCount > 0) { 
                    if ($lastId->id < 9) {
                            $kode = "KTGN-00".''.($lastId->id + 1);
                    } else if ($lastId->id < 99) {
                            $kode = "KTGN-0".''.($lastId->id + 1);
                    } else {
                            $kode = "KTGN-".''.($lastId->id + 1);
                    }
                }
         

            if(Auth::user()->level == 'bendahara')
            {
                $nama = Auth::user()->petugas->id;
                $kategori = DetailKategori::orderBy('updated_at','desc')->where('petugas_id',  $nama)->get();      
                $users = User::orderBy('level','desc')->get();
                $petugas = Petugas::orderBy('updated_at','desc')->get();
                $details = Kategori::orderBy('updated_at','desc')->get(); 
    
            } else {            
                $nama = Auth::user()->petugas->id;   
                $users = User::get();
                $users = User::orderBy('level','desc')->get();
                $petugas = Petugas::orderBy('updated_at','desc')->get();
                $details = Kategori::orderBy('updated_at','desc')->get(); 
                
            }
            $kategoris = DetailKategori::get(); 
         


         return view('detail_kategori.create' , compact('kategoris','details','kode','nama', 'users', 'petugas'));

       
    }

    //MENAMBAHKAN DATA KATEGORI
    public function store(Request $request)
    {   
        
        $count = DetailKategori::where('kategori',$request->input('kategori'))->count();
        if($count>0){
            Session::flash('message', 'Nama DetailKategori Sudah Ada !');
            Session::flash('message_type', 'danger');
            return redirect()->to('kategori/create');
        }

        DetailKategori::create($request->all());    

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('kategori.index');

    }

    //MENAMBAHKAN DATA KATEGORI RUTIN
    public function create_rutin(Request $req)
    {
         //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
         if(Auth::user()->petugas == null) 
         {
            Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
             Session::flash('message_type', 'danger');
             return redirect()->to('/');
         } 

                //CARA MEMBUAT KODE KATEGORI
                // $getRow = DetailKategori::orderBy('id', 'DESC')
                // ->where('jenis','Rutin')
                // ->get();
                $getRow = DetailKategori::orderBy('id', 'DESC')->where('jenis', 'Rutin')->get();     
                $rowCount = $getRow->count(); 
                $lastId = $getRow->first();
                $kode = "1";
                // if ($rowCount > 0) { 
                //     if ($lastId->id < 9) {
                //             $kode = "KM1-00".''.($lastId->id + 1);
                //     } else if ($lastId->id < 99) {
                //             $kode = "KM1-0".''.($lastId->id + 1);
                //     } else {
                //             $kode = "KM1-".''.($lastId->id + 1);
                //     }
                // }

    
         
            if(Auth::user()->level == 'bendahara')
            {
                $nama = Auth::user()->petugas->id;
                $kategori = DetailKategori::orderBy('updated_at','desc')->where('petugas_id',  $nama)->get();      
                $users = User::orderBy('level','desc')->get();
                $petugas = Petugas::orderBy('updated_at','desc')->get();
                $details = Kategori::orderBy('updated_at','desc')->get(); 
    
            } else {            
                $nama = Auth::user()->petugas->id;   
                $users = User::get();
                $users = User::orderBy('level','desc')->get();
                $petugas = Petugas::orderBy('updated_at','desc')->get();
                $details = Kategori::orderBy('updated_at','desc')->get(); 
                
            }
            $kategoris = DetailKategori::get(); 

         return view('detail_kategori.create_rutin' , compact('kategoris','details','kode','nama', 'users', 'petugas'));

       
    }

    //MENAMBAHKAN DATA KATEGORI
    public function store_rutin(Request $request)
    {   
        
        $count = DetailKategori::where('kategori',$request->input('kategori'))
        ->where('jenis','Rutin')
        ->count();
        if($count>0)
        {
            Session::flash('message', 'Nama Detail Kategori Sudah Ada !');
            Session::flash('message_type', 'danger');
            return redirect()->to('create_rutin');
        }

        DetailKategori::create($request->all());    

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('detail_kategori.index');

    }

    //MENAMBAHKAN DATA KATEGORI RUTIN
    public function create_khusus(Request $req)
    {
        //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
        if(Auth::user()->petugas == null) 
        {
            Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
            Session::flash('message_type', 'danger');
            return redirect()->to('/home');
        } 

                //CARA MEMBUAT KODE KATEGORI
                // $getRow = DetailKategori::orderBy('id', 'DESC')
                // ->where('jenis','Khusus')
                // ->get();
                $getRow = DetailKategori::orderBy('id', 'DESC')->where('jenis', 'Khusus')->get();     
                $rowCount = $getRow->count();   
                $lastId = $getRow->first();
                $kode = "2";
                // if ($rowCount > 0) { 
                //     if ($lastId->id < 9) {
                //             $kode = "KM2-00".''.($lastId->id + 1);
                //     } else if ($lastId->id < 99) {
                //             $kode = "KM2-0".''.($lastId->id + 1);
                //     } else {
                //             $kode = "KM2-".''.($lastId->id + 1);
                //     }
                // }


            if(Auth::user()->level == 'bendahara')
            {
                $nama = Auth::user()->petugas->id;
                $kategori = DetailKategori::orderBy('updated_at','desc')->where('petugas_id',  $nama)->get();      
                $users = User::orderBy('level','desc')->get();
                $petugas = Petugas::orderBy('updated_at','desc')->get();
                $details = Kategori::orderBy('updated_at','desc')->get(); 

            } else {            
                $nama = Auth::user()->petugas->id;   
                $users = User::get();
                $users = User::orderBy('level','desc')->get();
                $petugas = Petugas::orderBy('updated_at','desc')->get();
                $details = Kategori::orderBy('updated_at','desc')->get(); 
                
            }
            $kategoris = DetailKategori::get(); 
        


        return view('detail_kategori.create_khusus' , compact('kategoris','details','kode','nama', 'users', 'petugas'));

    
    }

    //MENAMBAHKAN DATA KATEGORI
    public function store_khusus(Request $request)
    {   
        
        $count = DetailKategori::where('kategori',$request->input('kategori'))
        ->where('jenis','Khusus')
        ->count();
        if($count>0){
            Session::flash('message', 'Nama DetailKategori Sudah Ada !');
            Session::flash('message_type', 'danger');
            return redirect()->to('create_khusus');
        }

        DetailKategori::create($request->all());    

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('detail_kategori.index');

    }
      
    //FILTER DATA TRANSAKSI BERDASARKAN TANGGAL2
    public function rutin()
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
            $datas = DetailKategori::orderBy('updated_at','desc')->where('petugas_id', Auth::user()->petugas->id)->get();                         
        } 
        else 
        {               
            $datas = DetailKategori::orderBy('updated_at','desc')->get();
        }

        $kategoris_pemasukan= Kategori::orderBy('updated_at','desc')->get();  
        $details = Kategori::orderBy('updated_at','desc')->get(); 
        $kategoris = DetailKategori::all(); 
        $kategori = DetailKategori::orderBy('kategori','asc')
        ->get();
        $transaksi = Transaksi::all();
        $transaksis  = Transaksi::count(); 

        if($_GET['kategori'] == ""){
            $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
        }
        else{
            $transaksi = Transaksi::where('kategori_id',$_GET['kategori'])
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();     
        }  
        return view('detail_kategori.index',['kategoris_pemasukan'=> $kategoris_pemasukan,'transaksi' => $transaksi, 'kategori' => $kategori, 'datas' => $datas,'details' => $details,'kategoris'=>$kategoris ,'transaksis'=>$transaksis]);


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
        $data  = DetailKategori::findOrFail($id);
        $data = DetailKategori::orderBy('created_at','desc')->findOrFail($id);


        return view('detail_kategori.edit', compact('data','nama', 'users', 'petugas', 'data'));
    }

    public function update(Request $request, $id)
    {   
        $kategori = DetailKategori::findOrFail($id);
        $kategori->update();
        $kategori->save();

        DetailKategori::find($id)->update($request->all());
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('detail_kategori');
    }

    //MENGHAPUS KATEGORI
    public function destroy($id)
    {
        $kategori = DetailKategori::find($id);
        $kategori->delete();

        $tt = Transaksi::where('kategori_id',$id)->get();

        if($tt->count() > 0){
            $transaksi = Transaksi::where('kategori_id',$id)->first();
            $transaksi->kategori_id = "1";
            $transaksi->save();
        }
        
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect('detail_kategori')->with('success','DetailKategori telah dihapus');
    }
    
}
    