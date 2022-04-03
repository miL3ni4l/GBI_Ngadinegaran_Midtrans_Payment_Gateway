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
use App\PemasukanKhusus;
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

class PemasukanKhususController extends Controller
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
              
            $pemasukan_khusus = PemasukanKhusus::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();           
        } else {       
            $pemasukan_khusus = PemasukanKhusus::orderBy('updated_at','desc')->get();
        }

        $kas = Kas::all();
        $ibadah = Ibadah::all();
        $kategori = DetailKategori::where('jenis', 'Khusus')->get();
        return view('pemasukan_khusus.index', compact('pemasukan_khusus','nama', 'kas', 'ibadah','kategori'));
        // return view('pemasukan_khusus.index',['pemasukan_khusus' => $pemasukan_khusus, 'nama_pengguna' => $nama]);

    }

    public function konfirmasi_pemasukan_khusus()
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
        $nama =  Auth::user()->petugas->id;  
        if(Auth::user()->level == 'bendahara')
        {
            $pemasukan_khusus = PemasukanKhusus::orderBy('updated_at','desc')
            ->where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status', '0')
            ->get();           
        } else {       
                 
            $pemasukan_khusus = PemasukanKhusus::get();
            $pemasukan_khusus = PemasukanKhusus::orderBy('updated_at','desc')
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
        return view('pemasukan_khusus.index', compact('pemasukan_khusus','nama', 'kas','ibadah','kategori', 'datas', 'kategoris'));
    }
   
    //FILTER DATA pemasukan_rutin BERDASARKAN TANGGAL2
    public function periode_pemasukan_khusus()
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

        //KATEGORI BERDASARKAN USERLOGIN
        if(Auth::user()->level == 'bendahara')
        { 
            $pemasukan_khusus = PemasukanKhusus::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();
        } 
        else 
        {               
            $pemasukan_khusus = PemasukanKhusus::orderBy('updated_at','desc')->get();   
        }

        $kas = Kas::all();
        $ibadah = Ibadah::all();
        $kategori = DetailKategori::all();
        $pemasukan_khusus = PemasukanKhusus::all();
        $pemasukan_khususs  = PemasukanKhusus::count(); 

 
        $kas = Kas::orderBy('kas','asc')->get();
        $kategori = DetailKategori::orderBy('kategori','asc')
        ->where('jenis', 'Khusus')->get();
        $kas = kas::orderBy('kas','asc')->get();


        if($_GET['ibadah'] == "" || $_GET['kategori'] == ""  || $_GET['kas'] == ""){
            $pemasukan_khusus = PemasukanKhusus::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status','1')
            ->get();
        }
        else{
            $pemasukan_khusus = 
            PemasukanKhusus::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('ibadah_id',$_GET['ibadah'])
            ->where('kategori_id',$_GET['kategori'])
            ->where('kas_id',$_GET['kas'])
            ->where('status','1')
            ->get();     
        }  
        return view('pemasukan_khusus.index',['pemasukan_khusus' => $pemasukan_khusus, 'kas' => $kas,'kategori' => $kategori,'ibadah' => $ibadah, 'pemasukan_khususs'=>$pemasukan_khususs]);


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
        $getRow = PemasukanKhusus::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        $lastId = $getRow->first();
        $kode = "TM2$tahun";
        // $kode = "TM2$tahun-00001";
        // if ($rowCount > 0) { 
        //     if ($lastId->id < 9) {
        //             $kode = "TM2$tahun-0000".''.($lastId->id + 1);
        //     } else if ($lastId->id < 99) {
        //             $kode = "TM2$tahun-000".''.($lastId->id + 1);
        //     } else if ($lastId->id < 999) {
        //             $kode = "TM2$tahun-00".''.($lastId->id + 1);
        //     } else if ($lastId->id < 9999) {
        //             $kode = "TM2$tahun-0".''.($lastId->id + 1);
        //     } else {
        //             $kode = "TM2$tahun-".''.($lastId->id + 1);
        //     }
        // }
 
      
        if(Auth::user()->level == 'bendahara')
        {
            $nama = Auth::user()->petugas->id;
            $kategoris = DetailKategori::orderBy('updated_at','desc')
            ->where('petugas_id', Auth::user()->petugas->id)
            ->where('jenis', 'Khusus')
            ->get();
        } else {            
            $nama = Auth::user()->petugas->id;
            $kategoris = DetailKategori::orderBy('updated_at','desc')
            ->where('jenis', 'Khusus')
            ->get();
        }
        
        $kass = Kas::get();
        $ibadahs = Ibadah::all();
        $pemasukan_khususs = PemasukanKhusus::get();

        return view('pemasukan_khusus.create', compact('nama','kode','kategoris','kass', 'ibadahs',  'pemasukan_khususs'));
        
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
            $request->file('cover')->move("images/PemasukanKhusus", $fileName);
            $cover = $fileName;
        }
        $nama_pengguna = $request->input('nama_pengguna');
        $kode_pemasukan_khusus = $request->input('kode_pemasukan_khusus');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $kas = $request->input('kas');
        $ibadah = $request->input('ibadah');
        $nominal = $request->input('nominal');
        $keterangan = $request->input('keterangan');

        PemasukanKhusus::create(
            [
            'nama_pengguna' =>  $nama_pengguna,
            'kode_pemasukan_khusus' => $kode_pemasukan_khusus,
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

        // PemasukanKhusus::create($request->all());    
        
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('pemasukan_khusus.index');
       
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
            $pemasukan_khusus = PemasukanKhusus::where('nama_pengguna', Auth::user()->petugas->id)->findOrFail($id);
        } else {            
            $pemasukan_khusus = PemasukanKhusus::orderBy('id','desc')->findOrFail($id);
        }       
        return view('pemasukan_khusus.show', compact('pemasukan_khusus'));
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

        //pemasukan_khusus edit berdasarkan user login
        $nama = Auth::user()->petugas->id;
        if(Auth::user()->level == 'bendahara')
        {
            $pemasukan_khusus = PemasukanKhusus::where('nama_pengguna', Auth::user()->petugas->id)->findOrFail($id);
        } else {            
            $pemasukan_khusus = PemasukanKhusus::orderBy('id','desc')->findOrFail($id);
        } 

        if(Auth::user()->level == 'bendahara')
        {
            $kategori = DetailKategori::orderBy('updated_at','desc')
            ->where('Jenis', 'Khusus')
            ->where('petugas_id', Auth::user()->petugas->id)->get();
        } else {            
            $kategori = DetailKategori::orderBy('updated_at','desc')->get();  
        } 
       
        $kas = Kas::get();
        $ibadah = Ibadah::orderBy('updated_at','desc')->get();
        
        return view('pemasukan_khusus.edit', compact('kategori','kas', 'pemasukan_khusus', 'nama', 'ibadah'));
        
    }

    public function update(Request $request, $id)
    {
       
        $pemasukan_khusus = PemasukanKhusus::findOrFail($id);
        $nama = $request->input('nama_pengguna');
        $kode = $request->input('kode_pemasukan_khusus');
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
            $request->file('cover')->move("images/PemasukanKhusus", $fileName);
            $pemasukan_khusus->cover = $fileName;
        }
         
        $pemasukan_khusus->nama_pengguna = $nama;
        $pemasukan_khusus->kode_pemasukan_khusus = $kode;
        $pemasukan_khusus->tanggal = $tanggal;
        $pemasukan_khusus->kategori_id = $kategori;
        $pemasukan_khusus->kas_id = $kas;
        $pemasukan_khusus->ibadah_id = $ibadah;
        $pemasukan_khusus->nominal = $nominal;
        $pemasukan_khusus->keterangan = $keterangan;
      
        $pemasukan_khusus->update();
        $pemasukan_khusus->save();
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('pemasukan_khusus');
    }

    public function destroy($id)
    {
        $pemasukan_khusus = PemasukanKhusus::find($id);
        $pemasukan_khusus->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","PemasukanKhusus telah dihapus!");
    }

    public function hapus($id)
    {
        $pemasukan_khusus = PemasukanKhusus::find($id);
        $pemasukan_khusus->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","PemasukanKhusus telah dihapus!");
    }

    //CARA CEATAK PDB BERDASARKAN ID
    public function cetak_pdf_pemasukan_khusus($id)
    {
        $pemasukan_khusus = PemasukanKhusus::find($id);
        $datas = $pemasukan_khusus->get();
        $pdf = PDF::loadView('pemasukan_khusus.laporan', compact('pemasukan_khusus'));
        return $pdf->download('laporan_pemasukan_khusus_'.$pemasukan_khusus->kode_pemasukan_khusus.'.pdf');
        // return view('laporan.kk_pdf');
    }

    //KONFRIMASI
    public function status($id){
        $data = \DB::table('pemasukan_khusus')->where('id',$id)->first();
 
        $status_sekarang = $data->status;
 
        if($status_sekarang == '1'){
            \DB::table('pemasukan_khusus')
            ->where('id',$id)
            ->update(['status'=>'0']);
            Session::flash('message', 'Status batal dikonfirmasi');
            Session::flash('message_type', 'success');
        }else{
            \DB::table('pemasukan_khusus')
            ->where('id',$id)
            ->update(['status'=>'1']);
            Session::flash('message', 'Status berhasil dikonfirmasi');
            Session::flash('message_type', 'success');
        }
        
 
        // return redirect('/pemasukan_khusus');
        return redirect()->back();
    }


    
}
    
   
   
   