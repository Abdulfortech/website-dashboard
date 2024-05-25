<?php

namespace App\Http\Controllers;

use App\Models\Wage;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

class WageController extends Controller
{
    //
    public function index()
    {
        if(auth()->user()->userType == 'super-admin'){
            $wages = Wage::whereNotNull('status')->orderBy('id', 'desc')->get();
            $allWages = Wage::whereNotNull('status')->get()->count();
            $activeWages = Wage::where('status', 'Active')->get()->count();
            $canceledWages = Wage::where('status', 'Canceled')->get()->count();
        }else{
            $wages = Wage::where('added_by', auth()->user()->id)->whereNotNull('status')->orderBy('id', 'desc')->get();
            $allWages = Wage::where('added_by', auth()->user()->id)->whereNotNull('status')->get()->count();
            $activeWages = Wage::where('added_by', auth()->user()->id)->where('status', 'Active')->get()->count();
            $canceledWages = Wage::where('added_by', auth()->user()->id)->where('status', 'Canceled')->get()->count();
        }
        return view('app.wages.index', compact('wages', 'allWages', 'activeWages', 'canceledWages'));
    }

    public function add()
    {
        $departments = Department::whereNotNull('status')->get();
        $employees = Employee::whereNotNull('status')->orderBy('id', 'desc')->get();
        return view('app.wages.add', compact('departments', 'employees'));
    }

    public function view(Wage $wage)
    {
        return view('app.wages.view', compact('wage'));
    }

    public function edit(Wage $wage)
    {
        $departments = Department::whereNotNull('status')->get();
        return view('app.wages.edit', compact('wage','departments'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'employee_id' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'method' => 'required|string',
            'date' => 'nullable|date',
            'note' => 'required|string',
        ]);

        $credentials['added_by'] = auth()->user()->id;
        $credentials['business_id'] = auth()->user()->business->id;
        $credentials['status'] = 'Active';

        $wage = Wage::create($credentials);
        if($wage)
        {
            $transaction = Transaction::create([
                'added_by' => auth()->user()->id,
                'business_id' => auth()->user()->business->id,
                'type' => 'Debit',
                'category' => 'Wage',
                'wage_id' => $wage->id,
                'amount' => $wage->amount,
                'method' => '-',
                'note' => 'Employee wage',
                'status' => 'Paid',
            ]);

            return redirect()->route('wages')->with('message', 'You successfully add a wage');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function update(Request $request, Wage $wage)
    {
        $credentials = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'required|string',
            'date' => 'nullable|date',
        ]);

        $wage->update($credentials);
        if($wage)
        {
            $transaction = Transaction::where('wage_id', $wage->id)->update([
                'amount' => $wage->amount,
            ]);
            
            return redirect()->route('wages')->with('message', 'You successfully update wage');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function cancel(Request $request, Wage $wage)
    {
        $data = $request->validate([
            'reason' => 'required'
        ]);
        // update wage
        $updatewage = $wage->update([
            'status' => 'Canceled'
        ]);
        // update transaction
        $transaction = Transaction::where('wage_id',$wage->id)->update([
            'status' => 'Canceled',
            'cancel_reason' => 'wage has been canceled'
        ]);
        if($updatewage && $transaction)
        {
            return redirect()->route('wages.view', [$wage->id])->with('message', 'You canceled the wage successfully');
        }
        return redirect()->back()->with('message', 'There is an error, Try again');
    }

    public function delete(Request $request, Wage $wage)
    {
        // update wage
        $updatewage = $wage->update([
            'status' => null
        ]);
        // update transaction
        $transaction = Transaction::where('wage_id',$wage->id)->update([
            'status' => null,
            'cancel_reason' => 'wage has been deleted'
        ]);
        if($updatewage && $transaction)
        {
            return redirect()->route('wages')->with('message', 'You deleted the wage successfully');
        }
        return redirect()->back()->with('message', 'There is an error, Try again');
    }
    
    public function print(Wage $wage)
    {
        // $content = file_get_contents('output.php');
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->loadView('app.wages.pdf', ['wage'=> $wage]);

        return $pdf->download('AUCO-wage-'.$wage->employee->firstName.'.pdf');
    }

    public function printAll()
    {
        if(auth()->user()->userType == 'super-admin'){
            $wages = Wage::whereNotNull('status')->orderBy('id', 'desc')->get();
            $allWages = Wage::whereNotNull('status')->get()->count();
        }else{
            $wages = Wage::where('added_by', auth()->user()->id)->whereNotNull('status')->orderBy('id', 'desc')->get();
            $allWages = Wage::where('added_by', auth()->user()->id)->whereNotNull('status')->get()->count();
        }
        
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.wages.pdfAll', ['wages'=> $wages, 'allWages'=> $allWages]);

        return $pdf->download('AUCO-wages.pdf');
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
            $wages = Wage::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalWages = Wage::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $totalAmount = Wage::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->sum('amount');
            $activeWages = Wage::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Active')->count();
            $canceledWages = Wage::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Canceled')->count();
        }else{
            $wages = Wage::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalWages = Wage::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $totalAmount = Wage::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->sum('amount');
            $activeWages = Wage::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('status', 'Active')->count();
            $canceledWages = Wage::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('status', 'Canceled')->count();
        }
        return view('app.wages.report', compact('wages', 'startDate', 'endDate', 'totalWages', 'totalAmount', 'activeWages', 'canceledWages'));
    }

    public function printReport(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if(auth()->user()->userType == 'super-admin'){
            $wages = Wage::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalWages = Wage::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $totalAmount = Wage::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->sum('amount');
            $activeWages = Wage::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Active')->count();
            $canceledWages = Wage::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Canceled')->count();
        }else{
            $wages = Wage::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalWages = Wage::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $totalAmount = Wage::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->sum('amount');
            $activeWages = Wage::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('status', 'Active')->count();
            $canceledWages = Wage::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('status', 'Canceled')->count();
        }

        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.wages.pdfReport', 
        ['wages'=> $wages, 'startDate'=> $startDate, 
         'endDate'=>$endDate, 'totalWages'=>$totalWages, 
         'totalAmount'=>$totalAmount, 'activeWages'=>$activeWages, 
         'canceledWages'=>$canceledWages]);

        return $pdf->download('Wages-Report-'.$startDate .'-'. $endDate.'.pdf');
    }

}
