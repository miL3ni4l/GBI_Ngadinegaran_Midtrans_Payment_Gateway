<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;


use App\User;
use App\Petugas;
use App\Kategori;
use App\DetailKategori;
use App\DetailPengeluaran;
use App\Kas;
use App\pemasukan_rutin;
use App\PengeluaranRutin;
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

class PengeluaranRutinController extends Controller
{

    //READ pemasukan_rutin
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
            return redirect()->to('/home');
        } 

        //CARA MENAMPILKAN USER LOGIN YANG MENAMBAHKAN DATA
        $nama = Auth::user()->name;  
        if(Auth::user()->level == 'bendahara')
        {
              
            $pemasukan_rutin = PengeluaranRutin::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();           
        } else {       
                
            $pemasukan_rutin = PengeluaranRutin::orderBy('updated_at','desc')->get();
        }


        $kas = Kas::orderBy('updated_at','desc')->get();
        $kategori = DetailKategori::where('jenis', 'Rutin')->get();
        $kategori_pengeluaran = DetailPengeluaran::orderBy('updated_at','desc')->get();
        return view('pengeluaran_rutin.index', compact('pemasukan_rutin','nama', 'kas', 'kategori','kategori_pengeluaran'));

    }

    public function konfirmasi_rutin()
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
              
            $pemasukan_rutin = PengeluaranRutin::orderBy('updated_at','desc')
            ->where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status', '0')
            ->get();           
        } else {       
                 
            $pemasukan_rutin = PengeluaranRutin::get();
            $pemasukan_rutin = PengeluaranRutin::orderBy('updated_at','desc')
            ->where('status', '0')
            ->get();
        }

        //KATEGORI BERDASARKAN USERLOGIN
        if(Auth::user()->level == 'bendahara')
        { 
            $datas = Kategori::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();  
            $details = Kategori::orderBy('updated_at','desc')->get();                       
            $kategoris =  Kategori::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();  
           
        } 
        else 
        {               
            $datas = Kategori::orderBy('updated_at','desc')->get();
            $details = Kategori::orderBy('updated_at','desc')->get();
            $kategoris = Kategori::orderBy('updated_at','desc')->get();   
            
        }

        $kategori_pengeluaran = DetailPengeluaran::orderBy('updated_at','desc')->get();
        $kas = Kas::orderBy('updated_at','desc')->get();
        $kategori = DetailKategori::where('jenis', 'Rutin')->get();
        return view('pengeluaran_rutin.index', compact('pemasukan_rutin','nama', 'kas','kategori', 'datas', 'kategoris','kategori_pengeluaran'));
    }
   
    //FILTER DATA pemasukan_rutin BERDASARKAN TANGGAL2
    // public function periode_rutin()
    // {   
    //      //Akses Dari Luar 
    //     if(Auth::user() == '') {
    //         Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
    //         return redirect()->to('login');
    //     } 

    //     //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
    //     if(Auth::user()->petugas == null) 
    //     {
    //         Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
    //         Session::flash('message_type', 'danger');
    //         return redirect()->to('/');
    //     } 

    //     //KATEGORI BERDASARKAN USERLOGIN
    //     if(Auth::user()->level == 'bendahara')
    //     { 
    //         $datas = Kategori::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();  
    //         $details = Kategori::orderBy('updated_at','desc')->get();                       
    //         $kategoris =  Kategori::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();  
    //     } 
    //     else 
    //     {               
    //         $datas = Kategori::orderBy('updated_at','desc')->get();
    //         $details = Kategori::orderBy('updated_at','desc')->get();
    //         $kategoris = Kategori::orderBy('updated_at','desc')->get();   
    //     }

    //     $kas = Kas::all();
    //     $kategori = Kategori::all();
    //     $pemasukan_rutin = PengeluaranRutin::all();
    //     $pemasukan_rutins  = PengeluaranRutin::count(); 

 
    //     $kas = Kas::orderBy('kas','asc')->get();
    //     $kategori = Kategori::orderBy('kategori','asc')->get();
    //     $kas = Kas::orderBy('kas','asc')->get();


    //     if($_GET['kategori'] == ""){
    //         $pemasukan_rutin = PengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
    //         ->whereDate('tanggal','<=',$_GET['sampai'])
    //         ->where('status', '1')
    //         ->get();
    //     }
    //     else{
    //         $pemasukan_rutin = 
    //         PengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
    //         ->whereDate('tanggal','<=',$_GET['sampai'])
    //         ->where('kategori_id',$_GET['kategori'])
    //         // ->where('kas_id',$_GET['kas'])
    //         ->where('status', '1')
    //         ->get();     
    //     }  
    //     return view('pengeluaran_rutin.index',['pemasukan_rutin' => $pemasukan_rutin, 'kas' => $kas,'kategori' => $kategori, 'pemasukan_rutins'=>$pemasukan_rutins, 'datas'=>$datas,'kategoris'=>$kategoris]);


    // }

    public function periode_rutin()
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
            $datas = Kategori::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();  
            $details = Kategori::orderBy('updated_at','desc')->get();                       
            $kategoris =  Kategori::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();  
        } 
        else 
        {               
            $datas = Kategori::orderBy('updated_at','desc')->get();
            $details = Kategori::orderBy('updated_at','desc')->get();
            $kategoris = Kategori::orderBy('updated_at','desc')->get();   
        }

        $kas = Kas::all();
        $kategori = DetailKategori::all();
        $kategori_pengeluaran = DetailPengeluaran::all();
        $pemasukan_rutin = PengeluaranRutin::all();
        $pemasukan_rutins  = PengeluaranRutin::count(); 

 
        $kas = Kas::orderBy('kas','asc')->get();
        $kategori_pengeluaran = DetailPengeluaran::orderBy('updated_at','asc')->get();
        $kategori = DetailKategori::where('jenis', 'Rutin')->get();
        $kas = Kas::orderBy('kas','asc')->get();

        if( $_GET['kategori_pengeluaran'] == ""  || $_GET['kas'] == ""){
            $pemasukan_rutin = PengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status','1')
            ->get();
        }
        else{
            $pemasukan_rutin = 
            PengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('detail_pengeluaran',$_GET['kategori_pengeluaran'])
            ->where('kas_id',$_GET['kas'])
            ->where('status','1')
            ->get();     
        }  
        return view('pengeluaran_rutin.index',['pemasukan_rutin' => $pemasukan_rutin, 'kategori_pengeluaran'=>$kategori_pengeluaran,'kas' => $kas,'kategori' => $kategori, 'pemasukan_rutins'=>$pemasukan_rutins, 'datas'=>$datas,'kategoris'=>$kategoris]);


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
        $getRow = PengeluaranRutin::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        $lastId = $getRow->first();
        $kode = "TK1$tahun";
        // $kode = "TK1$tahun-00001";
        // if ($rowCount > 0) { 
        //     if ($lastId->id < 9) {
        //             $kode = "TK1$tahun-0000".''.($lastId->id + 1);
        //     } else if ($lastId->id < 99) {
        //             $kode = "TK1$tahun-000".''.($lastId->id + 1);
        //     } else if ($lastId->id < 999) {
        //             $kode = "TK1$tahun-00".''.($lastId->id + 1);
        //     } else if ($lastId->id < 9999) {
        //             $kode = "TK1$tahun-0".''.($lastId->id + 1);
        //     } else {
        //             $kode = "TK1$tahun-".''.($lastId->id + 1);
        //     }
        // }
 

        $id_kategori = DetailKategori::where('jenis','Rutin')->get();
        $seluruh_pemasukan_rutin = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->where('kategori_id',  $id_kategori )
        ->first();
        $total = $seluruh_pemasukan_rutin->total;

        $nama = Auth::user()->petugas->id;
        if(Auth::user()->level == 'bendahara')
        {   
            $kategoris = DetailKategori::orderBy('updated_at','desc')
            ->where('nama_pengguna',  $nama )
            ->get();
        }        
  
        $kategoris = DetailKategori::orderBy('updated_at','desc')->where('jenis', 'Rutin')->get();
        $detail_pengeluarans = DetailPengeluaran::orderBy('updated_at','desc')->get();
        $kass = Kas::get();

        $pemasukan_rutins = PengeluaranRutin::get();

        return view('pengeluaran_rutin.create', compact('nama','kode','kategoris','detail_pengeluarans','kass', 'pemasukan_rutins', 'total'));
        
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
            $request->file('cover')->move("images/PengeluaranRutin", $fileName);
            $cover = $fileName;
        }
        $nama_pengguna = $request->input('nama_pengguna');
        $kode_pemasukan_rutin = $request->input('kode_pemasukan_rutin');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $detail_pengeluaran = $request->input('detail_pengeluaran');
        $kas = $request->input('kas');
        $nominal = $request->input('nominal');
        $keterangan = $request->input('keterangan');

        PengeluaranRutin::create(
            [
            'nama_pengguna' =>  $nama_pengguna,
            'kode_pemasukan_rutin' => $kode_pemasukan_rutin,
            'tanggal' => $tanggal,
            'kategori_id' => $kategori,
            'detail_pengeluaran' => $detail_pengeluaran,
            'kas_id' => $kas,
            'nominal' => $nominal,
            // 'nominal' => ['required', 'nominal', 'max:2'],
            'cover' => $cover,
            'keterangan' => $keterangan,
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);   

        // PengeluaranRutin::create($request->all());    
        
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('pengeluaran_rutin.index');
       
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
            $pemasukan_rutin = PengeluaranRutin::where('nama_pengguna', Auth::user()->petugas->id)->findOrFail($id);   
        } else {            
            $pemasukan_rutin = PengeluaranRutin::orderBy('id','desc')->findOrFail($id);
        }       
        return view('pengeluaran_rutin.show', compact('pemasukan_rutin'));
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
            $pemasukan_rutin = PengeluaranRutin::where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status','0')
            ->findOrFail($id);
            $pemasukan_rutin  = PengeluaranRutin::findOrFail($id);
            $pemasukan_rutin = PengeluaranRutin::orderBy('id','desc')->findOrFail($id);
           
         
        } else {            
            $pemasukan_rutin  = PengeluaranRutin::findOrFail($id);
            $pemasukan_rutin = PengeluaranRutin::orderBy('id','desc')->findOrFail($id);


        }
          
        $kategori = DetailKategori::orderBy('updated_at','desc')
        ->where('Jenis', 'Rutin')
        ->get();
        $kategori_pengeluaran = DetailPengeluaran::orderBy('updated_at','desc')->get();
     
        
        $kas = Kas::get();

        return view('pengeluaran_rutin.edit', compact('kategori','kategori_pengeluaran','kas', 'pemasukan_rutin', 'nama'));
        
    }

    public function update(Request $request, $id)
    {
       
        $pemasukan_rutin = PengeluaranRutin::findOrFail($id);
        $nama = $request->input('nama_pengguna');
        $kode = $request->input('kode_pemasukan_rutin');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori_id');
        $detail_pengeluaran = $request->input('detail_pengeluaran');
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
            $request->file('cover')->move("images/PengeluaranRutin", $fileName);
            $pemasukan_rutin->cover = $fileName;
        }
        
        $pemasukan_rutin->nama_pengguna = $nama;
        $pemasukan_rutin->kode_pemasukan_rutin = $kode;
        $pemasukan_rutin->tanggal = $tanggal;
        $pemasukan_rutin->kategori_id = $kategori;
        $pemasukan_rutin->detail_pengeluaran = $detail_pengeluaran;
        // $pemasukan_rutin->detail_pengeluaran = $detail_pengeluaran;
        // $pemasukan_rutin->kategori_pengeluaran_id = $kategori_pengeluaran;
        $pemasukan_rutin->kas_id = $kas;
        $pemasukan_rutin->nominal = $nominal;
        $pemasukan_rutin->keterangan = $keterangan;
      
        $pemasukan_rutin->update();
        $pemasukan_rutin->save();
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('pengeluaran_rutin');
    }

    public function destroy($id)
    {
        $pemasukan_rutin = PengeluaranRutin::find($id);
        $pemasukan_rutin->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","PengeluaranRutin telah dihapus!");
    }

    public function hapus($id)
    {
        $pemasukan_rutin = PengeluaranRutin::find($id);
        $pemasukan_rutin->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","PengeluaranRutin telah dihapus!");
    }

    //CARA CEATAK PDB BERDASARKAN ID
    public function cetak_pdf($id)
    {
        $pengeluaran_rutin = PengeluaranRutin::find($id);
        $datas = $pengeluaran_rutin->get();
        $pdf = PDF::loadView('pengeluaran_rutin.laporan', compact('pengeluaran_rutin'));
        return $pdf->download('laporan_pengeluaran_rutin_'.$pengeluaran_rutin->kode_pemasukan_rutin.'.pdf');
        // return view('laporan.kk_pdf');
    }

    //KONFRIMASI
    public function status($id){
        $data = \DB::table('pengeluaran_rutin')->where('id',$id)->first();
 
        $status_sekarang = $data->status;
 
        if($status_sekarang == '1'){
            \DB::table('pengeluaran_rutin')
            ->where('id',$id)
            ->update(['status'=>'0']);
            Session::flash('message', 'Status batal dikonfirmasi');
            Session::flash('message_type', 'success');
        }else{
            \DB::table('pengeluaran_rutin')
            ->where('id',$id)
            ->update(['status'=>'1']);
            Session::flash('message', 'Status berhasil dikonfirmasi');
            Session::flash('message_type', 'success');
        }
        
        return redirect()->back();
    }


    
}
    
   
   
   