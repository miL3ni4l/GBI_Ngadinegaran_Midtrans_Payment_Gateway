<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;


use App\User;
use App\Petugas;
use App\DetailKategori;
use App\Kategori;
use App\Kas;
use App\pemasukan_rutin;
use App\PersembahanPengeluaranKhusus;
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

class PrsmbhnPnglrnKhsController extends Controller
{

    //READ pemasukan_rutin
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
              
            $pemasukan_rutin = PersembahanPengeluaranKhusus::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();           
        } else {       
                 
            $pemasukan_rutin = PersembahanPengeluaranKhusus::get();
            $pemasukan_rutin = PersembahanPengeluaranKhusus::orderBy('updated_at','desc')->get();
        }


        $kas = Kas::all();
        $kategori = DetailKategori::where('jenis', 'Khusus')->get();
        return view('persembahan_pengeluaran_khusus.index', compact('pemasukan_rutin','nama', 'kas', 'kategori'));

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
              
            $pemasukan_rutin = PersembahanPengeluaranKhusus::orderBy('updated_at','desc')
            ->where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status', '0')
            ->get();           
        } else {       
                 
            $pemasukan_rutin = PersembahanPengeluaranKhusus::get();
            $pemasukan_rutin = PersembahanPengeluaranKhusus::orderBy('updated_at','desc')
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
        return view('persembahan_pengeluaran_khusus.index', compact('pemasukan_rutin','nama', 'kas','kategori', 'datas', 'kategoris'));
    }
   
    //FILTER DATA pemasukan_rutin BERDASARKAN TANGGAL2
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
        $pemasukan_rutin = PersembahanPengeluaranKhusus::all();
        $pemasukan_rutins  = PersembahanPengeluaranKhusus::count(); 

 
        $kas = Kas::orderBy('kas','asc')->get();
        $kategori = DetailKategori::where('jenis', 'Khusus')->get();
        $kas = Kas::orderBy('kas','asc')->get();


        if($_GET['kategori'] == ""){
            $pemasukan_rutin = PersembahanPengeluaranKhusus::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status', '1')
            ->get();
        }
        else{
            $pemasukan_rutin = 
            PersembahanPengeluaranKhusus::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('kategori_id',$_GET['kategori'])
            ->where('status', '1')
            ->get();     
        }  
        return view('persembahan_pengeluaran_khusus.index',['pemasukan_rutin' => $pemasukan_rutin, 'kas' => $kas,'kategori' => $kategori, 'pemasukan_rutins'=>$pemasukan_rutins, 'datas'=>$datas,'kategoris'=>$kategoris]);


    }

    public function laporan_excel()
    {
        return Excel::download(new LaporanExport, 'Laporan.xlsx');
    }

    //MENAMBAHKAN DATA pemasukan_rutin
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
        $getRow = PersembahanPengeluaranKhusus::orderBy('id', 'DESC')->get();
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
   

        return view('persembahan_pengeluaran_khusus.create', compact('nama','kode','kategoris','kass'));
        
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
            $request->file('cover')->move("images/PersembahanPengeluaranKhusus", $fileName);
            $cover = $fileName;
        }
        $nama_pengguna = $request->input('nama_pengguna');
        $kode_persembahan_pengeluaran_khusus = $request->input('kode_persembahan_pengeluaran_khusus');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $nominal = $request->input('nominal');
        $status = $request->input('status');
        $keterangan = $request->input('keterangan');

        PersembahanPengeluaranKhusus::create(
            [
            'nama_pengguna' =>  $nama_pengguna,
            'kode_persembahan_pengeluaran_khusus' => $kode_persembahan_pengeluaran_khusus,
            'tanggal' => $tanggal,
            'kategori_id' => $kategori,
            'nominal' => $nominal,
            'status' => $status,
            // 'nominal' => ['required', 'nominal', 'max:2'],
            'cover' => $cover,
            'keterangan' => $keterangan,
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);   

        // PersembahanPengeluaranKhusus::create($request->all());    
        
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('persembahan_pengeluaran_khusus.index');
       
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
            //$pemasukan_rutin = PersembahanPengeluaranKhusus::where('nama_pengguna', Auth::user()->petugas->id , PersembahanPengeluaranKhusus::orderBy('id','desc'))->get();
            $pemasukan_rutin = PersembahanPengeluaranKhusus::where('nama_pengguna', Auth::user()->petugas->id)->findOrFail($id);
            // $pemasukan_rutin  = PersembahanPengeluaranKhusus::findOrFail($id);
            // $pemasukan_rutin = PersembahanPengeluaranKhusus::orderBy('id','desc')->findOrFail($id);     
        } else {            
            // $pemasukan_rutin  = PersembahanPengeluaranKhusus::findOrFail($id);
            $pemasukan_rutin = PersembahanPengeluaranKhusus::orderBy('id','desc')->findOrFail($id);
        }       
        return view('persembahan_pengeluaran_khusus.show', compact('pemasukan_rutin'));
    }

    //SEMUA USER BISA AKSES
    //UPDATE pemasukan_rutin
    public function edit($id)
    {   

          //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
          if(Auth::user()->petugas == null) 
        {
            Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
            Session::flash('message_type', 'danger');
            return redirect()->to('/home');
        } 

        //pemasukan_rutin edit berdasarkan user login
        $nama = Auth::user()->petugas->id;
        if(Auth::user()->level == 'bendahara')
        {
            $pemasukan_rutin = PersembahanPengeluaranKhusus::where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status','0')
            ->findOrFail($id);
            $pemasukan_rutin  = PersembahanPengeluaranKhusus::findOrFail($id);
            $pemasukan_rutin = PersembahanPengeluaranKhusus::orderBy('id','desc')->findOrFail($id);
           
         
        } else {            
            $pemasukan_rutin  = PersembahanPengeluaranKhusus::findOrFail($id);
            $pemasukan_rutin = PersembahanPengeluaranKhusus::orderBy('id','desc')->findOrFail($id);


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
        
        return view('persembahan_pengeluaran_khusus.edit', compact('kategori','kas', 'pemasukan_rutin', 'nama'));
        
    }

    public function update(Request $request, $id)
    {
       
        $pemasukan_rutin = PersembahanPengeluaranKhusus::findOrFail($id);
        $nama = $request->input('nama_pengguna');
        $kode = $request->input('kode_persembahan_pengeluaran_khusus');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $nominal = $request->input('nominal');
        $cover = $request->input('cover');
        $keterangan = $request->input('keterangan');
       
        if($request->file('cover')) 
        {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/PersembahanPengeluaranKhusus", $fileName);
            $pemasukan_rutin->cover = $fileName;
        }
        
        $pemasukan_rutin->nama_pengguna = $nama;
        $pemasukan_rutin->kode_persembahan_pengeluaran_khusus = $kode;
        $pemasukan_rutin->tanggal = $tanggal;
        $pemasukan_rutin->kategori_id = $kategori;
        $pemasukan_rutin->nominal = $nominal;
        $pemasukan_rutin->keterangan = $keterangan;
      
        $pemasukan_rutin->update();
        $pemasukan_rutin->save();
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('persembahan_pengeluaran_khusus');
    }

    public function destroy($id)
    {
        $pemasukan_rutin = PersembahanPengeluaranKhusus::find($id);
        $pemasukan_rutin->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","PersembahanPengeluaranKhusus telah dihapus!");
    }

    public function hapus($id)
    {
        $pemasukan_rutin = PersembahanPengeluaranKhusus::find($id);
        $pemasukan_rutin->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","PersembahanPengeluaranKhusus telah dihapus!");
    }

    //CARA CEATAK PDB BERDASARKAN ID
    public function cetak_pdf($id)
    {
        $pengeluaran_khusus = PersembahanPengeluaranKhusus::find($id);
        $datas = $pengeluaran_khusus->get();
        $pdf = PDF::loadView('persembahan_pengeluaran_khusus.laporan', compact('pengeluaran_khusus'));
        return $pdf->download('laporan_pengeluaran_khusus_'.$pengeluaran_khusus->kode_persembahan_pengeluaran_khusus.'.pdf');
        // return view('laporan.kk_pdf');
    }

    //KONFRIMASI
    public function status($id){
        $data = \DB::table('persembahan_pengeluaran_khusus')->where('id',$id)->first();
 
        $status_sekarang = $data->status;
 
        if($status_sekarang == '1'){
            \DB::table('persembahan_pengeluaran_khusus')
            ->where('id',$id)
            ->update(['status'=>'0']);
            Session::flash('message', 'Status batal dikonfirmasi');
            Session::flash('message_type', 'success');
        }else{
            \DB::table('persembahan_pengeluaran_khusus')
            ->where('id',$id)
            ->update(['status'=>'1']);
            Session::flash('message', 'Status berhasil dikonfirmasi');
            Session::flash('message_type', 'success');
        }
        
        return redirect()->back();
    }


    
}
    
   
   
   