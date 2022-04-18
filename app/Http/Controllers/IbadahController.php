<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;

//skripsi

use Illuminate\Support\Facades\DB;

use App\Petugas;
use App\Ibadah;
use App\pemasukan_rutin;
use App\PemasukanKhusus;
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


class IbadahController extends Controller
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
        $ibadah = Ibadah::orderBy('updated_at','desc')->get();
        $kas = Kas::orderBy('kas','asc')->get();
        return view('ibadah.index',array('ibadah' => $ibadah, 'kas' => $kas));
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

         //CARA MEMBUAT KODE KATEGORI
         $getRow = Ibadah::orderBy('id', 'DESC')->get();      
         $rowCount = $getRow->count(); 
         $lastId = $getRow->first();
         $kode = "I01";
         if ($rowCount > 0) { 
             if ($lastId->id < 9) {
                     $kode = "I0".''.($lastId->id + 1);
             } else {
                     $kode = "I".''.($lastId->id + 1);
             }
         }
           
        $nama = Auth::user()->petugas->id;
        $ibadahs = Ibadah::orderBy('updated_at','desc')->get();      

        return view('ibadah.create' , compact('ibadahs','kode', 'nama'));
    }


    // fungsi ini lah proses insert dilakukan. Kita gunakan fungsi create pada model untuk menginsert data.
    public function store(Request $request)
    {   
      
        $count = Ibadah::where('ibadah',$request->input('ibadah'))->count();
        if($count>0){
            Session::flash('message', 'Nama Ibadah Sudah Ada !');
            Session::flash('message_type', 'danger');
            return redirect()->to('ibadah/create');
        }

        Ibadah::create($request->all());    

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('ibadah.index');

    }

    //FILTER DATA pemasukan_rutin BERDASARKAN TANGGAL2
    public function ibadah_filter()
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
                       
        $ibadah = Ibadah::orderBy('updated_at','desc')->get();
        $kas = Kas::orderBy('kas','asc')->get();

        if($_GET['ibadah'] == "" || $_GET['kas'] == ""){
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
            $pemasukan_rutin = pemasukan_rutin::where('ibadah_id',$_GET['ibadah'])
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('kas_id',$_GET['kas'])
            ->where('status','1')
            ->get();    
            $pemasukan_khusus = PemasukanKhusus::where('ibadah_id',$_GET['ibadah'])
            ->whereDate('tanggal','>=',$_GET['dari'])
            ->whereDate('tanggal','<=',$_GET['sampai'])
            ->where('kas_id',$_GET['kas'])
            ->where('status','1')
            ->get();   
        }  
        return view('ibadah.index',['pemasukan_rutin' => $pemasukan_rutin, 'pemasukan_khusus' => $pemasukan_khusus, 'ibadah'=>$ibadah, 'kas'=>$kas]);


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
        $data = Ibadah::findOrFail($id);

        return view('ibadah.edit', compact('data','nama'));
    }

    
    public function update(Request $request, $id)
    {
        
        $ibadah = Ibadah::findOrFail($id);
        $ibadah->update();
        $ibadah->save();

        Ibadah::find($id)->update($request->all());
        
        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('ibadah');
    }

    public function destroy($id)
    {
        $ibadah = Ibadah::find($id);
        $ibadah = Ibadah::orderBy('id','desc')->find($id);    
        $ibadah->delete();
        $tt = pemasukan_rutin::where('ibadah_id',$id)->get();
        if($tt->count() > 0){
            $pemasukan_rutin = pemasukan_rutin::where('ibadah_id',$id)->first();
            $pemasukan_rutin->ibadah_id = "1";
            $pemasukan_rutin->save();
        }    
        Session::flash('message', 'Berhasil dihapus!');
        Session::flash('message_type', 'success');
        return redirect('ibadah')->with('success','ibadah telah dihapus');
    }

     //KONFRIMASI
     public function status($id){
        $data = \DB::table('ibadah')->where('id',$id)->first();
 
        $status_sekarang = $data->status;
 
        if($status_sekarang == '1'){
            \DB::table('ibadah')
            ->where('id',$id)
            ->update(['status'=>'0']);
            Session::flash('message', 'Status ibadah private');
            Session::flash('message_type', 'success');
        }else{
            \DB::table('ibadah')
            ->where('id',$id)
            ->update(['status'=>'1']);
            Session::flash('message', 'Status ibadah publik');
            Session::flash('message_type', 'success');
        }
        
        // return redirect('/ibadah');
        return redirect()->back();
    }
    
}
    