<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function show(){
        $cars = Car::all();

        return view('landing', compact('cars'));
    }

    public function detail($id){
        $cars = Car::where('id', $id)->first();

        return view('carsdetail', compact('cars'));
    }

    public function reservasi(Request $request){
        $transaction = Transaction::create([
            'user_id'=>$request->user_id,
            'car_id'=>$request->car_id,
            'start_reserve'=>$request->tgl_sewa,
            'end_reserve'=>$request->tgl_kembali
        ]);
        return redirect('/landing')->with('success','Transaksi anda telah berhasil dibuat!');
    }
}
