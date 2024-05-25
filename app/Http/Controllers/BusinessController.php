<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Wage;
use App\Models\Order;
use App\Models\Client;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Business;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    //
    public function index()
    {
        return view('app.business.add');
    }

    public function addBusiness(Request $request)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'name' => ['required'],
            'motto' => ['required'],
            'abbreviation' => 'required',
            'category' => 'required',
            'phone1' => 'required|min:11|max:15',
            'phone2' => 'required|min:11|max:15',
            'email' => 'required',
            'address' => 'required',
            'state' => 'required',
            'lga' => 'required',
            'accountName' => 'required',
            'accountNumber' => 'required',
            'accountBank' => 'required',
            'logo' => 'required',
        ]);
        $credentials['admin_id'] = auth()->user()->id;
        $credentials['status'] = 'Active';
 
        if($request->hasFile('logo')){
            $credentials['logo'] = $request->file('logo')->store('businesses', 'public');
        }

        $business = Business::create($credentials);
        if($business)
        {
            $user = User::where('id',auth()->user()->id)->update(['business_id' => $business->id]);
            return redirect()->route('business.profile')->with('message', 'You successfully onboard your business');

        }
        return redirect()->route('addBusiness')->with('message', 'There is an error.Try again');
    }

    public function profile()
    {
        return view('app.business.edit');
    }

    public function components()
    {
        return view('app.component.index');
    }

    public function editBusiness(Request $request, Business $business)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'name' => ['required'],
            'motto' => ['required'],
            'abbreviation' => 'required',
            'category' => 'required',
            'phone1' => 'required|min:11|max:15',
            'phone2' => 'required|min:11|max:15',
            'email' => 'required',
            'address' => 'required',
            'state' => 'required',
            'lga' => 'required',
            'accountName' => 'required',
            'accountNumber' => 'required',
            'accountBank' => 'required',
        ]);

        
        if($request->hasFile('logo')){
            $credentials['logo'] = $request->file('logo')->store('businesses', 'public');
        }

        $business->update($credentials);
        if($business)
        {
            return redirect()->route('business.profile')->with('message', 'You successfully update business');

        }
        return redirect()->route('business.profile')->with('message', 'There is an error.Try again');
    }
    
    public function category()
    {
        $categories = Category::whereNotNull('status')->orderBy('id', 'desc')->get();
        return view('app.component.category', ['categories' => $categories]);
    }

    public function addCategory(Request $request)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'title' => ['required'],
        ]);
        $credentials['user_id'] = auth()->user()->id;
        $credentials['status'] = 'Active';

        $category = Category::create($credentials);
        if($category)
        {
            return redirect()->route('components.category')->with('message', 'You successfully add a category');
        }
        return redirect()->route('components.category')->with('message', 'There is an error.Try again');
    }

    public function deleteCategory(Request $request, Category $category)
    {
        $category->delete();
        if($category)
        {
            return redirect()->route('components.category')->with('message', 'You successfully delete a category');
        }
        return redirect()->route('components.category')->with('message', 'There is an error.Try again');
    }

    public function departments()
    {
        $departments = Department::whereNotNull('status')->orderBy('id', 'desc')->get();
        return view('app.component.departments', ['departments' => $departments]);
    }

    public function addDepartment(Request $request)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'title' => ['required'],
        ]);
        $credentials['user_id'] = auth()->user()->id;
        $credentials['status'] = 'Active';

        $department = Department::create($credentials);
        if($department)
        {
            return redirect()->route('components.departments')->with('message', 'You successfully add a department');
        }
        return redirect()->route('components.departments')->with('message', 'There is an error.Try again');
    }

    public function deleteDepartment(Request $request, Department $department)
    {
        $department->delete();
        if($department)
        {
            return redirect()->route('components.departments')->with('message', 'You successfully delete a department');
        }
        return redirect()->route('components.departments')->with('message', 'There is an error.Try again');
    }
    
    public function roles()
    {
        $roles = Role::whereNotNull('status')->orderBy('id', 'desc')->get();
        return view('app.component.roles', ['roles' => $roles]);
    }

    public function addRole(Request $request)
    {
        // Validation logic here (you can use Laravel validation)
        $credentials = $request->validate([
            'title' => ['required'],
        ]);
        $credentials['user_id'] = auth()->user()->id;
        $credentials['status'] = 'Active';

        $role = Role::create($credentials);
        if($role)
        {
            return redirect()->route('components.roles')->with('message', 'You successfully add a role');
        }
        return redirect()->route('components.roles')->with('message', 'There is an error.Try again');
    }

    public function deleteRole(Request $request, Role $role)
    {
        $role->delete();
        if($role)
        {
            return redirect()->route('components.roles')->with('message', 'You successfully delete a role');
        }
        return redirect()->route('components.roles')->with('message', 'There is an error.Try again');
    }

    public function analytics()
    {
        
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $allProducts = Product::whereNotNull('status')->get()->count();
        $activeProducts = Product::where('status', 'Active')->get()->count();
        $inactiveProducts = Product::where('status', 'Inactive')->get()->count();
        $deletedProducts = Product::whereNull('status')->get()->count();
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
        $allClients = Client::whereNotNull('status')->get()->count();
        $allOrders = Order::whereNotNull('status')->get()->count();
        $allTransactions = Transaction::whereNotNull('status')->get()->count();
        $allWages = Wage::whereNotNull('status')->get()->count();
        $allExpenses = Expense::whereNotNull('status')->get()->count();
        return view('app.business.analytics', 
        compact('activeProducts', 'allProducts', 'inactiveProducts', 'deletedProducts', 'allWages', 'allExpenses'));
    }
}
