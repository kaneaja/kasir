<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $allMenu = Menu::count();
        $allTransaction = Transaction::count();
        $allOrder = TransactionDetail::count();
        $allUser = User::count();

        // Pendapatan bulan ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $monthlySubtotal = Transaction::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('subtotal');

        $tax = $monthlySubtotal * 0.10;
        $monthlyIncome = $monthlySubtotal + $tax;

        return view('pages.admin.dashboard', compact(
            'allMenu',
            'allTransaction',
            'allOrder',
            'allUser',
            'monthlySubtotal',
            'tax',
            'monthlyIncome'
        ));
    }
}
