<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use PDF;

class ClientController extends Controller
{
    //
    public function index()
    {
        $clients = Client::whereNotNull('status')->orderBy('id', 'desc')->get();
        return view('app.clients.index',['clients'=> $clients]);
    }

    public function list()
    {
        // $searchTerm = $request->input('searchTerm');
        $clients = Client::whereNotNull('status')->orderBy('id', 'desc')->get();
        return response()->json(['clients' => $clients]);
    }

    public function showAddClient()
    {
        return view('app.clients.add');
    }

    public function showClient(Request $request, Client $client)
    {
        return view('app.clients.view',['client'=> $client]);
    }

    public function showEditClient(Request $request, Client $client)
    {
        return view('app.clients.edit',['client'=> $client]);
    }

    public function addClient(Request $request)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'name' => ['required'],
            'category' => ['required'],
            'phone1' => ['required'],
            'phone2' => ['nullable'],
            'address' => ['nullable'],
        ]);
        $credentials['user_id'] = auth()->user()->id;
        $credentials['business_id'] = auth()->user()->business->id;
        $credentials['status'] = 'Active';

        $client = Client::create($credentials);
        if($client)
        {
            return redirect()->route('clients')->with('message', 'You successfully add a client');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function addClientModal(Request $request)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'name' => ['required'],
            'category' => ['required'],
            'phone1' => ['required'],
            'phone2' => ['nullable'],
            'address' => ['nullable'],
        ]);
        $credentials['user_id'] = auth()->user()->id;
        $credentials['business_id'] = auth()->user()->business->id;
        $credentials['status'] = 'Active';

        $client = Client::create($credentials);
        if($client)
        {
            return response()->json(['success' => true, 'message' => 'Client added successfully']);
        }
        return response()->json(['success' => false, 'message' => 'There is an error']);
    }

    public function editClient(Request $request, Client $client)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'name' => ['required'],
            'category' => ['required'],
            'phone1' => ['required'],
            'phone2' => ['nullable'],
            'address' => ['nullable'],
        ]);

        $client->update($credentials);
        if($client)
        {
            return redirect()->route('clients')->with('message', 'You successfully update a client');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function deleteClient(Request $request, Client $client)
    {
        $client->delete();
        if($client)
        {
            return redirect()->route('clients')->with('message', 'You successfully delete a client');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }
    
    public function print(Client $client)
    {
        // $content = file_get_contents('output.php');
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->loadView('app.clients.pdf', ['client'=> $client]);

        return $pdf->download('AUCO-client-'.$client->name.'.pdf');
    }

    public function printAll()
    {
        $clients = Client::whereNotNull('status')->orderBy('id', 'desc')->get();
        $allClients = Client::whereNotNull('status')->get()->count();
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.clients.pdfAll', ['clients'=> $clients, 'allClients'=> $allClients]);

        return $pdf->download('AUCO-clients.pdf');
    }
}
