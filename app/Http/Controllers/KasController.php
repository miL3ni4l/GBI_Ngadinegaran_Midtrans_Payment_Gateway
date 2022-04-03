<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi
use Illuminate\Support\Facades\DB;
use App\Kategori;
use App\DetailKategori;
use App\Kas;
use App\pemasukan_rutin;
use App\PemasukanKhusus;
use App\PengeluaranKhusus;
use App\PengeluaranRutin;
use App\User;

use Hash;
use Auth;
use File;
use Session;


use App\Exports\LapiranExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class KasController extends Controller
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

        //PERINTAH MEMANGGIL DATA DARI TABEL
        $kas = Kas::orderBy('updated_at','desc')->get();

        return view('kas.index',array('kas' => $kas));
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
        $kas = Kas::orderBy('id','desc')->findOrFail($id); 
        return view('kas.show', compact('kas'));
    }


        //LAPORAN
        public function periode_kas()
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
                return redirect()->to('/');
            } 
    
            $kas = kas::all();
            $kategori = Kategori::all();
            $pemasukan_rutin = pemasukan_rutin::all();
            $pemasukan_rutins  = pemasukan_rutin::count(); 
            $pengeluaran_khususs  = PengeluaranKhusus::count(); 
            $pengeluaran_rutins  = PengeluaranRutin::count(); 
    
            $seluruh_pemasukan = DB::table('pemasukan_rutin')->select(DB::raw('SUM(nominal) as total'))
            ->where('status', '1')
            ->first();
    
            $seluruh_pengeluaran = DB::table('pemasukan_rutin')
            ->select(DB::raw('SUM(nominal) as total'))
            ->where('status', '1')
            ->first();
    
            if(isset($_GET['kas']))
            {
                $kas = kas::orderBy('kas','asc')->get();
                // $kategori = detailkategori::orderBy('kategori','asc')->get();
                if($_GET['kas'] == ""){
                    $pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
                    ->where('status', '1')
                    ->whereDate('tanggal','<=',$_GET['sampai'])
                    ->orderby('updated_at', 'desc')
                    ->get();
    
                    $pemasukan_khusus = PemasukanKhusus::whereDate('tanggal','>=',$_GET['dari'])
                    ->where('status', '1')
                    ->whereDate('tanggal','<=',$_GET['sampai'])
                    ->orderby('updated_at', 'desc')
                    ->get();
    
                    $pengeluaran_khusus = PengeluaranKhusus::whereDate('tanggal','>=',$_GET['dari'])
                    ->where('status', '1')
                    ->whereDate('tanggal','<=',$_GET['sampai'])
                    ->orderby('updated_at', 'desc')
                    ->get();
    
                    $pengeluaran_rutin = PengeluaranRutin::whereDate('tanggal','>=',$_GET['dari'])
                    ->where('status', '1')
                    ->whereDate('tanggal','<=',$_GET['sampai'])
                    ->orderby('updated_at', 'desc')
                    ->get();
                }else{
                    $pemasukan_rutin = pemasukan_rutin::where('kas_id',$_GET['kas'])
                    ->where('status', '1')
                    ->whereDate('tanggal','>=',$_GET['dari'])
                    ->whereDate('tanggal','<=',$_GET['sampai'])
                    ->orderby('updated_at', 'desc')
                    ->get();
    
                    $pemasukan_khusus = PemasukanKhusus::where('kas_id',$_GET['kas'])
                    ->where('status', '1')
                    ->whereDate('tanggal','>=',$_GET['dari'])
                    ->whereDate('tanggal','<=',$_GET['sampai'])
                    ->orderby('updated_at', 'desc')
                    ->get();
    
                    $pengeluaran_khusus = PengeluaranKhusus::where('kas_id',$_GET['kas'])
                    ->where('status', '1')
                    ->whereDate('tanggal','>=',$_GET['dari'])
                    ->whereDate('tanggal','<=',$_GET['sampai'])
                    ->orderby('updated_at', 'desc')
                    ->get();
    
                    $pengeluaran_rutin = PengeluaranRutin::where('kas_id',$_GET['kas'])
                    ->where('status', '1')
                    ->whereDate('tanggal','>=',$_GET['dari'])
                    ->whereDate('tanggal','<=',$_GET['sampai'])
                    ->orderby('updated_at', 'desc')
                    ->get();
                }    
                 return view('kas.index',['pemasukan_rutin' => $pemasukan_rutin, 'pengeluaran_khusus' => $pengeluaran_khusus, 'pengeluaran_rutin' => $pengeluaran_rutin,
                 'kas' => $kas, 
                 'pemasukan_khusus' => $pemasukan_khusus,  
                 'seluruh_pemasukan' => $seluruh_pemasukan,  
                 'seluruh_pengeluaran' => $seluruh_pengeluaran,
                 'pemasukan_rutins'=>$pemasukan_rutins]);
            }
                else{
                $kategori = kategori::orderBy('kategori','asc')->get();
                return view('kas.index',['pemasukan_rutin' => array(), 'kas' => $kas,
                'pengeluaran_khususs' => $pengeluaran_khususs, 'pengeluaran_rutins' => $pengeluaran_rutins,
                'pemasukan_rutins'=>$pemasukan_rutins]);
            
            }
    
    
    
        }


    //fungsi selanjutnya adalah create, fungsi ini tidak dibuat untuk proses insert data pada database 
    //melainkan hanya menampilkan form create. 
    //Jadi pada fungsi create ini kita hanya me-return view saja.

    public function create(Request $req)
    {
        if(Auth::user()->petugas == null) 
        {
            Session::flash('message', 'Anda Belum Ditambahkan Sebagai Petugas !');
            Session::flash('message_type', 'danger');
            return redirect()->to('/home');
        } 

        
        $nama = Auth::user()->petugas->id;
        $kass = Kas::orderBy('updated_at','desc')->get();      

        return view('kas.create' , compact('kass', 'nama'));
    }


    // fungsi ini lah proses insert dilakukan. Kita gunakan fungsi create pada model untuk menginsert data.
    public function store(Request $request)
    {   
         // HASIL AKHIR
        // if($request->file('cover') == '') {
        //     $cover = NULL;
        //     } else {
        //     $file = $request->file('cover');
        //     $dt = Carbon::now();
        //     $acak  = $file->getClientOriginalExtension();
        //     $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
        //     $request->file('cover')->move("images/Kas", $fileName);
        //     $cover = $fileName;
        // }
      
        $count = Kas::where('kas',$request->input('kas'))->count();
        if($count>0){
            Session::flash('message', 'Nama Kas Sudah Ada !');
            Session::flash('message_type', 'danger');
            return redirect()->to('kas/create');
        }

        $kas = $request->input('kas');
        $keterangan = $request->input('keterangan');
  
        Kas::create([
            'kas' =>  $kas,
            // 'cover' => $cover,
            'keterangan' => $keterangan,
        ]);   

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('kas.index');

    }

    
    public function edit($id)
    {   
        if(Auth::user()->level == 'bendahara') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

     
        $nama = Auth::user()->petugas->id;
        $data = Kas::findOrFail($id);

        return view('kas.edit', compact('data','nama'));
    }

    
    public function update(Request $request, $id)
    {
        
        $kas = kas::findOrFail($id);
        Kas::find($id)->update($request->all());

 
        // if($request->file('cover')) 
        // {
        //     $file = $request->file('cover');
        //     $dt = Carbon::now();
        //     $acak  = $file->getClientOriginalExtension();
        //     $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
        //     $request->file('cover')->move("images/Kas", $fileName);
        //     $kas->cover = $fileName;
        // }
        
        $kas->update();
        $kas->save();
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('kas');
    }

    public function destroy($id)
    {
        $kas = Kas::find($id);
        $kas = Kas::orderBy('id','desc')->find($id);    
        $kas->delete();
        $tt = pemasukan_rutin::where('kas_id',$id)->get();
        if($tt->count() > 0){
            $pemasukan_rutin = pemasukan_rutin::where('kas_id',$id)->first();
            $pemasukan_rutin->kas_id = "1";
            $pemasukan_rutin->save();
        }    
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect('kas')->with('success','kas telah dihapus');
    }
    
}
    