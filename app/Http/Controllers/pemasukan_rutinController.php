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
use App\pemasukan_rutin;
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

class pemasukan_rutinController extends Controller
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
              
            $pemasukan_rutin = pemasukan_rutin::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();           
        } else {       
                 
            $pemasukan_rutin = pemasukan_rutin::get();
            $pemasukan_rutin = pemasukan_rutin::orderBy('updated_at','desc')->get();
        }

        $kas = Kas::all();
        $ibadah = Ibadah::all();
        $kategori = DetailKategori::where('jenis', 'Rutin')->get();
        return view('pemasukan_rutin.index', compact('pemasukan_rutin','nama', 'kas', 'ibadah','kategori'));
        // return view('pemasukan_rutin.index',['pemasukan_rutin' => $pemasukan_rutin, 'nama_pengguna' => $nama]);

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
            $pemasukan_rutin = pemasukan_rutin::orderBy('updated_at','desc')
            ->where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status', '0')
            ->get();           
        } else {       
                 
            $pemasukan_rutin = pemasukan_rutin::get();
            $pemasukan_rutin = pemasukan_rutin::orderBy('updated_at','desc')
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
        return view('pemasukan_rutin.index', compact('pemasukan_rutin','nama', 'kas','ibadah','kategori', 'datas', 'kategoris'));
    }
   
    //FILTER DATA pemasukan_rutin BERDASARKAN TANGGAL2
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
        $kategori = DetailKategori::all();
        $pemasukan_rutin = pemasukan_rutin::all();
        $pemasukan_rutins  = pemasukan_rutin::count(); 

 
        $kas = Kas::orderBy('kas','asc')->get();
        $kategori = DetailKategori::orderBy('kategori','asc')
        ->where('jenis', 'Rutin')->get();
        $kas = kas::orderBy('kas','asc')->get();


        if($_GET['ibadah'] == "" || $_GET['kategori'] == ""  || $_GET['kas'] == ""){
            $pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status','1')
            ->get();
        }
        else{
            $pemasukan_rutin = 
            pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('ibadah_id',$_GET['ibadah'])
            ->where('kategori_id',$_GET['kategori'])
            ->where('kas_id',$_GET['kas'])
            ->where('status','1')
            ->get();     
        }  
        return view('pemasukan_rutin.index',['pemasukan_rutin' => $pemasukan_rutin, 'kas' => $kas,'kategori' => $kategori,'ibadah' => $ibadah, 'pemasukan_rutins'=>$pemasukan_rutins, 'datas'=>$datas,'kategoris'=>$kategoris]);


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
        $getRow = pemasukan_rutin::orderBy('id', 'DESC')->get();
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
        $pemasukan_rutins = pemasukan_rutin::get();

        return view('pemasukan_rutin.create', compact('nama','kode','kategoris','kass', 'ibadahs',  'pemasukan_rutins'));
        
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
            $request->file('cover')->move("images/pemasukan_rutin", $fileName);
            $cover = $fileName;
        }
        $nama_pengguna = $request->input('nama_pengguna');
        $kode_pemasukan_rutin = $request->input('kode_pemasukan_rutin');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $status = $request->input('status');
        $kas = $request->input('kas');
        $ibadah = $request->input('ibadah');
        $nominal = $request->input('nominal');
        $keterangan = $request->input('keterangan');

        pemasukan_rutin::create(
            [
            'nama_pengguna' =>  $nama_pengguna,
            'kode_pemasukan_rutin' => $kode_pemasukan_rutin,
            'tanggal' => $tanggal,
            'kategori_id' => $kategori,
            'status' => $status,
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

        // pemasukan_rutin::create($request->all());    
        
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('pemasukan_rutin.index');
       
    }
   
    //MENAMBAHKAN DATA pemasukan_rutin
    public function pemasukan_rutin_create_rutin(Request $request)
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


        $getRow = pemasukan_rutin::orderBy('id', 'DESC')->get();
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
        $pemasukan_rutins = pemasukan_rutin::get();

        return view('pemasukan_rutin.pemasukan_rutin_create_rutin', compact('nama','kode','kategoris','kass', 'ibadahs',  'pemasukan_rutins'));
        
    }

    public function pemasukan_rutin_store_rutin(Request $request)
    {   

        // HASIL AKHIR
        if($request->file('cover') == '') {
            $cover = NULL;
            } else {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/pemasukan_rutin", $fileName);
            $cover = $fileName;
        }
        $nama_pengguna = $request->input('nama_pengguna');
        $kode_pemasukan_rutin = $request->input('kode_pemasukan_rutin');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $kas = $request->input('kas');
        $ibadah = $request->input('ibadah');
        $nominal = $request->input('nominal');
        $keterangan = $request->input('keterangan');

        pemasukan_rutin::create(
            [
            'nama_pengguna' =>  $nama_pengguna,
            'kode_pemasukan_rutin' => $kode_pemasukan_rutin,
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

        // pemasukan_rutin::create($request->all());    
        
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('pemasukan_rutin.index');
       
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
            //$pemasukan_rutin = pemasukan_rutin::where('nama_pengguna', Auth::user()->petugas->id , pemasukan_rutin::orderBy('id','desc'))->get();
            $pemasukan_rutin = pemasukan_rutin::where('nama_pengguna', Auth::user()->petugas->id)->findOrFail($id);
            // $pemasukan_rutin  = pemasukan_rutin::findOrFail($id);
            // $pemasukan_rutin = pemasukan_rutin::orderBy('id','desc')->findOrFail($id);     
        } else {            
            // $pemasukan_rutin  = pemasukan_rutin::findOrFail($id);
            $pemasukan_rutin = pemasukan_rutin::orderBy('id','desc')->findOrFail($id);
        }       
        return view('pemasukan_rutin.show', compact('pemasukan_rutin'));
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
        $nama =  Auth::user()->petugas->id;  
        if(Auth::user()->level == 'bendahara')
        {
            $pemasukan_rutin = pemasukan_rutin::where('nama_pengguna', Auth::user()->petugas->id)->findOrFail($id);   
        } else {            

            $pemasukan_rutin = pemasukan_rutin::orderBy('id','desc')->findOrFail($id);
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
        
        return view('pemasukan_rutin.edit', compact('kategori','kas', 'pemasukan_rutin', 'nama', 'ibadah'));
        
    }

    public function update(Request $request, $id)
    {
       
        $pemasukan_rutin = pemasukan_rutin::findOrFail($id);
        
        $nama = $request->input('nama_pengguna');
        $kode = $request->input('kode_pemasukan_rutin');
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
            $request->file('cover')->move("images/pemasukan_rutin", $fileName);
            $pemasukan_rutin->cover = $fileName;
        }
        
        $pemasukan_rutin->nama_pengguna = $nama;
        $pemasukan_rutin->kode_pemasukan_rutin = $kode;
        $pemasukan_rutin->tanggal = $tanggal;
        $pemasukan_rutin->kategori_id = $kategori;
        $pemasukan_rutin->kas_id = $kas;
        $pemasukan_rutin->ibadah_id = $ibadah;
        $pemasukan_rutin->nominal = $nominal;
        $pemasukan_rutin->keterangan = $keterangan;
      
        $pemasukan_rutin->update();
        $pemasukan_rutin->save();
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('pemasukan_rutin');
    }

    public function destroy($id)
    {
        $pemasukan_rutin = pemasukan_rutin::find($id);
        $pemasukan_rutin->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","pemasukan_rutin telah dihapus!");
    }

    public function hapus($id)
    {
        $pemasukan_rutin = pemasukan_rutin::find($id);
        $pemasukan_rutin->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","pemasukan_rutin telah dihapus!");
    }

    //CARA CEATAK PDB BERDASARKAN ID
    public function cetak_pdf($id)
    {
        $pemasukan_rutin = pemasukan_rutin::find($id);
        $datas = $pemasukan_rutin->get();
        $pdf = PDF::loadView('pemasukan_rutin.laporan', compact('pemasukan_rutin'));
        return $pdf->download('laporan_pemasukan_rutin_'.$pemasukan_rutin->kode_pemasukan_rutin.'.pdf');
        // return view('laporan.kk_pdf');
    }

    //KONFRIMASI
    public function status($id){
        $data = \DB::table('pemasukan_rutin')->where('id',$id)->first();
 
        $status_sekarang = $data->status;
 
        if($status_sekarang == '1'){
            \DB::table('pemasukan_rutin')
            ->where('id',$id)
            ->update(['status'=>'0']);
            Session::flash('message', 'Status batal dikonfirmasi');
            Session::flash('message_type', 'success');
        }else{
            \DB::table('pemasukan_rutin')
            ->where('id',$id)
            ->update(['status'=>'1']);
            Session::flash('message', 'Status berhasil dikonfirmasi');
            Session::flash('message_type', 'success');
        }
        
 
        // return redirect('/pemasukan_rutin');
        return redirect()->back();
    }


    
}
    
   
   
   