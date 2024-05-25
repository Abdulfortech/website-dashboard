<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

class AccountingController extends Controller
{
    //
    public function index()
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $transactions = Transaction::whereNotNull('status')->orderBy('id', 'desc')->get();
        $allTransactions = Transaction::whereNotNull('status')->get()->count();
        $todayTransactions = Transaction::whereNotNull('status')->whereDate('created_at', Carbon::today())->count();
        // Count orders for the current month
        $monthTransactions = Transaction::whereNotNull('status')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();
        return view('app.accounting.index', compact('transactions', 'allTransactions', 'monthTransactions', 'todayTransactions'));
    }

    
    public function view(Transaction $transaction)
    {
        return view('app.accounting.view', compact('transaction'));
    }

    public function print(transaction $transaction)
    {
        // $content = file_get_contents('output.php');
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->loadView('app.accounting.pdf', ['transaction'=> $transaction]);

        return $pdf->download('AUCO-transaction-.pdf');
    }

    public function printAll()
    {
        $transactions = Transaction::whereNotNull('status')->orderBy('id', 'desc')->get();
        $allTransactions = Transaction::whereNotNull('status')->get()->count();
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.accounting.pdfAll', ['transactions'=> $transactions, 'allTransactions'=> $allTransactions]);

        return $pdf->download('AUCO-transactions.pdf');
    }

    public function generateReport(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $validatedData['start_date'];
        $endDate = $validatedData['end_date'];
        
        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
        $totalTransactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
        $totalAmount = Transaction::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->sum('amount');
        $paidTransactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Paid')->count();
        $canceledTransactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Canceled')->count();

        return view('app.accounting.report', compact('transactions', 'startDate', 'endDate', 'totalTransactions', 'totalAmount', 'paidTransactions', 'canceledTransactions'));
    }

    public function printReport(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
        $totalTransactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
        $totalAmount = Transaction::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->sum('amount');
        $paidTransactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Paid')->count();
        $canceledTransactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Canceled')->count();

        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.accounting.pdfReport', 
        ['transactions'=> $transactions, 'startDate'=> $startDate, 
         'endDate'=>$endDate, 'totalTransactions'=>$totalTransactions, 
         'totalAmount'=>$totalAmount, 'paidTransactions'=>$paidTransactions, 
         'canceledTransactions'=>$canceledTransactions]);

        return $pdf->download('Transaction-Report-'.$startDate .'-'. $endDate.'.pdf');
    }
}
