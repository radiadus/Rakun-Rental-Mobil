<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    function index($page){
        return view($page);
    }

    function insert(Request $request){
        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/');
    }

    function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/landing');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    function edit(Request $request)
    {
        if($request->file('foto')!=Null){
            $filename = $request->file('foto')->getClientOriginalName();
            $generate_file = time().'_'.$filename;
            $request->file('foto')->storeAs('public/profile', $generate_file);
        }else{
            $generate_file = auth()->user()->local_avatar;
        }


        $User = User::where('id', auth()->user()->id)->update(['nik' => $request->nik, 'tgl_lahir' => $request->tgl_lahir, 'local_avatar' => $generate_file]);
        return redirect('/landing');
    }
}
