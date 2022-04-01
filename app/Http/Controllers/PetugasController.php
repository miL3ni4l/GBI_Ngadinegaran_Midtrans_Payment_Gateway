<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Petugas;
use App\Talenta;

use Carbon\Carbon;
use Session;
  
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;


use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

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

        //Selain admin dilarang akses 
        if(Auth::user()->level == 'bendahara') {
                Session::flash('message', 'Oopss..', 'Anda dilarang masuk ke area ini.');
                Session::flash('message_type', 'danger');
            return redirect()->to('/home');
        } 

        $petugass = Petugas::orderBy('updated_at','desc')->get();
        return view('petugas.index',array('petugas' => $petugass));
  
    }


    public function create()
    {
        //Selain admin dilarang akses 
        if(Auth::user()->level == 'bendahara') {
                Session::flash('message', 'Oopss..', 'Anda dilarang masuk ke area ini.');
                Session::flash('message_type', 'danger');
            return redirect()->to('/home');
        } 

        //MENGITUNG KODE ANGGOTA SECARA OTOMATIS
        $getRow = Petugas::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        $lastId = $getRow->first();
        $kode = "NIP-00001";
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "NIP-0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "NIP-000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "NIP-00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "NIP-0".''.($lastId->id + 1);
            } else {
                    $kode = "NIP-".''.($lastId->id + 1);
            }
        }
 
        $users = User::WhereNotExists(function($query) {
                        $query->select(DB::raw(1))
                        ->from('petugas')
                        ->whereRaw('petugas.user_id = users.id');
                     })->get();


        $petugass = Petugas::get();
        return view('petugas.create', compact('users','kode', 'petugass'));

    }
    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $count = Petugas::where('kode_petugas',$request->input('kode_petugas'))->count();

        if($count>0){
            Session::flash('message', 'Already exist!');
            Session::flash('message_type', 'danger');
            return redirect()->to('petugas');
        }
        
        Petugas::create($request->all());

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('petugas.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //Selain admin dilarang akses 
        if(Auth::user()->level == 'bendahara') {
                Session::flash('message', 'Oopss..', 'Anda dilarang masuk ke area ini.');
                Session::flash('message_type', 'danger');
            return redirect()->to('/home');
        } 

        $data = petugas::findOrFail($id);
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return view('Petugas.show', compact('data'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        
         //Selain admin dilarang akses 
        if(Auth::user()->level == 'bendahara') {
            Session::flash('message', 'Oopss..', 'Anda dilarang masuk ke area ini.');
            Session::flash('message_type', 'danger');
        return redirect()->to('/home');
    } 

        $users = User::get();
        $data = Petugas::findOrFail($id);
   
        return view('petugas.edit', compact('data', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->level == 'bendahara') {
           // Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/home');
        }
        
        Petugas::find($id)->update($request->all());
        
        if($request->file('gambar') == '') {
            $gambar = NULL;
        } else {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('gambar')->move("images/petugas", $fileName);
            //$upload_image = $request->myimage->store('petugas');
            $gambar = $fileName;
        }

        Session::flash('message', 'Berhasil diedit!');
        Session::flash('message_type', 'success');
        return redirect()->to('petugas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Petugas $petugas)
    {
        if(Auth::user()->level == 'bendahara') {
            return redirect()->to('/home');
        }
        if(Auth::user()->petugas->id != $petugas) {
            $user_data = Petugas::findOrFail($petugas);
            $user_data->delete();
            Session::flash('message', 'Berhasil dihapus!');
            Session::flash('message_type', 'success');
        } else {
            Session::flash('message', 'Data anda sendiri tidak bisa dihapus !');
            Session::flash('message_type', 'danger');
        }
        return redirect()->route('petugas.index');
    }

    // public function hapus($id)
    // {
    //     if(Auth::user()->id != $id) {
    //         $user_data = User::findOrFail($id);
    //         $user_data->delete();
    //         Session::flash('message', 'Berhasil dihapus!');
    //         Session::flash('message_type', 'success');
    //     } else {
    //         Session::flash('message', 'Akun anda sendiri tidak bisa dihapus !');
    //         Session::flash('message_type', 'danger');
    //     }
    //     return redirect()->to('user');
    // }
    
}
