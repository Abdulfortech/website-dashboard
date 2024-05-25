<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\History;
use App\Models\Product;
use App\Models\Department;
use Illuminate\Http\Request;
use PDF;

class HistoryController extends Controller
{
    //
    public function index()
    {
        if(auth()->user()->userType == 'super-admin'){
            $histories = History::whereNotNull('status')->orderBy('id', 'desc')->get();
            $allHistories = History::whereNotNull('status')->get()->count();
            $activeHistories = History::where('status', 'Active')->get()->count();
            $canceledHistories = History::where('status', 'Canceled')->get()->count();
        }else{
            $histories = History::where('added_by', auth()->user()->id)->whereNotNull('status')->orderBy('id', 'desc')->get();
            $allHistories = History::where('added_by', auth()->user()->id)->whereNotNull('status')->get()->count();
            $activeHistories = History::where('added_by', auth()->user()->id)->where('status', 'Active')->get()->count();
            $canceledHistories = History::where('added_by', auth()->user()->id)->where('status', 'Canceled')->get()->count();
        }
        
        return view('app.history.index', compact('histories', 'allHistories', 'activeHistories', 'canceledHistories'));
    }

    public function add()
    {
        $departments = Department::whereNotNull('status')->get();
        $products = Product::whereNotNull('status')->get();
        return view('app.history.add', compact('departments', 'products'));
    }

    public function view(History $history)
    {
        return view('app.history.view', compact('history'));
    }

    public function edit(History $history)
    {
        $departments = Department::whereNotNull('status')->get();
        $products = Product::whereNotNull('status')->get();
        return view('app.history.edit', compact('history','departments', 'products'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'product_id' => 'required|numeric',
            'department' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $credentials['added_by'] = auth()->user()->id;
        $credentials['business_id'] = auth()->user()->business->id;
        $credentials['status'] = 'Active';

        $history = History::create($credentials);
        if($history)
        {
            return redirect()->route('histories')->with('message', 'You successfully add inventory history');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function update(Request $request, History $history)
    {
        $credentials = $request->validate([
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'product_id' => 'required|numeric',
            'department' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $history->update($credentials);
        if($history)
        {
            return redirect()->route('histories')->with('message', 'You successfully update inventory history');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function cancel(Request $request, History $history)
    {
        $data = $request->validate([
            'reason' => 'required'
        ]);
        // update history
        $updatehistory = $history->update([
            'status' => 'Canceled',
            'cancel_reason' => $request->reason
        ]);

        if($updatehistory)
        {
            return redirect()->route('history.view', [$history->id])->with('message', 'You canceled the history successfully');
        }
        return redirect()->back()->with('message', 'There is an error, Try again');
    }

    public function delete(Request $request, History $history)
    {
        // update history
        $updatehistory = $history->update([
            'status' => null,
            'cancel_reason' => 'deleted'
        ]);
        if($updatehistory)
        {
            return redirect()->route('histories')->with('message', 'You deleted the history successfully');
        }
        return redirect()->back()->with('message', 'There is an error, Try again');
    }

    public function print(History $history)
    {
        // $content = file_get_contents('output.php');
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->loadView('app.history.pdf', ['history'=> $history]);

        return $pdf->download('AUCO-history-'.$history->date.'.pdf');
    }

    public function printAll()
    {
        if(auth()->user()->userType == 'super-admin'){
            $histories = History::whereNotNull('status')->orderBy('id', 'desc')->get();
            $allHistories = History::whereNotNull('status')->get()->count();
        }else{
            $histories = History::where('added_by', auth()->user()->id)->whereNotNull('status')->orderBy('id', 'desc')->get();
            $allHistories = History::where('added_by', auth()->user()->id)->whereNotNull('status')->get()->count();   
        }
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.history.pdfAll', ['histories'=> $histories, 'allHistories'=> $allHistories]);

        return $pdf->download('AUCO-Inventory-Histories.pdf');
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
            $histories = History::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalHistories = History::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $stockinHistories = History::whereBetween('created_at', [$startDate, $endDate])->where('type', 'Stock-In')->whereNotNull('status')->count();
            $stockoutHistories = History::whereBetween('created_at', [$startDate, $endDate])->where('type', 'Stock-Out')->whereNotNull('status')->count();
        }else{
            $histories = History::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalHistories = History::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $stockinHistories = History::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('type', 'Stock-In')->whereNotNull('status')->count();
            $stockoutHistories = History::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('type', 'Stock-Out')->whereNotNull('status')->count();
        }
        // $query = $histories->toBase()->toSql();
        // dd($query);
        return view('app.history.report', compact('histories', 'startDate', 'endDate', 'totalHistories', 'stockinHistories', 'stockoutHistories'));
    }

    public function printReport(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        
        if(auth()->user()->userType == 'super-admin'){
            $histories = History::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalHistories = History::whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $stockinHistories = History::whereBetween('created_at', [$startDate, $endDate])->where('type', 'Stock-In')->whereNotNull('status')->count();
            $stockoutHistories = History::whereBetween('created_at', [$startDate, $endDate])->where('type', 'Stock-Out')->whereNotNull('status')->count();
        }else{
            $histories = History::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->get();
            $totalHistories = History::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->whereNotNull('status')->count();
            $stockinHistories = History::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('type', 'Stock-In')->whereNotNull('status')->count();
            $stockoutHistories = History::where('added_by', auth()->user()->id)->whereBetween('created_at', [$startDate, $endDate])->where('type', 'Stock-Out')->whereNotNull('status')->count();
        }

        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.history.pdfReport', 
        ['histories'=> $histories, 'startDate'=> $startDate, 
         'endDate'=>$endDate, 'totalHistories'=>$totalHistories, 
         'stockinHistories'=>$stockinHistories, 
         'stockoutHistories'=>$stockoutHistories]);

        return $pdf->download('Inventory-Report-'.$startDate .'-'. $endDate.'.pdf');
    }
}
