<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nim'     => 'required|unique|string|max:255',
            'nomor'     => 'required|unique|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|exists:roles,name',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'nim'     => $request->nim,
            'nomor'     => $request->nomor,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role sesuai yang dipilih di dropdown
        $user->assignRole($request->role);

        return redirect('/register')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
