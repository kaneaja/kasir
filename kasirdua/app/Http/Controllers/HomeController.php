<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('pages.kasir.index');
    }
    
    public function success($id){
        return view('pages.kasir.success', [
            'transaction' => Transaction::find($id)    
        ]);
    }
}



// lallal