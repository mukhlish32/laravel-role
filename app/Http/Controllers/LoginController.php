<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
//use DB;

class LoginController extends Controller
{
    public function index()
    {
        return redirect()->route('login');
    }

    public function cekLogin()
    {
        if(Auth::check()){
            if(Session::get('akses_id')==1){
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('kategori-biaya.index');
            }
        }else{
            return view('index');
        }
    }

    public function prosesLogin(Request $request)
    {
        Session::flash('username',$request->username);
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ],[
            'username.required'=>'Username wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        $infologin = [
            'username'=>$request->username,
            'password'=>$request->password
            //'akses_id'=> 2
        ];

        if(Auth::attempt($infologin)){
            $user_id = Auth::user()->id;
            $query = "SELECT role, role_id FROM user
                      INNER JOIN role ON role.id = user.role_id 
                      WHERE user.id='$user_id'
                      LIMIT 1";
            $akses_login=DB::select($query);
            if (!empty($akses_login)) {
                Session::put('akses_id', $akses_login[0]->role_id);
                Session::put('akses', $akses_login[0]->role);
            }else{
                Session::put('akses_id', NULL);
                Session::put('akses', NULL);
            }

            if(Session::get('akses_id')==1){
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('kategori-biaya.index');
            }
        }else{
            session()->flush();
            return redirect()->back()->with('msgbox','Username atau Password salah')->with('typebox','alert-warning');;
        }
    }

    public function prosesLogout()
    {
        Auth::logout();
        session()->flush();
        
        return redirect()->route('login');
    }
}
