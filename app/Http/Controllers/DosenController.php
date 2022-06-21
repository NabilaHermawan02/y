<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function register() {
        $data['tittle'] = 'Register';
        return view('dosen/register', $data);
    }

    public function register_action(Request $request) {
        $request->validate([
            'nidn' => 'required',
            'nama' => 'required',
            'telpon' => 'required',
            'keahlian' => 'required',
            'username' => 'required|unique:tb_dosen',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        $dosen = new Dosen([
            'nidn' => $request -> nidn,
            'nama' => $request -> nama,
            'telpon' => $request -> telpon,
            'keahlian' => $request -> keahlian,
            'username' => $request -> username,
            'password' => Hash::make($request -> username),
        ]);
        $dosen->save();
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silahkan login');
    }
    public function login() {
        $data['tittle'] = 'Login';
        return view('dosen/login', $data);
    }
    public function login_action(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request -> username, 'password' => $request -> password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors('password', 'Login gagal, password atau username salah');
    }
}
