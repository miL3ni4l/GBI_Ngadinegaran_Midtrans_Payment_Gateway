<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;

use App\Petugas;
use App\Kategori;
use App\KategoriPengeluaranRutin;
use App\DetailKategori;
use App\DetailPengeluaran;
use App\PengeluaranRutin;
use App\PengeluaranKhusus;
use App\pemasukan_rutin;
use App\PersembahanPengeluaranRutin;
use App\PersembahanPengeluaranKhusus;
use App\User;
use App\Donation;
use App\PemasukanKhusus;

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

            $persembahan_pengeluaran_rutin = PersembahanPengeluaranRutin::get();
            $pemasukan_rutins = pemasukan_rutin::all();
            $kategori = DetailPengeluaran::get();
            $kategori_khusus = DetailKategori::where('jenis','Khusus' )->get();
            $pemasukan_rutin = pemasukan_rutin::get();
            $kategori_pengeluaran= KategoriPengeluaranRutin::orderBy('updated_at','desc')->get();    
            $seluruh_pemasukan = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
            ->where('status','1')
            ->first();

            $total = $seluruh_pemasukan->total;

            
            return view('detail_pengeluaran.index', compact('persembahan_pengeluaran_rutin','datas','kategori', 'kategoris', 'kategori_khusus','pemasukan_rutins','pemasukan_rutin', 'total' , 'seluruh_pemasukan','kategori_pengeluaran'));

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

       
    //FILTER DATA pemasukan_rutin BERDASARKAN TANGGAL2
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
        $pengeluaran_rutin = PengeluaranRutin::all();
        $pengeluaran_rutins  = PengeluaranRutin::count(); 


        $kategori_khusus = DetailKategori::orderBy('kategori','asc')
        ->where('jenis', 'Khusus')
        ->get();

        $persembahan_pengeluaran_rutin = PersembahanPengeluaranRutin::all();
        $persembahan_pengeluaran_rutins  = PersembahanPengeluaranRutin::count(); 
        $persembahan_pengeluaran_khusus = PersembahanPengeluaranKhusus::all();
        $persembahan_pengeluaran_khususs  = PersembahanPengeluaranKhusus::count(); 

        $pengeluaran_khusus = PengeluaranKhusus::get();   
        $persembahan_pengeluaran_khusus = PersembahanPengeluaranKhusus::get();  




        if($_GET['kategori'] == ""){
            $pengeluaran_rutin = PengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
        }
        else{
            $pengeluaran_rutin = PengeluaranRutin::where('detail_pengeluaran',$_GET['kategori'])
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();     
            $persembahan_pengeluaran_rutin = PersembahanPengeluaranRutin::where('detail_pengeluaran',$_GET['kategori'])
            ->where('status','1')
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
        }  
        return view('detail_pengeluaran.index',['pengeluaran_rutin' => $pengeluaran_rutin, 'kategori' => $kategori, 'datas' => $datas,
        'pengeluaran_khusus' => $pengeluaran_khusus, 'persembahan_pengeluaran_khusus' => $persembahan_pengeluaran_khusus, 
        'details' => $details,'kategoris'=>$kategoris ,'pengeluaran_rutins'=>$pengeluaran_rutins, 
        'kategori_pengeluaran'=> $kategori_pengeluaran, 'kategori_khusus'=>$kategori_khusus,
        'persembahan_pengeluaran_rutin' => $persembahan_pengeluaran_rutin, 'persembahan_pengeluaran_khusus' => $persembahan_pengeluaran_khusus
    
    ]);


    }


    public function khusus_pengeluaran()
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
        $kategoris = DetailPengeluaran::all(); 
        $kategori = DetailPengeluaran::orderBy('kategori','asc')->get();
        $kategori_rutin = DetailKategori::orderBy('kategori','asc')
        ->where('jenis', 'Rutin')
        ->get();
        $kategori_khusus = DetailKategori::orderBy('kategori','asc')
        ->where('jenis', 'Khusus')
        ->get();
        $persembahan = Donation::all();
        $persembahan = Donation::orderBy('updated_at','desc')
        ->where('status','success')->get();
        $persembahans  = Donation::count(); 
        $pemasukan_rutin = pemasukan_rutin::all();
        $pemasukan_rutins  = pemasukan_rutin::count(); 
        $pemasukan_khusus = PemasukanKhusus::all();
        $pemasukan_khususs  = PemasukanKhusus::count(); 
        $midtrans = Donation::all();
        $midtranss  = Donation::count(); 
        $kategori_pengeluaran= KategoriPengeluaranRutin::orderBy('updated_at','desc')->get();   
        
        $persembahan_pengeluaran_rutin = PersembahanPengeluaranRutin::all();
        $persembahan_pengeluaran_rutins  = PersembahanPengeluaranRutin::count(); 
        $persembahan_pengeluaran_khusus = PersembahanPengeluaranKhusus::all();
        $persembahan_pengeluaran_khususs  = PersembahanPengeluaranKhusus::count(); 

        if($_GET['kategori'] == ""){
            $pengeluaran_khusus = PengeluaranKhusus::whereDate('tanggal','>=',$_GET['dari'])
            ->where('status', '1')
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
            $persembahan_pengeluaran_khusus = PersembahanPengeluaranKhusus::whereDate('tanggal','>=',$_GET['dari'])
            ->where('status', '1')
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();
        }
        else{
            $pengeluaran_khusus = PengeluaranKhusus::where('kategori_id',$_GET['kategori'])
            ->where('status', '1')
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();   
            $persembahan_pengeluaran_khusus = PersembahanPengeluaranKhusus::where('kategori_id',$_GET['kategori'])
            ->where('status', '1')
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->get();  

        }  
        return view('detail_pengeluaran.index',['kategoris_pemasukan'=> $kategoris_pemasukan,  
        'pengeluaran_khusus' => $pengeluaran_khusus, 'persembahan_pengeluaran_khusus' => $persembahan_pengeluaran_khusus, 
        'persembahan' => $persembahan,  'persembahans' => $persembahans, 
        'pemasukan_rutin' => $pemasukan_rutin, 'pemasukan_khusus' => $pemasukan_khusus,
        'kategori_khusus' => $kategori_khusus, 'kategori_rutin' => $kategori_rutin,
        'kategori_pengeluaran'=> $kategori_pengeluaran,
        'datas' => $datas,'details' => $details,'kategoris'=>$kategoris ,'kategori'=>$kategori ,'kategori_khusus'=>$kategori_khusus ,'pemasukan_rutins'=>$pemasukan_rutins,
        'persembahan_pengeluaran_rutin' => $persembahan_pengeluaran_rutin, 'persembahan_pengeluaran_khusus' => $persembahan_pengeluaran_khusus
    ]);


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
            $pemasukan_rutin = PengeluaranRutin::where('kategori_id',$id)->first();
            $pemasukan_rutin->kategori_id = "1";
            $pemasukan_rutin->save();
        }
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect('detail_pengeluaran')->with('success','DetailPengeluaran telah dihapus');
    }
    
}
    