<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Hash;

class UserController extends Controller
{
  
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

        $datas = User::get();
        $datas = User::orderBy('updated_at','desc')->get();
        return view('auth.user', compact('datas'));
    }
 
    public function create()
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
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //DATA USERNAME SUDAH ADA
        $count = User::where('username',$request->input('username'))->count();
        if($count>0){
            Session::flash('message', 'Username telah tersedia!');
            Session::flash('message_type', 'danger');
            return redirect()->to('user/create');
        }

        $this->validate($request, [
            'name' => 'required|string|max:15',
            'username' => 'required|string|max:18|unique:users',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);


        if($request->file('foto') == '') {
            $foto = NULL;
        } else {
            $file = $request->file('foto');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('foto')->move("images/user", $fileName);
            $foto = $fileName;
        }

        User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'level' => $request->input('level'),
            'password' => bcrypt(($request->input('password'))),
            'foto' => $foto
        ]);

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->route('user.index');

    }

    public function show($id)
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

        $data = User::findOrFail($id);

        return view('auth.show', compact('data'));
    }

    public function edit($id)
    {   

        if((Auth::user()->level == 'bendahara') && (Auth::user()->id != $id)) {
            Session::flash('message', 'Oopss..', 'Anda dilarang masuk ke area ini.');
            Session::flash('message_type', 'danger');
            return redirect()->to('/');
        }
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
                

        $data = User::findOrFail($id);

        return view('auth.edit', compact('data'));
    }

    public function update(Request $request, $id)
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

        $user_data = User::findOrFail($id);

        if($request->file('foto')) 
        {
            $file = $request->file('foto');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('foto')->move("images/user", $fileName);
            $user_data->foto = $fileName;
        }

        $user_data->name = $request->input('name');
        $user_data->email = $request->input('email');
        
        
        if($request->input('password')) {
            $user_data->level = $request->input('level');
            }
        if($request->input('password')) {
            $user_data->password= bcrypt(($request->input('password')));         
            }

        $user_data->update();
        Session::flash('message', 'Berhasil diubah!');
        Session::flash('message_type', 'success');

        
        return redirect()->to('user');
    }


    public function destroy($id)
    {
        if(Auth::user()->id != $id) {
            $user_data = User::findOrFail($id);
            $user_data->delete();
            Session::flash('message', 'Berhasil dihapus!');
            Session::flash('message_type', 'success');
        } else {
            Session::flash('message', 'Akun anda sendiri tidak bisa dihapus !');
            Session::flash('message_type', 'danger');
        }
        return redirect()->to('user');
    }

    public function hapus($id)
    {
        if(Auth::user()->id != $id) {
            $user_data = User::findOrFail($id);
            $user_data->delete();
            Session::flash('message', 'Berhasil dihapus!');
            Session::flash('message_type', 'success');
        } else {
            Session::flash('message', 'Akun anda sendiri tidak bisa dihapus !');
            Session::flash('message_type', 'danger');
        }
        return redirect()->to('user');
    } 
    

    // FUNCTION VIEW RESET PASSWORD
    public function password()
    {
        return view('auth.passwords.reset');
    }

    // FUNCTION RESET PASSWORD
    public function password_update(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password telah diganti!");

    }

}
