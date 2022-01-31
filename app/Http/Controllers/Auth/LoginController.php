<?php

namespace App\Http\Controllers\Auth;

use Illumintae\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // return $this->authenticated();
    }


    public function authenticated($user)
    {
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.index');
        }
        elseif($user->hasRole('pengurus')){
            return redirect()->route('pengurus.index');
        }
        elseif($user->hasRole('user')){
            return redirect()->route('mahasiswa.index');
        }
        else{
           echo "gabisa";
        }
    }

    public function doLogin(Request $request)
    {
        $logintype = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $login = [
            $logintype => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('username', $request->email)->orWhere('email', $request->email)->first();

        if(Auth::attempt($login)){
            
            if (auth()->user()->id_role == 1) {
                return redirect()->route('panitia.index')->with('success', 'Berhasil login, Selamat datang');
            }
            elseif (auth()->user()->id_role == 2){
                return redirect()->route('pengurus.index')->with('success', 'Berhasil login, Selamat datang');
            }
            elseif (auth()->user()->id_role == 3){
                return redirect()->route('mahasiswa.index')->with('success', 'Berhasil login, Selamat datang');
            }
        }
        return redirect()->route('login')->with('error', 'Email atau password salah');
    
    }


    
}
