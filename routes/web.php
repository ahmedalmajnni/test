<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Invoices\InvoiceArchiveController;
use App\Http\Controllers\Invoices\InvoiceAttachmentController;
use App\Http\Controllers\Invoices\InvoiceController;
use App\Http\Controllers\Invoices\InvoiceCustomerReportController;
use App\Http\Controllers\Invoices\InvoiceDetailsController;
use App\Http\Controllers\Invoices\InvoiceReport;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\checkStatus;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

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



//region auth

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard',[HomeController::class,'index']);

//endregion

//region invoice
Route::prefix('invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'index']);
    Route::get('/create', [InvoiceController::class, 'create']);
    Route::post('store', [InvoiceController::class, 'store']);
    Route::get('Status_show/{id}', [InvoiceController::class, 'show']);
    Route::put('/edit/invoices/update', [InvoiceController::class, 'update']);
    Route::get('edit/{id}', [InvoiceController::class, 'edit']);
    Route::delete('destroy', [InvoiceController::class, 'destroy']);
});

Route::controller(InvoiceArchiveController::class)->prefix('invoices_archive')->group(function () {
    Route::get('/', 'index');
    Route::post('store', 'store');
    Route::get('show/{id}', 'show');
    Route::put('update/{id}', 'update');
    Route::delete('destroy', 'destroy');
});



Route::post('Status_show/Status_update/{id}', [InvoiceController::class, 'status_update']);

Route::get('paid_invoices', [InvoiceController::class, 'paid_invoices']);
Route::get('unpaid_invoices', [InvoiceController::class, 'unpaid_invoices']);
Route::get('partly_paid_invoices', [InvoiceController::class, 'partly_paid_invoices']);



Route::post('add_file', [InvoiceDetailsController::class, 'store']);
Route::delete('delete', [InvoiceAttachmentController::class, 'destroy']);


Route::get('invoicesdetails/{id}', [InvoiceDetailsController::class, 'show']);
Route::get('View_file/{invoice_number}/{file_name}', [InvoiceAttachmentController::class, 'show']);
Route::get('download/{invoice_number}/{file_name}', [InvoiceAttachmentController::class, 'show']);

Route::get('/report', [InvoiceReport::class, 'index']);
Route::post('/search', [InvoiceReport::class, 'search']);

Route::get('/customer_report', [InvoiceCustomerReportController::class, 'index']);
Route::post('/customer_search', [InvoiceCustomerReportController::class, 'search']);
//endregion

//region section
Route::prefix('sections')->group(function () {
    Route::get('/', [SectionController::class, 'index']);
    Route::post('store', [SectionController::class, 'store']);
    Route::get('show/{id}', [SectionController::class, 'show']);
    Route::put('update', [SectionController::class, 'update']);
    Route::delete('destroy', [SectionController::class, 'destroy']);
});
Route::get('/section/{id}', [InvoiceController::class, 'get_product']);


//endregion

//region product
Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('/', 'index');
    Route::post('store', 'store');
    Route::get('show/{id}', 'show');
    Route::put('update', 'update');
    Route::delete('destroy', 'destroy');
});

//endregion

//region notification
Route::get('mark_as_read', [InvoiceController::class, 'MarkAsRead']);
//endregion

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

require __DIR__ . '/auth.php';
