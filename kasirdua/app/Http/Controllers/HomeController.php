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

    public function print($id){
        return view('pages.kasir.print', [
            'transaction' => Transaction::find($id)    
        ]);
    }

    public function order_list()
    {
        return view('pages.kasir.order-list', [
            'title' => 'Order List',
            'orders' => Transaction::orderBy('id', 'DESC')->where('status', '!=', 'Cart')->get()
        ]);
    }
    public function order_list_status(Request $request)
{
    $order = Transaction::find($request->transaction_id);
    $order->update(['status' => $request->status]);

    return redirect()->back()->with('status', 'Order #' . $request->transaction_id . ' berhasil diubah menjadi ' . $request->status);
}

}



// lallal