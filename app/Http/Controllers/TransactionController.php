<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function viewtransaction()
    {
        $transactions = DB::table('transactions')
                        ->join('cars', 'transactions.car_id', 'cars.id')
                        ->join('users', 'transactions.user_id', 'users.id')
                        ->select('transactions.*', 'cars.car_name', 'cars.price', 'users.name')
                        ->orderBy('transactions.created_at')
                        ->get();

        return view('alltransactionlist', compact('transactions'));
    }

    public function viewuserhistory()
    {
        $user_id = Auth::user()->id;

        $transactions = DB::table('transactions')
                        ->join('cars', 'transactions.car_id', 'cars.id')
                        ->select('transactions.*', 'cars.car_name', 'cars.price')
                        ->where('transactions.user_id', $user_id)
                        ->orderBy('transactions.created_at')
                        ->get();

        return view('history', compact('transactions'));
    }
}
