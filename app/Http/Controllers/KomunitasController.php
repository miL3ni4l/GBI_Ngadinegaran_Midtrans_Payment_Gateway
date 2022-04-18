<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi

use Illuminate\Support\Facades\DB;

use App\Petugas;
use App\Komunitas;
use App\pemasukan_rutin;
use App\PemasukanKhusus;
use App\Ibadah;
use App\Kas;
use App\User;

use Hash;
use Auth;
use File;
use Session;

use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class KomunitasController extends Controller
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
            return redirect()->to('/home');
        } 
        //PERINTAH MEMANGGIL DATA DARI TABEL
        $komunitas = Komunitas::orderBy('updated_at','desc')->get();
        $kas = Kas::orderBy('kas','asc')->get();
        return view('komunitas.index',array('komunitas' => $komunitas, 'kas' => $kas));
    }

    //fungsi selanjutnya adalah create, fungsi ini tidak dibuat untuk proses insert data pada database 
    //melainkan hanya menampilkan form create. 
    //Jadi pada fungsi create ini kita hanya me-return view saja.
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
   
        $nama = Auth::user()->petugas->id;
        $komunitass = Komunitas::orderBy('updated_at','desc')->get();      

        return view('komunitas.create' , compact('komunitass', 'nama'));
    }


    // fungsi ini lah proses insert dilakukan. Kita gunakan fungsi create pada model untuk menginsert data.
    public function store(Request $request)
    {   
      
        // $count = Komunitas::where('komunitas',$request->input('komunitas'))->count();
        // if($count>0){
        //     Session::flash('message', 'Nama komunitas Sudah Ada !');
        //     Session::flash('message_type', 'danger');
        //     return redirect()->to('komunitas/create');
        // }

        // Komunitas::create($request->all());    

        $nama_komunitas = $request->input('nama_komunitas');
        $deskripsi = $request->input('deskripsi');
        $pj = $request->input('pj');
        $kontak = $request->input('kontak');
        // $status = $request->input('status');
        $keterangan = $request->input('keterangan');

        Komunitas::create(
            [
            'nama_komunitas' =>  $nama_komunitas,
            'deskripsi' => $deskripsi,
            'pj' => $pj,
            'kontak' => $kontak,
            // 'status' => $status,
        ]); 

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('komunitas.index');

    }

    //FILTER DATA pemasukan_rutin BERDASARKAN TANGGAL2
    public function komunitas_filter()
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
                       
        $komunitas = Komunitas::orderBy('updated_at','desc')->get();
        $kas = Kas::orderBy('kas','asc')->get();

        if($_GET['komunitas'] == "" || $_GET['kas'] == ""){
            $pemasukan_rutin = pemasukan_rutin::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status','1')
            ->get();
            $pemasukan_khusus = PemasukanKhusus::whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('status','1')
            ->get();
        }
        else{
            $pemasukan_rutin = pemasukan_rutin::where('komunitas_id',$_GET['komunitas'])
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('kas_id',$_GET['kas'])
            ->where('status','1')
            ->get();    
            $pemasukan_khusus = PemasukanKhusus::where('komunitas_id',$_GET['komunitas'])
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('kas_id',$_GET['kas'])
            ->where('status','1')
            ->get();   
        }  
        return view('komunitas.index',['pemasukan_rutin' => $pemasukan_rutin, 'pemasukan_khusus' => $pemasukan_khusus, 'komunitas'=>$komunitas, 'kas'=>$kas]);


    }
    
    public function edit($id)
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

        $nama = Auth::user()->petugas->id;
        $data = Komunitas::findOrFail($id);

        return view('komunitas.edit', compact('data','nama'));
    }

    
    public function update(Request $request, $id)
    {
        
        $komunitas = Komunitas::findOrFail($id);
        $komunitas->update();
        $komunitas->save();

        Komunitas::find($id)->update($request->all());
        
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('komunitas');
    }

    public function destroy($id)
    {
        $komunitas = Komunitas::find($id);
        $komunitas = Komunitas::orderBy('id','desc')->find($id);    
        $komunitas->delete();
      
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect('komunitas')->with('success','komunitas telah dihapus');
    }

     //KONFRIMASI
     public function status($id){
        $data = \DB::table('komunitas')->where('id',$id)->first();
 
        $status_sekarang = $data->status;
 
        if($status_sekarang == '1'){
            \DB::table('komunitas')
            ->where('id',$id)
            ->update(['status'=>'0']);
            Session::flash('message', 'Status komunitas private');
            Session::flash('message_type', 'success');
        }else{
            \DB::table('komunitas')
            ->where('id',$id)
            ->update(['status'=>'1']);
            Session::flash('message', 'Status komunitas publik');
            Session::flash('message_type', 'success');
        }
        
        // return redirect('/komunitas');
        return redirect()->back();
    }
    
}
    