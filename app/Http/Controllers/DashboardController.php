<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wage;
use App\Models\Order;
use App\Models\Client;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // $transactions = Transaction::whereNotNull('status')->orderBy('id', 'desc')->get();
        // $allTransactions = Transaction::whereNotNull('status')->get()->count();
        // $todayTransactions = Transaction::whereNotNull('status')->whereDate('created_at', Carbon::today())->count();
        // Count orders for the current month
        // $monthTransactions = Transaction::whereNotNull('status')
        //     ->whereYear('created_at', $currentYear)
        //     ->whereMonth('created_at', $currentMonth)
        //     ->count();
        $allAdmins = User::whereNotNull('status')->get()->count();
        $allEmployees = Employee::whereNotNull('status')->get()->count();
        // $allClients = Client::whereNotNull('status')->get()->count();
        $allProducts = Product::whereNotNull('status')->get()->count();
        $allOrders = Order::whereNotNull('status')->get()->count();
        $allTransactions = Transaction::whereNotNull('status')->get()->count();
        $allWages = Wage::whereNotNull('status')->get()->count();
        $allExpenses = Expense::whereNotNull('status')->get()->count();
        return view('app.dashboard', compact('allAdmins', 'allEmployees', 'allProducts', 'allOrders', 'allTransactions', 'allWages', 'allExpenses'));
    }
}
