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
use App\pengeluaran_rutin;
use App\PersembahanPersembahanPengeluaranRutin;
use App\PersembahanPengeluaranRutin;
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

class PrsmbhnPnglrnRtnController extends Controller
{

    //READ pengeluaran_rutin
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
              
            $pengeluaran_rutin = PersembahanPengeluaranRutin::orderBy('updated_at','desc')->where('nama_pengguna', Auth::user()->petugas->id)->get();           
        } else {       
                
            $pengeluaran_rutin = PersembahanPengeluaranRutin::orderBy('updated_at','desc')->get();
        }



        $kategori = DetailKategori::where('jenis', 'Rutin')->get();
        $kategori_pengeluaran = DetailPengeluaran::orderBy('updated_at','desc')->get();
        return view('persembahan_pengeluaran_rutin.index', compact('pengeluaran_rutin','nama', 'kategori','kategori_pengeluaran'));

    }

    public function konfirmasi_persembahan_rutin()
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
              
            $pengeluaran_rutin = PersembahanPengeluaranRutin::orderBy('updated_at','desc')
            ->where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status', '0')
            ->get();           
        } else {       
                 
            $pengeluaran_rutin = PersembahanPengeluaranRutin::get();
            $pengeluaran_rutin = PersembahanPengeluaranRutin::orderBy('updated_at','desc')
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
      
        $kategori = DetailKategori::where('jenis', 'Rutin')->get();
        return view('persembahan_pengeluaran_rutin.index', compact('pengeluaran_rutin','nama', 'kategori', 'datas', 'kategoris','kategori_pengeluaran'));
    }
   

    public function periode_persembahan_rutin()
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


        $kategori = DetailKategori::all();
        $kategori_pengeluaran = DetailPengeluaran::all();
        $pengeluaran_rutin = PersembahanPengeluaranRutin::all();
        $pengeluaran_rutins  = PersembahanPengeluaranRutin::count(); 

 

        $kategori_pengeluaran = DetailPengeluaran::orderBy('updated_at','asc')->get();
        $kategori = DetailKategori::where('jenis', 'Rutin')->get();


        if( $_GET['kategori_pengeluaran'] == "" ){
            $pengeluaran_rutin = PersembahanPengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status','1')
            ->get();
        }
        else{
            $pengeluaran_rutin = 
            PersembahanPengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('detail_pengeluaran',$_GET['kategori_pengeluaran'])
            ->where('status','1')
            ->get();     
        }  
        return view('persembahan_pengeluaran_rutin.index',['pengeluaran_rutin' => $pengeluaran_rutin, 'kategori_pengeluaran'=>$kategori_pengeluaran,'kategori' => $kategori, 'pengeluaran_rutins'=>$pengeluaran_rutins, 'datas'=>$datas,'kategoris'=>$kategoris]);


    }
    public function laporan_excel()
    {
        return Excel::download(new LaporanExport, 'Laporan.xlsx');
    }

    //MENAMBAHKAN DATA pengeluaran_rutin
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
        $getRow = PersembahanPengeluaranRutin::orderBy('id', 'DESC')->get();
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
        $seluruh_pengeluaran_rutin = DB::table('pengeluaran_rutin')->select(DB::raw('SUM(nominal) as total'))
        ->where('status','1')
        ->where('kategori_id',  $id_kategori )
        ->first();
        $total = $seluruh_pengeluaran_rutin->total;

        $nama = Auth::user()->petugas->id;
        if(Auth::user()->level == 'bendahara')
        {   
            $kategoris = DetailKategori::orderBy('updated_at','desc')
            ->where('nama_pengguna',  $nama )
            ->get();
        }        
  
        $kategoris = DetailKategori::orderBy('updated_at','desc')->where('jenis', 'Rutin')->get();
        $detail_pengeluarans = DetailPengeluaran::orderBy('updated_at','desc')->get();


        $pengeluaran_rutins = PersembahanPengeluaranRutin::get();

        return view('persembahan_pengeluaran_rutin.create', compact('nama','kode','kategoris','detail_pengeluarans', 'pengeluaran_rutins', 'total'));
        
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
            $request->file('cover')->move("images/PersembahanPengeluaranRutin", $fileName);
            $cover = $fileName;
        }
        $nama_pengguna = $request->input('nama_pengguna');
        $kode_persembahan_pengeluaran_rutin = $request->input('kode_persembahan_pengeluaran_rutin');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
        $detail_pengeluaran = $request->input('detail_pengeluaran');
        $nominal = $request->input('nominal');
        $status = $request->input('status');
        $keterangan = $request->input('keterangan');

        PersembahanPengeluaranRutin::create(
            [
            'nama_pengguna' =>  $nama_pengguna,
            'kode_persembahan_pengeluaran_rutin' => $kode_persembahan_pengeluaran_rutin,
            'tanggal' => $tanggal,
            'kategori_id' => $kategori,
            'detail_pengeluaran' => $detail_pengeluaran,

            'nominal' => $nominal,
            'status' => $status,
            // 'nominal' => ['required', 'nominal', 'max:2'],
            'cover' => $cover,
            'keterangan' => $keterangan,
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);   

        // PersembahanPengeluaranRutin::create($request->all());    
        
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('persembahan_pengeluaran_rutin.index');
       
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
            $pengeluaran_rutin = PersembahanPengeluaranRutin::where('nama_pengguna', Auth::user()->petugas->id)->findOrFail($id);   
        } else {            
            $pengeluaran_rutin = PersembahanPengeluaranRutin::orderBy('id','desc')->findOrFail($id);
        }       
        return view('persembahan_pengeluaran_rutin.show', compact('pengeluaran_rutin'));
    }

    //SEMUA USER BISA AKSES
    //UPDATE pengeluaran_rutin
    public function edit($id)
    {   

          //AKUN BELUM TERDAFTAR DI TABEL PETUGAS
          if(Auth::user()->petugas == null) 
        {
            Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
            Session::flash('message_type', 'danger');
            return redirect()->to('/home');
        } 

        //pengeluaran_rutin edit berdasarkan user login
        $nama = Auth::user()->petugas->id;
        if(Auth::user()->level == 'bendahara')
        {
            $pengeluaran_rutin = PersembahanPengeluaranRutin::where('nama_pengguna', Auth::user()->petugas->id)
            ->where('status','0')
            ->findOrFail($id);
            $pengeluaran_rutin  = PersembahanPengeluaranRutin::findOrFail($id);
            $pengeluaran_rutin = PersembahanPengeluaranRutin::orderBy('id','desc')->findOrFail($id);
           
         
        } else {            
            $pengeluaran_rutin  = PersembahanPengeluaranRutin::findOrFail($id);
            $pengeluaran_rutin = PersembahanPengeluaranRutin::orderBy('id','desc')->findOrFail($id);


        }
          
        $kategori = DetailKategori::orderBy('updated_at','desc')
        ->where('Jenis', 'Rutin')
        ->get();
        $kategori_pengeluaran = DetailPengeluaran::orderBy('updated_at','desc')->get();
     
        


        return view('persembahan_pengeluaran_rutin.edit', compact('kategori','kategori_pengeluaran','pengeluaran_rutin', 'nama'));
        
    }

    public function update(Request $request, $id)
    {
       
        $pengeluaran_rutin = PersembahanPengeluaranRutin::findOrFail($id);
        $nama = $request->input('nama_pengguna');
        $kode = $request->input('kode_persembahan_pengeluaran_rutin');
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori_id');
        $detail_pengeluaran = $request->input('detail_pengeluaran');

        $nominal = $request->input('nominal');
        $cover = $request->input('cover');
        $keterangan = $request->input('keterangan');
       
        if($request->file('cover')) 
        {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/PersembahanPengeluaranRutin", $fileName);
            $pengeluaran_rutin->cover = $fileName;
        }
        
        $pengeluaran_rutin->nama_pengguna = $nama;
        $pengeluaran_rutin->kode_persembahan_pengeluaran_rutin = $kode;
        $pengeluaran_rutin->tanggal = $tanggal;
        $pengeluaran_rutin->kategori_id = $kategori;
        $pengeluaran_rutin->detail_pengeluaran = $detail_pengeluaran;
        // $pengeluaran_rutin->detail_pengeluaran = $detail_pengeluaran;
        // $pengeluaran_rutin->kategori_pengeluaran_id = $kategori_pengeluaran;
        $pengeluaran_rutin->nominal = $nominal;
        $pengeluaran_rutin->keterangan = $keterangan;
      
        $pengeluaran_rutin->update();
        $pengeluaran_rutin->save();
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('persembahan_pengeluaran_rutin');
    }

    public function destroy($id)
    {
        $pengeluaran_rutin = PersembahanPengeluaranRutin::find($id);
        $pengeluaran_rutin->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","PersembahanPengeluaranRutin telah dihapus!");
    }

    public function hapus($id)
    {
        $pengeluaran_rutin = PersembahanPengeluaranRutin::find($id);
        $pengeluaran_rutin->delete();
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect()->back()->with("success","PersembahanPengeluaranRutin telah dihapus!");
    }

    //CARA CEATAK PDB BERDASARKAN ID
    public function cetak_pdf($id)
    {
        $pengeluaran_rutin = PersembahanPengeluaranRutin::find($id);
        $datas = $pengeluaran_rutin->get();
        $pdf = PDF::loadView('persembahan_pengeluaran_rutin.laporan', compact('pengeluaran_rutin'));
        return $pdf->download('laporan_persembahan_pengeluaran_rutin_'.$pengeluaran_rutin->kode_persembahan_pengeluaran_rutin.'.pdf');
        // return view('laporan.kk_pdf');
    }

    //KONFRIMASI
    public function status($id){
        $data = \DB::table('persembahan_pengeluaran_rutin')->where('id',$id)->first();
 
        $status_sekarang = $data->status;
 
        if($status_sekarang == '1'){
            \DB::table('persembahan_pengeluaran_rutin')
            ->where('id',$id)
            ->update(['status'=>'0']);
            Session::flash('message', 'Status batal dikonfirmasi');
            Session::flash('message_type', 'success');
        }else{
            \DB::table('persembahan_pengeluaran_rutin')
            ->where('id',$id)
            ->update(['status'=>'1']);
            Session::flash('message', 'Status berhasil dikonfirmasi');
            Session::flash('message_type', 'success');
        }
        
        return redirect()->back();
    }


    
}
    
   
   
   