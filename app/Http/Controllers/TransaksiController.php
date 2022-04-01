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
use App\Kategori;
use App\Kas;
use App\Ibadah;
use App\Transaksi;
use Carbon\Carbon;
use Hash;
use Auth;
use File;
use Session;
use PDF;

use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{

    //READ TRANSAKSI
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

        //CARA MENAMPILKAN USER LOGIN YANG MENAMBAHKAN DATA
        $nama = Auth::user()->name;  
        if(Auth::user()->level == 'bendahara')
        {
              
            $transaksi = Transaksi::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();           
        } else {       
                 
            $transaksi = Transaksi::get();
            $transaksi = Transaksi::orderBy('updated_at','desc')->get();
        }

        $kas = Kas::all();
        $ibadah = Ibadah::all();
        $kategori = DetailKategori::where('jenis', 'Rutin')->get();
        return view('transaksi.index', compact('transaksi','nama', 'kas', 'ibadah','kategori'));
        // return view('transaksi.index',['transaksi' => $transaksi, 'nama_pengguna' => $nama]);

    }

    public function konfirmasi()
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

        //CARA MENAMPILKAN USER LOGIN YANG MENAMBAHKAN DATA
        $nama =  Auth::user()->petugas->id;  
        if(Auth::user()->level == 'bendahara')
        {
            $transaksi = Transaksi::orderBy('updated_at','desc')
            ->where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status', '0')
            ->get();           
        } else {       
                 
            $transaksi = Transaksi::get();
            $transaksi = Transaksi::orderBy('updated_at','desc')
            ->where('status', '0')
            ->get();
        }

        //KATEGORI BERDASARKAN USERLOGIN
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

        $kas = Kas::all();
        $ibadah = Ibadah::all();
        $kategori = DetailKategori::get();
        return view('transaksi.index', compact('transaksi','nama', 'kas','ibadah','kategori', 'datas', 'kategoris'));
    }
   
    //FILTER DATA TRANSAKSI BERDASARKAN TANGGAL2
    public function periode()
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

        //KATEGORI BERDASARKAN USERLOGIN
        if(Auth::user()->level == 'bendahara')
        { 
            $datas = DetailKategori::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();  
            $details = Kategori::orderBy('updated_at','desc')->get();                       
            $kategoris =  DetailKategori::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();  
        } 
        else 
        {               
            $datas = DetailKategori::orderBy('updated_at','desc')->get();
            $details = Kategori::orderBy('updated_at','desc')->get();
            $kategoris = DetailKategori::orderBy('updated_at','desc')->get();   
        }

        $kas = Kas::all();
        $ibadah = Ibadah::all();
        $kategori = DetailKategori::all();
        $transaksi = Transaksi::all();
        $transaksis  = Transaksi::count(); 

 
        $kas = Kas::orderBy('kas','asc')->get();
        $kategori = DetailKategori::orderBy('kategori','asc')
        ->where('jenis', 'Rutin')->get();
        $kas = kas::orderBy('kas','asc')->get();


        if($_GET['ibadah'] == "" || $_GET['kategori'] == ""  || $_GET['kas'] == ""){
            $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status','1')
            ->get();
        }
        else{
            $transaksi = 
            Transaksi::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('ibadah_id',$_GET['ibadah'])
            ->where('kategori_id',$_GET['kategori'])
            ->where('kas_id',$_GET['kas'])
            ->where('status','1')
            ->get();     
        }  
        return view('transaksi.index',['transaksi' => $transaksi, 'kas' => $kas,'kategori' => $kategori,'ibadah' => $ibadah, 'transaksis'=>$transaksis, 'datas'=>$datas,'kategoris'=>$kategoris]);


    }

    public function laporan_excel()
    {
        return Excel::download(new LaporanExport, 'Laporan.xlsx');
    }

    //MENAMBAHKAN DATA TRANSAKSI
    public function create(Request $request)
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

        $tahun = date('y');
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        $lastId = $getRow->first();
        $kode = "TM1$tahun";
        // $kode = "TM1$tahun-00001";
        // if ($rowCount > 0) { 
        //     if ($lastId->id < 9) {
        //             $kode = "TM1$tahun-0000".''.($lastId->id + 1);
        //     } else if ($lastId->id < 99) {
        //             $kode = "TM1$tahun-000".''.($lastId->id + 1);
        //     } else if ($lastId->id < 999) {
        //             $kode = "TM1$tahun-00".''.($lastId->id + 1);
        //     } else if ($lastId->id < 9999) {
        //             $kode = "TM1$tahun-0".''.($lastId->id + 1);
        //     } else {
        //             $kode = "TM1$tahun-".''.($lastId->id + 1);
        //     }
        // }
 
      
        if(Auth::user()->level == 'bendahara')
        {
            $nama = Auth::user()->petugas->id;
            $kategoris = DetailKategori::orderBy('updated_at','desc')
            ->where('petugas_id', Auth::user()->petugas->id)
            ->where('jenis', 'Rutin')
            ->get();
        } else {            
            $nama = Auth::user()->petugas->id;
            $kategoris = DetailKategori::orderBy('updated_at','desc')
            ->where('jenis', 'Rutin')
            ->get();
        }
        
        $kass = Kas::get();
        $ibadahs = Ibadah::all();
        $transaksis = Transaksi::get();

        return view('transaksi.create', compact('nama','kode','kategoris','kass', 'ibadahs',  'transaksis'));
        
    }

    public function store(Request $request)
    {   

        // HASIL AKHIR
        if($request->file('cover') == '') {
            $cover = NULL;
            } else {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/Transaksi", $fileName);
            $cover = $fileName;
        }
        $nama_pengguna = $request->input('nama_pengguna');
        $kode_transaksi = $request->input('kode_transaksi');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $kas = $request->input('kas');
        $ibadah = $request->input('ibadah');
        $nominal = $request->input('nominal');
        $keterangan = $request->input('keterangan');

        Transaksi::create(
            [
            'nama_pengguna' =>  $nama_pengguna,
            'kode_transaksi' => $kode_transaksi,
            'tanggal' => $tanggal,
            'kategori_id' => $kategori,
            'kas_id' => $kas,
            'ibadah_id' => $ibadah,
            'nominal' => $nominal,
            // 'nominal' => ['required', 'nominal', 'max:2'],
            'cover' => $cover,
            'keterangan' => $keterangan,
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);   

        // Transaksi::create($request->all());    
        
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('transaksi.index');
       
    }
   
    //MENAMBAHKAN DATA TRANSAKSI
    public function transaksi_create_rutin(Request $request)
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


        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        $lastId = $getRow->first();
        $kode = "TRM-00001";
        if ($rowCount > 0) { 
            if ($lastId->id < 9) {
                    $kode = "TRM-0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "TRM-000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "TRM-00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "TRM-0".''.($lastId->id + 1);
            } else {
                    $kode = "TRM-".''.($lastId->id + 1);
            }
        }
 
      
        if(Auth::user()->level == 'bendahara')
        {
            $nama = Auth::user()->petugas->id;
            $kategoris = DetailKategori::orderBy('updated_at','desc')
            ->where('jenis', 'Rutin')
            ->where('nama_pengguna', Auth::user()->petugas->id)->get();
        } else {            
            $nama = Auth::user()->petugas->id;
            $kategoris = DetailKategori::get();
            $kategoris = DetailKategori::orderBy('updated_at','desc')
            ->where('jenis', 'Rutin')
            ->get();
        }
        
        $kass = Kas::get();
        $ibadahs = Ibadah::all();
        $transaksis = Transaksi::get();

        return view('transaksi.transaksi_create_rutin', compact('nama','kode','kategoris','kass', 'ibadahs',  'transaksis'));
        
    }

    public function transaksi_store_rutin(Request $request)
    {   

        // HASIL AKHIR
        if($request->file('cover') == '') {
            $cover = NULL;
            } else {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/Transaksi", $fileName);
            $cover = $fileName;
        }
        $nama_pengguna = $request->input('nama_pengguna');
        $kode_transaksi = $request->input('kode_transaksi');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $kas = $request->input('kas');
        $ibadah = $request->input('ibadah');
        $nominal = $request->input('nominal');
        $keterangan = $request->input('keterangan');

        Transaksi::create(
            [
            'nama_pengguna' =>  $nama_pengguna,
            'kode_transaksi' => $kode_transaksi,
            'tanggal' => $tanggal,
            'kategori_id' => $kategori,
            'kas_id' => $kas,
            'ibadah_id' => $ibadah,
            'nominal' => $nominal,
            // 'nominal' => ['required', 'nominal', 'max:2'],
            'cover' => $cover,
            'keterangan' => $keterangan,
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);   

        // Transaksi::create($request->all());    
        
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('transaksi.index');
       
    }
    public function show($id)
    {
          //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
          if(Auth::user()->petugas == null) 
        {
            Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
            Session::flash('message_type', 'danger');
            return redirect()->to('/home');
        } 

        if(Auth::user()->level == 'bendahara')
        {
            //$transaksi = Transaksi::where('nama_pengguna', Auth::user()->petugas->id , Transaksi::orderBy('id','desc'))->get();
            $transaksi = Transaksi::where('nama_pengguna', Auth::user()->petugas->id)->findOrFail($id);
            // $transaksi  = Transaksi::findOrFail($id);
            // $transaksi = Transaksi::orderBy('id','desc')->findOrFail($id);     
        } else {            
            // $transaksi  = Transaksi::findOrFail($id);
            $transaksi = Transaksi::orderBy('id','desc')->findOrFail($id);
        }       
        return view('transaksi.show', compact('transaksi'));
    }

    //SEMUA USER BISA AKSES
    //UPDATE TRANSAKSI
    public function edit($id)
    {   

          //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
          if(Auth::user()->petugas == null) 
        {
            Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
            Session::flash('message_type', 'danger');
            return redirect()->to('/home');
        } 

        //transaksi edit berdasarkan user login
        $nama =  Auth::user()->petugas->id;  
        if(Auth::user()->level == 'bendahara')
        {
            $transaksi = Transaksi::where('nama_pengguna', Auth::user()->petugas->id)->findOrFail($id);   
        } else {            

            $transaksi = Transaksi::orderBy('id','desc')->findOrFail($id);
        } 
            
        if(Auth::user()->level == 'bendahara')
        {
            $kategori = DetailKategori::orderBy('updated_at','desc')->where('jenis', 'Rutin')
            ->where('petugas_id', Auth::user()->petugas->id)->get();   
        } else {            

            $kategori = DetailKategori::orderBy('updated_at','desc')->where('jenis', 'Rutin')->get(); 
        }
            
        $kas = Kas::get();
        $ibadah = Ibadah::orderBy('updated_at','desc')->get();
        
        return view('transaksi.edit', compact('kategori','kas', 'transaksi', 'nama', 'ibadah'));
        
    }

    public function update(Request $request, $id)
    {
       
        $transaksi = Transaksi::findOrFail($id);
        
        $nama = $request->input('nama_pengguna');
        $kode = $request->input('kode_transaksi');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $kas = $request->input('kas');
        $ibadah = $request->input('ibadah');
        $nominal = $request->input('nominal');
        $cover = $request->input('cover');
        $keterangan = $request->input('keterangan');
       
        if($request->file('cover')) 
        {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/Transaksi", $fileName);
            $transaksi->cover = $fileName;
        }
        
        $transaksi->nama_pengguna = $nama;
        $transaksi->kode_transaksi = $kode;
        $transaksi->tanggal = $tanggal;
        $transaksi->kategori_id = $kategori;
        $transaksi->kas_id = $kas;
        $transaksi->ibadah_id = $ibadah;
        $transaksi->nominal = $nominal;
        $transaksi->keterangan = $keterangan;
      
        $transaksi->update();
        $transaksi->save();
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('transaksi');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","Transaksi telah dihapus!");
    }

    public function hapus($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","Transaksi telah dihapus!");
    }

    //CARA CEATAK PDB BERDASARKAN ID
    public function cetak_pdf($id)
    {
        $transaksi = Transaksi::find($id);
        $datas = $transaksi->get();
        $pdf = PDF::loadView('transaksi.laporan', compact('transaksi'));
        return $pdf->download('laporan_transaksi_'.$transaksi->kode_transaksi.'.pdf');
        // return view('laporan.kk_pdf');
    }

    //KONFRIMASI
    public function status($id){
        $data = \DB::table('transaksi')->where('id',$id)->first();
 
        $status_sekarang = $data->status;
 
        if($status_sekarang == '1'){
            \DB::table('transaksi')
            ->where('id',$id)
            ->update(['status'=>'0']);
            Session::flash('message', 'Status batal dikonfirmasi');
            Session::flash('message_type', 'success');
        }else{
            \DB::table('transaksi')
            ->where('id',$id)
            ->update(['status'=>'1']);
            Session::flash('message', 'Status berhasil dikonfirmasi');
            Session::flash('message_type', 'success');
        }
        
 
        // return redirect('/transaksi');
        return redirect()->back();
    }


    
}
    
   
   
   