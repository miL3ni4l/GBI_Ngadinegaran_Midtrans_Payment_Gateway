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
use App\Transaksi;
use App\PengeluaranKhusus;
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

class PengeluaranKhususController extends Controller
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
              
            $transaksi = PengeluaranKhusus::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();           
        } else {       
                 
            $transaksi = PengeluaranKhusus::get();
            $transaksi = PengeluaranKhusus::orderBy('updated_at','desc')->get();
        }


        $kas = Kas::all();
        $kategori = DetailKategori::where('jenis', 'Khusus')->get();
        return view('pengeluaran_khusus.index', compact('transaksi','nama', 'kas', 'kategori'));

    }

    public function konfirmasi_khusus()
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
        $nama = Auth::user()->name;  
        if(Auth::user()->level == 'bendahara')
        {
              
            $transaksi = PengeluaranKhusus::orderBy('updated_at','desc')
            ->where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status', '0')
            ->get();           
        } else {       
                 
            $transaksi = PengeluaranKhusus::get();
            $transaksi = PengeluaranKhusus::orderBy('updated_at','desc')
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
        $kategori = DetailKategori::where('jenis', 'Khusus')->get();
        return view('pengeluaran_khusus.index', compact('transaksi','nama', 'kas','kategori', 'datas', 'kategoris'));
    }
   
    //FILTER DATA TRANSAKSI BERDASARKAN TANGGAL2
    public function periode_khusus()
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
        $kategori = DetailKategori::all();
        $transaksi = PengeluaranKhusus::all();
        $transaksis  = PengeluaranKhusus::count(); 

 
        $kas = Kas::orderBy('kas','asc')->get();
        $kategori = DetailKategori::where('jenis', 'Khusus')->get();
        $kas = Kas::orderBy('kas','asc')->get();


        if($_GET['kategori'] == ""  || $_GET['kas'] == ""){
            $transaksi = PengeluaranKhusus::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status', '1')
            ->get();
        }
        else{
            $transaksi = 
            PengeluaranKhusus::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('kategori_id',$_GET['kategori'])
            ->where('kas_id',$_GET['kas'])
            ->where('status', '1')
            ->get();     
        }  
        return view('pengeluaran_khusus.index',['transaksi' => $transaksi, 'kas' => $kas,'kategori' => $kategori, 'transaksis'=>$transaksis, 'datas'=>$datas,'kategoris'=>$kategoris]);


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
        $getRow = PengeluaranKhusus::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        $lastId = $getRow->first();
        $kode = "TK2$tahun";
        // $kode = "TK2$tahun-00001";
        // if ($rowCount > 0) { 
        //     if ($lastId->id < 9) {
        //             $kode = "TK2$tahun-0000".''.($lastId->id + 1);
        //     } else if ($lastId->id < 99) {
        //             $kode = "TK2$tahun-000".''.($lastId->id + 1);
        //     } else if ($lastId->id < 999) {
        //             $kode = "TK2$tahun-00".''.($lastId->id + 1);
        //     } else if ($lastId->id < 9999) {
        //             $kode = "TK2$tahun-0".''.($lastId->id + 1);
        //     } else {
        //             $kode = "TK2$tahun-".''.($lastId->id + 1);
        //     }
        // }
 
        $nama = Auth::user()->petugas->id;
        if(Auth::user()->level == 'bendahara')
        {
            
            $kategoris = DetailKategori::orderBy('updated_at','desc')
            ->where('jenis', 'khusus')
            ->where('petugas_id', Auth::user()->petugas->id)
            ->get();
        } else {            
            $kategoris = DetailKategori::orderBy('updated_at','desc')
            ->where('jenis', 'khusus')
            ->get();
        }
        
        $kass = Kas::get();
   

        return view('pengeluaran_khusus.create', compact('nama','kode','kategoris','kass'));
        
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
            $request->file('cover')->move("images/PengeluaranKhusus", $fileName);
            $cover = $fileName;
        }
        $nama_pengguna = $request->input('nama_pengguna');
        $kode_transaksi = $request->input('kode_transaksi');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $kas = $request->input('kas');
        $nominal = $request->input('nominal');
        $keterangan = $request->input('keterangan');

        PengeluaranKhusus::create(
            [
            'nama_pengguna' =>  $nama_pengguna,
            'kode_transaksi' => $kode_transaksi,
            'tanggal' => $tanggal,
            'kategori_id' => $kategori,
            'kas_id' => $kas,
            'nominal' => $nominal,
            // 'nominal' => ['required', 'nominal', 'max:2'],
            'cover' => $cover,
            'keterangan' => $keterangan,
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);   

        // PengeluaranKhusus::create($request->all());    
        
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('pengeluaran_khusus.index');
       
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
            //$transaksi = PengeluaranKhusus::where('nama_pengguna', Auth::user()->petugas->id , PengeluaranKhusus::orderBy('id','desc'))->get();
            $transaksi = PengeluaranKhusus::where('nama_pengguna', Auth::user()->petugas->id)->findOrFail($id);
            // $transaksi  = PengeluaranKhusus::findOrFail($id);
            // $transaksi = PengeluaranKhusus::orderBy('id','desc')->findOrFail($id);     
        } else {            
            // $transaksi  = PengeluaranKhusus::findOrFail($id);
            $transaksi = PengeluaranKhusus::orderBy('id','desc')->findOrFail($id);
        }       
        return view('pengeluaran_khusus.show', compact('transaksi'));
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
        $nama = Auth::user()->petugas->id;
        if(Auth::user()->level == 'bendahara')
        {
            $transaksi = PengeluaranKhusus::where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status','0')
            ->findOrFail($id);
            $transaksi  = PengeluaranKhusus::findOrFail($id);
            $transaksi = PengeluaranKhusus::orderBy('id','desc')->findOrFail($id);
           
         
        } else {            
            $transaksi  = PengeluaranKhusus::findOrFail($id);
            $transaksi = PengeluaranKhusus::orderBy('id','desc')->findOrFail($id);


        }

        //kategori berdasarkan user login
        if(Auth::user()->level == 'bendahara')
        {
            $kategori = DetailKategori::orderBy('updated_at','desc')
            ->where('jenis', 'khusus')
            ->where('petugas_id', Auth::user()->petugas->id)->get();
        } else {            
            $kategori = DetailKategori::orderBy('updated_at','desc')
            ->where('jenis', 'khusus')
            ->get();
        }
        
        $kas = Kas::get();
        
        return view('pengeluaran_khusus.edit', compact('kategori','kas', 'transaksi', 'nama'));
        
    }

    public function update(Request $request, $id)
    {
       
        $transaksi = PengeluaranKhusus::findOrFail($id);
        $nama = $request->input('nama_pengguna');
        $kode = $request->input('kode_transaksi');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $kas = $request->input('kas');
        $nominal = $request->input('nominal');
        $cover = $request->input('cover');
        $keterangan = $request->input('keterangan');
       
        if($request->file('cover')) 
        {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/PengeluaranKhusus", $fileName);
            $transaksi->cover = $fileName;
        }
        
        $transaksi->nama_pengguna = $nama;
        $transaksi->kode_transaksi = $kode;
        $transaksi->tanggal = $tanggal;
        $transaksi->kategori_id = $kategori;
        $transaksi->kas_id = $kas;
        $transaksi->nominal = $nominal;
        $transaksi->keterangan = $keterangan;
      
        $transaksi->update();
        $transaksi->save();
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('pengeluaran_khusus');
    }

    public function destroy($id)
    {
        $transaksi = PengeluaranKhusus::find($id);
        $transaksi->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","PengeluaranKhusus telah dihapus!");
    }

    public function hapus($id)
    {
        $transaksi = PengeluaranKhusus::find($id);
        $transaksi->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","PengeluaranKhusus telah dihapus!");
    }

    //CARA CEATAK PDB BERDASARKAN ID
    public function cetak_pdf($id)
    {
        $pengeluaran_khusus = PengeluaranKhusus::find($id);
        $datas = $pengeluaran_khusus->get();
        $pdf = PDF::loadView('pengeluaran_khusus.laporan', compact('pengeluaran_khusus'));
        return $pdf->download('laporan_pengeluaran_khusus_'.$pengeluaran_khusus->kode_transaksi.'.pdf');
        // return view('laporan.kk_pdf');
    }

    //KONFRIMASI
    public function status($id){
        $data = \DB::table('pengeluaran_khusus')->where('id',$id)->first();
 
        $status_sekarang = $data->status;
 
        if($status_sekarang == '1'){
            \DB::table('pengeluaran_khusus')
            ->where('id',$id)
            ->update(['status'=>'0']);
            Session::flash('message', 'Status batal dikonfirmasi');
            Session::flash('message_type', 'success');
        }else{
            \DB::table('pengeluaran_khusus')
            ->where('id',$id)
            ->update(['status'=>'1']);
            Session::flash('message', 'Status berhasil dikonfirmasi');
            Session::flash('message_type', 'success');
        }
        
        return redirect()->back();
    }


    
}
    
   
   
   