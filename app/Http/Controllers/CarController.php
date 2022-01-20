<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function makeavailable($id){
        DB::table('cars')
        ->where('cars.id', $id)
        ->update([
            'available'=>1
        ]);

        return redirect('/landing');
    }

    public function makenotavailable($id){
        DB::table('cars')
        ->where('cars.id', $id)
        ->update([
            'available'=>0
        ]);

        return redirect('/landing');
    }

    public function reservasi(Request $request){

        $time_now = date("Y-m-d");

        $rules = [
            'tgl_sewa' => 'after_or_equal:time_now',
            'tgl_kembali' => 'after_or_equal:tgl_sewa'
        ];

        $messages = [
            'tgl_sewa.after_or_equal' => 'Tanggal sewa hari ini atau setelah',
            'tgl_kembali.after_or_equal' => 'Tanggal kembali hari pada tanggal sewa atau setelahnya'
        ];

        $validator = Validator::make([
            'tgl_sewa'=>$request->tgl_sewa,
            'tgl_kembali'=>$request->tgl_kembali,
            'time_now'=>$time_now],
        $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $transaction = Transaction::create([
            'user_id'=>$request->user_id,
            'car_id'=>$request->car_id,
            'start_reserve'=>$request->tgl_sewa,
            'end_reserve'=>$request->tgl_kembali
        ]);
        return redirect('/landing')->with('success','Transaksi anda telah berhasil dibuat!');
    }
}
