<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountingController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'showLoginForm'])->name('showSignin');


Route::group(['prefix' => 'auth'], function () {
    Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('showSignin');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
    Route::get('/signup', [AuthController::class, 'showRegistrationForm'])->name('showRegister');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
    // Route::get('/forget-password', [UserController::class, 'showForgetPasswordForm'])->name('user.forgetPassword');
    // Route::post('/forget-password', [UserController::class, 'forgetPassword'])->name('user.forgetPassword');
    // Route::get('/reset-password', [UserController::class, 'showResetPasswordForm'])->name('user.resetPassword');
    // Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('user.resetPassword');

}); 

Route::middleware(['auth:web'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // business
    Route::group(['prefix' => 'business'], function () {
        Route::get('/add', [BusinessController::class, 'index'])->name('addBusiness');
        Route::post('/add', [BusinessController::class, 'addBusiness'])->name('business.add');
        Route::get('/profile', [BusinessController::class, 'profile'])->name('business.profile');
        Route::post('/edit/{business}', [BusinessController::class, 'editBusiness'])->name('business.edit');
        // Route::get('/analytics', [BusinessController::class, 'analytics'])->name('analytics');
    });
    // components
    Route::group(['prefix' => 'components'], function () {
        Route::get('/index', [BusinessController::class, 'components'])->name('components');
        Route::get('/category', [BusinessController::class, 'category'])->name('components.category');
        Route::post('/category/add', [BusinessController::class, 'addCategory'])->name('category.add');
        Route::get('/category/delete/{category}', [BusinessController::class, 'deleteCategory'])->name('category.delete');
        Route::get('/departments', [BusinessController::class, 'departments'])->name('components.departments');
        Route::post('/department/add', [BusinessController::class, 'addDepartment'])->name('department.add');
        Route::get('/department/delete/{department}', [BusinessController::class, 'deleteDepartment'])->name('department.delete');
        Route::get('/roles', [BusinessController::class, 'roles'])->name('components.roles');
        Route::post('/role/add', [BusinessController::class, 'addRole'])->name('role.add');
        Route::get('/role/delete/{role}', [BusinessController::class, 'deleteRole'])->name('role.delete');
    });
    // admins
    Route::group(['prefix' => 'admins'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admins');
        Route::get('/add', [AdminController::class, 'showAddAdmin'])->name('admin.showAdd');
        Route::get('/view/{user}', [AdminController::class, 'showAdmin'])->name('admin.showView');
        Route::get('/edit/{user}', [AdminController::class, 'showEditAdmin'])->name('admin.showEdit');
        Route::post('/add', [AdminController::class, 'addAdmin'])->name('admin.add');
        Route::post('/edit/{user}', [AdminController::class, 'editAdmin'])->name('admin.edit');
        Route::get('/delete/{user}', [AdminController::class, 'deleteAdmin'])->name('admin.delete');
        Route::get('/deactivate/{user}', [AdminController::class, 'deactivateAdmin'])->name('admin.deactivate');
        Route::get('/activate/{user}', [AdminController::class, 'activateAdmin'])->name('admin.activate');
    });
    // clients
    // Route::group(['prefix' => 'clients'], function () {
    //     Route::get('/', [ClientController::class, 'index'])->name('clients');
    //     Route::get('/add', [ClientController::class, 'showAddClient'])->name('client.showAdd');
    //     Route::post('/store', [ClientController::class, 'addClient'])->name('client.store');
    //     Route::get('/view/{client}', [ClientController::class, 'showClient'])->name('client.showView');
    //     Route::get('/edit/{client}', [ClientController::class, 'showEditClient'])->name('client.showEdit');
    //     Route::post('/add', [ClientController::class, 'addClientModal'])->name('client.addModal');
    //     Route::post('/edit/{client}', [ClientController::class, 'editClient'])->name('client.edit');
    //     Route::get('/delete/{client}', [ClientController::class, 'deleteClient'])->name('client.delete');
    //     Route::get('/list', [ClientController::class, 'list'])->name('client.list');
    //     Route::get('/print/all', [ClientController::class, 'printAll'])->name('client.printAll');
    //     Route::get('/print/{client}', [ClientController::class, 'print'])->name('client.print');
    // });
    // employees
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees');
        Route::get('/add', [EmployeeController::class, 'showAddEmployee'])->name('employee.showAdd');
        Route::get('/view/{employee}', [EmployeeController::class, 'showEmployee'])->name('employee.showView');
        Route::get('/edit/{employee}', [EmployeeController::class, 'showEditEmployee'])->name('employee.showEdit');
        Route::post('/add', [EmployeeController::class, 'addEmployee'])->name('employee.add');
        Route::post('/edit/{employee}', [EmployeeController::class, 'editEmployee'])->name('employee.edit');
        Route::get('/delete/{employee}', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete');
        Route::get('/print/all', [EmployeeController::class, 'printAll'])->name('employee.printAll');
        Route::get('/print/accounts', [EmployeeController::class, 'printAccounts'])->name('employee.printAccounts');
        Route::get('/print/{employee}', [EmployeeController::class, 'print'])->name('employee.print');
    });
    // products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('add', [ProductController::class, 'create'])->name('products.showAdd');
        Route::post('/add', [ProductController::class, 'add'])->name('products.add');
        Route::get('/view/{product}', [ProductController::class, 'view'])->name('products.showView');
        Route::get('/print/all', [ProductController::class, 'pdfAll'])->name('products.printAll');
        Route::get('/print/{product}', [ProductController::class, 'pdf'])->name('products.print');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products.showEdit');
        Route::post('/edit/{product}', [ProductController::class, 'update'])->name('products.edit');
        Route::get('/delete/{product}', [ProductController::class, 'delete'])->name('products.delete');
        Route::get('/activate/{product}', [ProductController::class, 'activate'])->name('products.activate');
        Route::get('/deactivate/{product}', [ProductController::class, 'deactivate'])->name('products.deactivate');
        Route::get('/list', [ProductController::class, 'searchProducts']);
    });
    // orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders');
        Route::post('/place_order', [OrderController::class, 'newOrder'])->name('orders.placeOrder');
        Route::get('/view/{order}', [OrderController::class, 'viewOrder'])->name('orders.showView');
        Route::get('/edit/{order}', [OrderController::class, 'editOrder'])->name('orders.showEdit');
        Route::get('/completed/{order}', [OrderController::class, 'completed'])->name('orders.completed');
        Route::post('/delete/{order}', [OrderController::class, 'delete'])->name('orders.delete');
        Route::post('/cancel/{order}', [OrderController::class, 'cancel'])->name('orders.cancel');
        Route::post('/transaction/{order}', [OrderController::class, 'transaction'])->name('orders.transaction');
        Route::get('/receipt/{order}', [OrderController::class, 'receipt'])->name('orders.receipt');
        Route::get('/print/all', [OrderController::class, 'printAll'])->name('orders.printAll');
        Route::get('/product/add', [OrderController::class, 'productAdd'])->name('orders.showProductAdd');
        Route::get('/service/add', [OrderController::class, 'serviceAdd'])->name('orders.showServiceAdd');
        Route::post('/cart/add-product', [OrderController::class, 'addProductToCart'])->name('orders.cartAddProduct');
        Route::post('/cart/add-service', [OrderController::class, 'addProductToCart'])->name('orders.cartAddService');
        Route::get('/cart/items', [OrderController::class, 'getCartItems'])->name('orders.cartItems');
        Route::post('/cart/decrease/{itemId}', [OrderController::class, 'decreaseQuantity'])->name('orders.cartDecrease');
        Route::post('/cart/increase/{itemId}', [OrderController::class, 'increaseQuantity'])->name('orders.cartIncrease');
        Route::delete('/cart/delete/{itemId}', [OrderController::class, 'deleteItem'])->name('orders.cartDelete');
        Route::get('/generate-report', [OrderController::class, 'generateReport'])->name('orders.report');
        Route::get('/print/report', [OrderController::class, 'printReport'])->name('orders.printReport');
    });
    // expenses
    Route::prefix('expenses')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('expenses');
        Route::get('add', [ExpenseController::class, 'add'])->name('expenses.add');
        Route::post('/add', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::get('/view/{expense}', [ExpenseController::class, 'view'])->name('expenses.view');
        Route::get('/edit/{expense}', [ExpenseController::class, 'edit'])->name('expenses.edit');
        Route::post('/edit/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
        Route::post('/delete/{expense}', [ExpenseController::class, 'delete'])->name('expenses.delete');
        Route::post('/cancel/{expense}', [ExpenseController::class, 'cancel'])->name('expenses.cancel');
        Route::get('/generate-report', [ExpenseController::class, 'generateReport'])->name('expenses.report');
        Route::get('/print/report', [ExpenseController::class, 'printReport'])->name('expenses.printReport');
        Route::get('/print/all', [ExpenseController::class, 'printAll'])->name('expenses.printAll');
        Route::get('/print/{expense}', [ExpenseController::class, 'print'])->name('expenses.print');
    });
    // wages
    Route::prefix('wages')->group(function () {
        Route::get('/', [WageController::class, 'index'])->name('wages');
        Route::get('add', [WageController::class, 'add'])->name('wages.add');
        Route::post('/add', [WageController::class, 'store'])->name('wages.store');
        Route::get('/view/{wage}', [WageController::class, 'view'])->name('wages.view');
        Route::get('/edit/{wage}', [WageController::class, 'edit'])->name('wages.edit');
        Route::post('/edit/{wage}', [WageController::class, 'update'])->name('wages.update');
        Route::post('/delete/{wage}', [WageController::class, 'delete'])->name('wages.delete');
        Route::post('/cancel/{wage}', [WageController::class, 'cancel'])->name('wages.cancel');
        Route::get('/generate-report', [WageController::class, 'generateReport'])->name('wages.report');
        Route::get('/print/report', [WageController::class, 'printReport'])->name('wages.printReport');
        Route::get('/print/all', [WageController::class, 'printAll'])->name('wages.printAll');
        Route::get('/print/{wage}', [WageController::class, 'print'])->name('wages.print');
    });
    // accounting
    Route::prefix('accounting')->group(function () {
        Route::get('/', [AccountingController::class, 'index'])->name('accounting');
        Route::get('/view/{transaction}', [AccountingController::class, 'view'])->name('transactions.view');
        Route::get('/generate-report', [AccountingController::class, 'generateReport'])->name('transactions.report');
        Route::get('/print/report', [AccountingController::class, 'printReport'])->name('transactions.printReport');
        Route::get('/print/all', [AccountingController::class, 'printAll'])->name('transactions.printAll');
        Route::get('/print/{transaction}', [AccountingController::class, 'print'])->name('transactions.print');
    });
    // history
    Route::prefix('history')->group(function () {
        Route::get('/', [HistoryController::class, 'index'])->name('histories');
        Route::get('add', [HistoryController::class, 'add'])->name('history.add');
        Route::post('/add', [HistoryController::class, 'store'])->name('history.store');
        Route::get('/view/{history}', [HistoryController::class, 'view'])->name('history.view');
        Route::get('/edit/{history}', [HistoryController::class, 'edit'])->name('history.edit');
        Route::post('/edit/{history}', [HistoryController::class, 'update'])->name('history.update');
        Route::post('/delete/{history}', [HistoryController::class, 'delete'])->name('history.delete');
        Route::post('/cancel/{history}', [HistoryController::class, 'cancel'])->name('history.cancel');
        Route::get('/generate-report', [HistoryController::class, 'generateReport'])->name('history.report');
        Route::get('/print/report', [HistoryController::class, 'printReport'])->name('history.printReport');
        Route::get('/print/all', [HistoryController::class, 'printAll'])->name('history.printAll');
        Route::get('/print/{history}', [HistoryController::class, 'print'])->name('history.print');
    });

});
