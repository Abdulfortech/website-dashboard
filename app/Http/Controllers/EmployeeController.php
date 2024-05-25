<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\Employee;
use Illuminate\Http\Request;
use PDF;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        $employees = Employee::whereNotNull('status')->orderBy('id', 'desc')->get();
        return view('app.employees.index',['employees'=> $employees]);
    }

    public function showAddEmployee()
    {
        $departments = Department::whereNotNull('status')->get();
        $roles = Role::whereNotNull('status')->get();
        $lastEmployee= Employee::whereNotNull('status')->orderBy('id', 'desc')->first();
        $nextID = $lastEmployee->id + 1;
        // dd($nextID);
        $ID = auth()->user()->business->abbreviation . "/" . date('Y'). '/'. $nextID;
        return view('app.employees.add', compact('departments', 'roles', 'ID'));
    }

    public function showEmployee(Request $request, Employee $employee)
    {
        return view('app.employees.view',['employee'=> $employee]);
    }

    public function showEditEmployee(Request $request, Employee $employee)
    {
        $departments = Department::whereNotNull('status')->get();
        $roles = Role::whereNotNull('status')->get();
        return view('app.employees.edit', compact('departments', 'roles', 'employee'));
    }

    public function addEmployee(Request $request)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'maritalStatus' => 'required',
            'phone1' => 'required',
            'phone2' => 'nullable',
            'address' => 'required',
            'state' => 'required',
            'lga' => 'required',
            'idType' => 'required',
            'idNumber' => 'required',
            'idPicture' => 'nullable', // Example: Validates as an image file
            'picture' => 'nullable', // Example: Validates as an image file
            'accountName' => 'required',
            'accountNumber' => 'required',
            'accountBank' => 'required',
            'guarantorName' => 'required',
            'guarantorRelation' => 'required',
            'guarantorPhone1' => 'required',
            'guarantorPhone2' => 'nullable',
            'guarantorAddress' => 'required|string',
            'employeeID' => 'required|string',
            'employmentDate' => 'required|string',
            'department' => 'required|string',
            'role' => 'required|string',
        ]);

        $credentials['user_id'] = auth()->user()->id;
        $credentials['business_id'] = auth()->user()->business->id;
        $credentials['status'] = 'Active';
        
        // dd($credentials);
        if($request->hasFile('picture')){
            $credentials['picture'] = $request->file('picture')->store('employees', 'public');
        }
        if($request->hasFile('idPicture')){
            $credentials['idPicture'] = $request->file('idPicture')->store('employees/idcards', 'public');
        }

        $employee = Employee::create($credentials);
        if($employee)
        {
            return redirect()->route('employees')->with('message', 'You successfully add an employee');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function editEmployee(Request $request, Employee $employee)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'maritalStatus' => 'required',
            'phone1' => 'required',
            'phone2' => 'nullable',
            'address' => 'required',
            'state' => 'required',
            'lga' => 'required',
            'idType' => 'required',
            'idNumber' => 'required',
            'idPicture' => 'nullable', // Example: Validates as an image file
            'picture' => 'nullable', // Example: Validates as an image file
            'accountName' => 'required',
            'accountNumber' => 'required',
            'accountBank' => 'required',
            'guarantorName' => 'required',
            'guarantorRelation' => 'required',
            'guarantorPhone1' => 'required',
            'guarantorPhone2' => 'nullable',
            'guarantorAddress' => 'required|string',
            'employeeID' => 'required|string',
            'employmentDate' => 'required|string',
            'department' => 'required|string',
            'role' => 'required|string',
        ]);

        if($request->hasFile('picture')){
            $credentials['picture'] = $request->file('picture')->store('employees', 'public');
        }
        if($request->hasFile('idPicture')){
            $credentials['idPicture'] = $request->file('idPicture')->store('employees/idcards', 'public');
        }
        
        $employee->update($credentials);
        if($employee)
        {
            return redirect()->route('employees')->with('message', 'You successfully update an employee');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function deleteEmployee(Request $request, Employee $employee)
    {
        $employee->delete();
        if($employee)
        {
            return redirect()->route('employees')->with('message', 'You successfully delete an employee');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');
    }

    public function print(Employee $employee)
    {
        // $content = file_get_contents('output.php');
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->loadView('app.employees.pdf', ['employee'=> $employee]);

        return $pdf->download('AUCO-employee-'.$employee->firstName.'.pdf');
    }

    public function printAll()
    {
        $employees = Employee::whereNotNull('status')->orderBy('id', 'desc')->get();
        $allEmployees = Employee::whereNotNull('status')->get()->count();
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.employees.pdfAll', ['employees'=> $employees, 'allEmployees'=> $allEmployees]);

        return $pdf->download('AUCO-Employees.pdf');
    }

    public function printAccounts()
    {
        $employees = Employee::whereNotNull('status')->orderBy('id', 'desc')->get();
        $allEmployees = Employee::whereNotNull('status')->get()->count();
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.employees.pdfAccounts', ['employees'=> $employees, 'allEmployees'=> $allEmployees]);

        return $pdf->download('AUCO-Accounts.pdf');
    }

}
