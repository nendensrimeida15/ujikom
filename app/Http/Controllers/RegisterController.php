<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        
            return view('auth.register');
    }
    public function create(){
        return view('auth.register');
    }


    public function store(Request $request)
    {
        // return request()->all();
        
        $validatedData = $request->validate([
            'username'  => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'role' => 'required',
            'verifikasi' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::Create($validatedData);
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();

            return redirect()->intended('login');
        // }

        // return back()->withInput()->with('failed','Register Failed!');
        }
}