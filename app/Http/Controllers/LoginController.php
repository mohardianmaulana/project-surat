<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session as FacadesSession;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function actionlogin(Request $request)
    {
        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();
            // Proses Login
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user); // Login manual tanpa hashing

                $role = Auth::user()->getRoleNames()->first();
                if ($role === 'pelapor') {
                    return redirect('dashboard')->with('success', 'Login Berhasil');
                } else if ($role === 'admin') {
                    return redirect('dashboard')->with('success', 'Login Berhasil');
                } else if ($role === 'upt') {
                    return redirect('dashboard')->with('success', 'Login Berhasil');
                } else {
                    return redirect('login')->with('error', 'Role tidak ditemukan');
                }                
            } else {
                Session::flash('error', 'Email atau Password Salah');
                return redirect('/');
            }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout Berhasil');
    }

    // public function register()
    // {
    //     // Lakukan join antara tabel 'user' dan 'roles' untuk mendapatkan nama role
    //     $users = User::join('roles', 'users.roles_id', '=', 'roles.id')
    //         ->select('users.*', 'roles.name as roles_name')
    //         ->get();

    //     // Tampilkan view dengan data users
    //     return view('user.register', compact('users'));
    // }

    // private function validateRecaptcha($recaptcha, $ip)
    // {
    //     $url = "https://www.google.com/recaptcha/api/siteverify";
    //     $params = [
    //         'secret' => config('services.recaptcha.secret'),
    //         'response' => $recaptcha,
    //         'remoteip' => $ip,
    //     ];

    //     $response = Http::post($url, $params);
    //     $result = json_decode($response->body());

    //     return $response->successful() && $result->success;
    // }
}
