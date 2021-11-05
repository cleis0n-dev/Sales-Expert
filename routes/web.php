<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\AccountBookController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountReferenceController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Registers - Company
Route::middleware(['auth'])->group(function () {

    Route::get('/company',              [CompanyController::class, 'show'])->name('company');
    Route::post('/company/create',      [CompanyController::class, 'register'])->name('company_register');
    Route::put('/company/update/{id}',  [CompanyController::class, 'update'])->name('company_updt');



    // Registers - Employer
    Route::get('/employer',             [EmployerController::class, 'show'])->name('employer');
    Route::post('/employer/create',     [EmployerController::class, 'create'])->name('employer_create');
    Route::get('/employer/edit/{id}',   [EmployerController::class, 'edit'])->name('employer_edit');
    Route::put('/employer/update/{id}', [EmployerController::class, 'updt'])->name('employer_updt');
    Route::get('/employer/warning/{id}',[EmployerController::class, 'warning'])->name('employer_warning');
    Route::get('/employer/delete/{id}', [EmployerController::class, 'delete'])->name('employer_delete');

    //Registers - Supplier
    Route::get('/supplier',                 [SupplierController::class, 'show'])->name('supplier');
    Route::post('/supplier/create',         [SupplierController::class, 'create'])->name('supplier_create');
    Route::get('/supplier/edit/{id}',       [SupplierController::class, 'edit'])->name('supplier_edit');
    Route::put('/supplier/update/{id}',     [SupplierController::class, 'updt'])->name('supplier_update');
    Route::get('/supplier/warning/{id}',    [SupplierController::class, 'warning'])->name('supplier_warning');
    Route::get('/supplier/delete/{id}',     [SupplierController::class, 'delete'])->name('supplier_delete');

    //Registers - Payments
    Route::get('/payment_method',                   [PaymentMethodController::class, 'show'])->name('payment_method');
    Route::post('/payment_method/create',           [PaymentMethodController::class, 'create'])->name('payment_method_create');
    Route::get('/payment_method/edit/{id}',         [PaymentMethodController::class, 'edit'])->name('payment_method_edit');
    Route::put('/payment_method/update/{id}',       [PaymentMethodController::class, 'updt'])->name('payment_method_updt');
    Route::get('/payment_method/warning/{id}',      [PaymentMethodController::class, 'warning'])->name('payment_method_warning');
    Route::get('/payment_method/delete/{id}',       [PaymentMethodController::class, 'delete'])->name('payment_method_delete');


    // Customers - Customer
    Route::get('/customer',                     [CustomerController::class, 'show'])->name('customer');
    Route::post('/customer/create',             [CustomerController::class, 'create'])->name('customer_create');
    Route::get('/customer/edit/{id}',           [CustomerController::class, 'edit'])->name('customer_edit');
    Route::put('/customer/update/{id}',         [CustomerController::class, 'updt'])->name('customer_updt');
    Route::get('/customer/warning/{id}',        [CustomerController::class, 'warning'])->name('customer_warning');
    Route::get('/customer/delete/{id}',         [CustomerController::class, 'delete'])->name('customer_delete');

    // Customers - Service
    Route::get('/customers_service',                             [CustomerServiceController::class, 'show'])->name('customer_service');
    Route::get('/customers_service/customer/{id}',               [CustomerServiceController::class, 'shop'])->name('customer_shop');
    Route::post('/customers_service/create',                     [CustomerServiceController::class, 'store'])->name('service_create');
    Route::get('/customer_service/edit/{ordem}',                 [CustomerServiceController::class, 'edit'])->name('service_edit');

    //Oprations - Accounts
    Route::get('/operation/accounts',           [AccountController::class,'index'])->name('account.new');
    Route::post('/operation/accounts/store',    [AccountController::class, 'store'])->name('account.store');

    // Operations - Account_Book
    Route::get('/operation/accountability',                             [AccountBookController::class, 'index'])->name('account.book');
    Route::post('/operation/accountability/open',                       [AccountBookController::class, 'store'])->name('account.book.open');
    Route::put('/operation/accountability/close/{id}',                  [AccountBookController::class, 'close'])->name('account.book.close');
    Route::get('/operation/accountability/show/{id}',                   [AccountBookController::class, 'show'])->name('account.book.show');

    // Operations - posting_account
    Route::get('/operation/post_account', [AccountBookController::class,'post_index'])->name('posting.book');




    Route::post('/operation/accountability/create',     [AccountReferenceController::class, 'store'])->name('account.reference.create');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('reports/dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/product&service', function () {
    return view('registers/service');
})->middleware(['auth'])->name('service');

// Customer

Route::get('/customer_service_action', function () {
    return view('customers/customer_service_action');
})->middleware(['auth'])->name('customer_action');

// Archives

Route::get('/archives/customer_report', function () {
    return view('archives/customer_report');
})->middleware(['auth'])->name('archive.customer');

Route::get('/archives/payments_report', function () {
    return view('archives/payment_report');
})->middleware(['auth'])->name('payment.report');

// Operation

Route::get('/operation/posting account', function () {
    return view('operation/posting_account');
})->middleware(['auth'])->name('posting.account');

require __DIR__.'/auth.php';
