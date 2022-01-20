<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    function index($page){
        return view($page);
    }

    function register(){
        return view('register');
    }

    function editget(){
        return view('edit');
    }

    function login(){
        return view('login');
    }

    public function viewuser()
    {
        $users = DB::table('users')
                    ->select('*')
                    ->get();

        return view('userlist', compact('users'));
    }

    function insert(Request $request){

        $rules = [
            'email' => 'unique:users,email',
            'password' => 'min:8'
        ];

        $messages = [
            'email.unique' => 'Email harus unik',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter'
        ];

        $validator = Validator::make([
            'email'=>$request->email,
            'password'=>$request->password],
        $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0,
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

        $time_now = date("Y-m-d");

        $rules = [
            'tgl_lahir' => 'before_or_equal:time_now',
        ];

        $messages = [
            'tgl_lahir.before_or_equal' => 'Tanggal lahir harus hari ini atau sebelum',
        ];

        $validator = Validator::make([
            'tgl_lahir'=>$request->tgl_lahir,
            'time_now'=>$time_now],
        $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

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
