<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Pendaftaran;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $logintype = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $login = [
            $logintype => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('name', $request->email)->orWhere('email', $request->email)->first();

        if(Auth::attempt($login)){
            
            if (auth()->user()->id_role == 1) {
                smilify('success', 'Berhasil Login',' Selamat Datang');
                return redirect()->route('panitia.index');
            }
            elseif (auth()->user()->id_role == 2){
                smilify('success', 'Berhasil Login, Selamat Datang');
                return redirect()->route('pengurus.index');
            }
            elseif (auth()->user()->id_role == 3){
                smilify('success', 'Berhasil Login, Selamat Datang');
                return redirect()->route('mahasiswa.index');
            }
        }
        // notify()->error('Email atau password salah', 'Maaf');
        smilify('error', 'Maaf Email atau Password Salah');
        return redirect()->route('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            // 'nim' => ['required', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $cekemail = User::where('email', $request->email)->first();
        $ceknim = User::where('nim', $request->nim)->first();

        if ($cekemail) {
            smilify('error', 'Maaf yang anda gunakan sudah terdaftar');
            return back();
        } elseif ($ceknim) {
            smilify('error', 'NIM yang anda gunakan sudah terdaftar');
            return back();
        } elseif ($request->password) {
            $this->validate($request, [
                'password'  => 'min:6 | required',
                ]);
        }
        
        $data = [
            'nim' => $request->nim,
            'name' => $request->name,
            'id_role' => '3',
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $lastid = User::create($data)->id;

        // $pendaftarans = new Pendaftaran;
        // $pendaftarans->nim = $request->nim;
        // $pendaftarans->nama = $request->name;
        // $pendaftarans->id_prodi = $request->prodi;
        // $pendaftarans->id_user = $lastid;
        // $pendaftarans->save();

        smilify('success', 'Selamat Berhasil Membuat Akun, Silahkan Login disini');
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        smilify('success', 'Berhasil Logout');

        return redirect()->route('login');
    }
}
