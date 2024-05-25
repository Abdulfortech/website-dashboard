<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Department;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

class ExpenseController extends Controller
{
    //
    public function index()
    {
        if(auth()->user()->userType == 'super-admin'){
            $expenses = Expense::whereNotNull('status')->orderBy('id', 'desc')->get();
            $allExpenses = Expense::whereNotNull('status')->get()->count();
            $activeExpenses = Expense::where('status', 'Active')->get()->count();
            $canceledExpenses = Expense::where('status', 'Canceled')->get()->count();
        }else{
            $expenses = Expense::where('added_by', auth()->user()->id)->whereNotNull('status')->orderBy('id', 'desc')->get();
            $allExpenses = Expense::where('added_by', auth()->user()->id)->whereNotNull('status')->get()->count();
            $activeExpenses = Expense::where('added_by', auth()->user()->id)->where('status', 'Active')->get()->count();
            $canceledExpenses = Expense::where('added_by', auth()->user()->id)->where('status', 'Canceled')->get()->count();
        }
        return view('app.expenses.index', compact('expenses', 'allExpenses', 'activeExpenses', 'canceledExpenses'));
    }

    public function add()
    {
        $departments = Department::whereNotNull('status')->get();
        return view('app.expenses.add', compact('departments'));
    }

    public function view(Expense $expense)
    {
        return view('app.expenses.view', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $departments = Department::whereNotNull('status')->get();
        return view('app.expenses.edit', compact('expense','departments'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'required|string',
            'date' => 'nullable|date',
        ]);

        $credentials['added_by'] = auth()->user()->id;
        $credentials['business_id'] = auth()->user()->business->id;
        $credentials['status'] = 'Active';

        $expense = Expense::create($credentials);
        if($expense)
        {
            $transaction = Transaction::create([
                'added_by' => auth()->user()->id,
                'business_id' => auth()->user()->business->id,
                'type' => 'Debit',
                'category' => 'Expense',
                'expense_id' => $expense->id,
                'amount' => $expense->amount,
                'method' => '-',
                'note' => 'Business Expense',
                'status' => 'Paid',
            ]);

            return redirect()->route('expenses')->with('message', 'You successfully add an expense');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function update(Request $request, Expense $expense)
    {
        $credentials = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'required|string',
            'date' => 'nullable|date',
        ]);

        $expense->update($credentials);
        if($expense)
        {
            $transaction = Transaction::where('expense_id', $expense->id)->update([
                'amount' => $expense->amount,
            ]);
            
            return redirect()->route('expenses')->with('message', 'You successfully update expense');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function cancel(Request $request, Expense $expense)
    {
        $data = $request->validate([
            'reason' => 'required'
        ]);
        // update expense
        $updateexpense = $expense->update([
            'status' => 'Canceled'
        ]);
        // update transaction
        $transaction = Transaction::where('expense_id',$expense->id)->update([
            'status' => 'Canceled',
            'cancel_reason' => 'expense has been canceled'
        ]);
        if($updateexpense && $transaction)
        {
            return redirect()->route('expenses.view', [$expense->id])->with('message', 'You canceled the expense successfully');
        }
        return redirect()->back()->with('message', 'There is an error, Try again');
    }

    public function delete(Request $request, Expense $expense)
    {
        // update expense
        $updateexpense = $expense->update([
            'status' => null
        ]);
        // update transaction
        $transaction = Transaction::where('expense_id',$expense->id)->update([
            'status' => null,
            'cancel_reason' => 'expense has been deleted'
        ]);
        if($updateexpense && $transaction)
        {
            return redirect()->route('expenses')->with('message', 'You deleted the expense successfully');
        }
        return redirect()->back()->with('message', 'There is an error, Try again');
    }

    public function print(Expense $expense)
    {
        // $content = file_get_contents('output.php');
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->loadView('app.expenses.pdf', ['expense'=> $expense]);

        return $pdf->download('AUCO-expense-'.$expense->name.'.pdf');
    }

    public function printAll()
    {
        if(auth()->user()->userType == 'super-admin'){
            $expenses = Expense::whereNotNull('status')->orderBy('id', 'desc')->get();
            $allExpenses = Expense::whereNotNull('status')->get()->count();
        }else{
            $expenses = Expense::where('added_by', auth()->user()->id)->whereNotNull('status')->orderBy('id', 'desc')->get();
            $allExpenses = Expense::where('added_by', auth()->user()->id)->whereNotNull('status')->get()->count();
        }
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.expenses.pdfAll', ['expenses'=> $expenses, 'allExpenses'=> $allExpenses]);

        return $pdf->download('AUCO-expenses.pdf');
    }

      
    public function generateReport(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $validatedData['start_date'];
        $endDate = $validatedData['end_date'];
     
        if(auth()->user()->userType == 'super-admin'){
            $expenses = Expense::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalExpenses = Expense::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $totalAmount = Expense::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->sum('amount');
            $activeExpenses = Expense::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Active')->count();
            $canceledExpenses = Expense::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Canceled')->count();
        }else{
            $expenses = Expense::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalExpenses = Expense::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $totalAmount = Expense::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->sum('amount');
            $activeExpenses = Expense::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('status', 'Active')->count();
            $canceledExpenses = Expense::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('status', 'Canceled')->count();
        }
        
        return view('app.expenses.report', compact('expenses', 'startDate', 'endDate', 'totalExpenses', 'totalAmount', 'activeExpenses', 'canceledExpenses'));
    }

    public function printReport(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        
        if(auth()->user()->userType == 'super-admin'){
            $expenses = Expense::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalExpenses = Expense::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $totalAmount = Expense::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->sum('amount');
            $activeExpenses = Expense::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Active')->count();
            $canceledExpenses = Expense::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Canceled')->count();
        }else{
            $expenses = Expense::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalExpenses = Expense::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $totalAmount = Expense::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->sum('amount');
            $activeExpenses = Expense::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('status', 'Active')->count();
            $canceledExpenses = Expense::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('status', 'Canceled')->count();
        }

        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.expenses.pdfReport', 
        ['expenses'=> $expenses, 'startDate'=> $startDate, 
         'endDate'=>$endDate, 'totalExpenses'=>$totalExpenses, 
         'totalAmount'=>$totalAmount, 'activeExpenses'=>$activeExpenses, 
         'canceledExpenses'=>$canceledExpenses]);

        return $pdf->download('Expenses-Report-'.$startDate .'-'. $endDate.'.pdf');
    }
}
